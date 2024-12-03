<?php

class RestController
{
    protected $request;
    protected $serviceName;
    protected $param;
    protected $dbConn;
    protected $userId;

    protected $licenseModel;
    protected $licenseId;
    protected $status;
    protected $expiry;
    protected  $max_installations;
    protected $active_installations;



    public function __construct()
    {

        $this->initializeRequest();

        $this->validateRequest();

        $this->dbConn = Database::getInstance()->getConnection();
        $this->licenseModel = new License();
        if(strtolower($this->serviceName) !== 'createlicense'){
            $this->validateLicenseToken();
        }
        
     
    }

    /**
     * Initialize the incoming request data
     */
    private function initializeRequest()
    {
        $this->request = json_decode(file_get_contents('php://input'), true);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->throwError(405, 'Request Method Not Allowed. Only POST is supported.');
        }

        if (!$this->request) {
            $this->throwError(400, 'Invalid JSON payload in the request.');
        }
    }

    /**
     * Validate the incoming API request
     */
    public function validateRequest()
    {
        if (!isset($this->request['name']) || empty($this->request['name'])) {
            $this->throwError(400, 'API service name is required.');
        }
        $this->serviceName = trim($this->request['name']);

        if (!isset($this->request['param']) || !is_array($this->request['param'])) {
            $this->throwError(400, 'API parameters are required and must be an array.');
        }
        $this->param = $this->request['param'];
    }

    /**
     * Validate individual parameters
     */
    public function validateParameter($fieldName, $value, $dataType, $required = true)
    {
        if ($required && empty($value)) {
            $this->throwError(400, "$fieldName is required.");
            exit;
        }

        switch ($dataType) {
            case BOOLEAN:
                if (!is_bool($value)) {
                    $this->throwError(400, "$fieldName must be a boolean.");
                }
                break;
            case INTEGER:
                if (!is_numeric($value)) {
                    $this->throwError(400, "$fieldName must be an integer.");
                }
                break;
            case STRING:
                if (!is_string($value)) {
                    $this->throwError(400, "$fieldName must be a string.");
                }
                break;

            default:
                $this->throwError(400, "Invalid data type for $fieldName.");
        }

        return $value;
    }

    /**
     * Validate Bearer Token from the request
     */
    public function validateLicenseToken()
    {

        $token = $this->getBearerToken();
        
        $license_results = $this->licenseModel->getLicenseByKey($token);

        if (!$license_results)
            $this->throwError(400, "License Key Not Found or invalid token");

        $this->licenseId =  (int) $license_results['id'];
        $this->status = $license_results['status'];
        $this->expiry = $license_results['expires_at'];
        $this->max_installations = $license_results['max_installations'];
        $this->active_installations = $license_results['active_installations'];
        // $this->returnResponse(200, "License Key validated successfully.",$license_results);
    }
    /**
     * Process the API call
     */
    public function processApi()
    {
        try {
            $api = new $this->serviceName();
            $method = new ReflectionMethod($this->serviceName, $this->serviceName);

            if (!$method->isPublic()) {
                $this->throwError(400, "API method is not accessible.");
            }

            $method->invoke($api);
        } catch (ReflectionException $e) {
            $this->throwError(404, "API method not found: " . $e->getMessage());
        }
    }

    /**
     * Throw a structured error response
     */
    public function throwError($code, $message, $responsedata = [])
    {

        http_response_code($code);

        $error_array = [
            'response' => [
                'status' => $code,
                'success' => false,
                'message' => $message,
            ],
        ];

        if (!empty($responsedata)) {
            $error_array['response']['data'] = $responsedata;
        }

        echo json_encode($error_array, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Send a structured success response
     */
    public function returnResponse($code, $msg = '', $responsedata = [])
    {

        http_response_code($code);
        $response_array = [
            'response' => [
                'status' => $code,
                'success' => true,
                'message' => $msg,
            ],
        ];
        if (!empty($responsedata)) {
            $response_array['response']['data'] = $responsedata;
        }
        echo json_encode($response_array, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Get hearder Authorization
     * */
    public function getAuthorizationHeader()
    {
        $headers = null;

        $authSources = [
            'Authorization',
            'HTTP_AUTHORIZATION',
            'HTTP_X_AUTHORIZATION',
            'REDIRECT_HTTP_AUTHORIZATION',
        ];

        foreach ($authSources as $source) {
            if (!empty($_SERVER[$source])) {
                $headers = trim($_SERVER[$source]);
                break;
            }
        }

        if ($headers === null && function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));

            $authKeys = ['Authorization', 'X-Authorization'];
            foreach ($authKeys as $key) {
                if (isset($requestHeaders[$key])) {
                    $headers = trim($requestHeaders[$key]);
                    break;
                }
            }
        }

        return $headers;
    }

    /**
     * Extract Bearer token from the Authorization header
     */
    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();

        if ($headers && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
        $this->throwError(401, 'Authorization header not found or invalid for', $this->serviceName);
    }
}

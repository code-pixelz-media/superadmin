<?php

class RestController
{
    protected $request;
    protected $serviceName;
    protected $param;
    protected $dbConn;
    protected $userId;
    protected $jwt;
    protected $allowed;
    protected $expiredToken = false;
    protected $valid_payload;
    public function __construct()
    {

        $this->initializeRequest();
        $this->jwt = JwtHelper::getInstance();

        $this->validateRequest();

        $this->dbConn = Database::getInstance()->getConnection();

        error_log('Service Name Detected: ' . $this->serviceName);

        if (!in_array($this->serviceName, ['token', 'refreshtoken'])) {
            error_log('Executing validateToken() for: ' . $this->serviceName);
            $this->validateToken();
        } else {
            error_log('Skipping validateToken() for: ' . $this->serviceName);
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
    public function validateToken()
    {

        $token = $this->getBearerToken();
        $valid_data = $this->jwt->validate($token);

        if (!$valid_data['success']) {
            $this->throwError(ACCESS_TOKEN_ERRORS, $valid_data['message']);
        }

        $this->valid_payload = $valid_data['payload'];
    }

    public function createToken($email, $license_key)
    {

        $payload = [
            'license_key' => $license_key,
            'email' => $email,
            // 'domain' => $domain,
        ];
        $token = $this->jwt->generateTokenPair($payload);
        if ($token['success'] == false) {
            $this->throwError($token['error_code'], $token['message']);
        }
        unset($token['success']);
        $this->returnResponse(200, "Token generated sucessfully", $token);
    }

    public function tokenRefresh($storedRefreshToken)
    {

        $ref_token = $this->jwt->refreshAccessToken($storedRefreshToken);

        if ($ref_token['error_code'] == 402) {
            $this->throwError(402, "Signature Verification Failed");
        }

        $this->returnResponse(200, "Refresh Token generated sucessfully", $ref_token);
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
            'error' => [
                'status' => $code,
                'success' => false,
                'message' => $message,
            ],
        ];

        if (!empty($responsedata)) {
            $error_array['response'] = $responsedata;
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

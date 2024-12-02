<?php
// require_once __DIR__ . '/config/config.php';
require 'vendor/autoload.php';
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    private $secretKey;
    private $refreshSecretKey;
    private $algorithm = 'HS256';
    private $keyLength = 32;
    private static $instance = null;

    private function __construct()
    {
        $this->generateSecretKeys();
    }

    /**
     * Get singleton instance of JWT controller
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Generate cryptographically secure secret keys
     */
    private function generateSecretKeys()
    {
        try {
            $this->secretKey = bin2hex(random_bytes($this->keyLength));
            $this->refreshSecretKey = bin2hex(random_bytes($this->keyLength));
            $this->storeKeys();
        } catch (Exception $e) {
            throw new RuntimeException('Failed to generate secure keys: ' . $e->getMessage());
        }
    }

    /**
     * Store keys securely
     */
    private function storeKeys()
    {
        if (!defined('JWT_KEYS_PATH')) {
            define('JWT_KEYS_PATH', __DIR__ . '/../config/jwt_keys.php');
        }

        if (!file_exists(JWT_KEYS_PATH)) {
            $content = "<?php\nreturn [\n" .
            "    'access_key' => '" . $this->secretKey . "',\n" .
            "    'refresh_key' => '" . $this->refreshSecretKey . "'\n" .
                "];";

            if (!is_dir(dirname(JWT_KEYS_PATH))) {
                mkdir(dirname(JWT_KEYS_PATH), 0755, true);
            }

            file_put_contents(JWT_KEYS_PATH, $content);
        } else {
            $keys = include JWT_KEYS_PATH;
            $this->secretKey = $keys['access_key'];
            $this->refreshSecretKey = $keys['refresh_key'];
        }
    }

    /**
     * Generate token pair (access and refresh tokens)
     */
    public function generateTokenPair($payload)
    {
        try {
            $accessToken = $this->generateToken($payload, $this->secretKey, JWT_ACCESS_TOKEN_EXPIRY);
            $refreshToken = $this->generateToken($payload, $this->refreshSecretKey, JWT_REFRESH_TOKEN_EXPIRY);

            return [
                'success' => true,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_in' => JWT_ACCESS_TOKEN_EXPIRY,
            ];
        } catch (Exception $e) {
            return $this->handleError(500, 'Token generation failed', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Generate a single token
     */
    private function generateToken($payload, $key, $expiration)
    {

        $payload['iss'] = 'crypto-wallet';
        $payload['aud'] = 'plugin-users';
        $payload['exp'] = time() + $expiration;
        $payload['iat'] = time();
        return JWT::encode($payload, $key, $this->algorithm);
    }

    /**
     * Validate a token
     */
    public function validate($token, $isRefreshToken = false)
    {
        $key = $isRefreshToken ? $this->refreshSecretKey : $this->secretKey;

        try {
            $decoded = JWT::decode($token, new Key($key, $this->algorithm));
            return [
                'success' => true,
                'payload' => (array) $decoded,
            ];
        } catch (ExpiredException $e) {
            return $this->handleError(401, 'Token expired');
        } catch (Exception $e) {
            return $this->handleError(401, 'Invalid token', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Refresh an expired access token using the refresh token
     */
    public function refreshAccessToken($refreshToken)
    {
        $validationResult = $this->validate($refreshToken, true);

        if (!$validationResult['success']) {
            return $validationResult;
        }

        $payload = $validationResult['payload'];
        unset($payload['exp'], $payload['iat']);

        return $this->generateTokenPair($payload);
    }

    public function handleTokenFlow($accessToken, $refreshToken, $payload)
    {
        // Step 1: Validate the access token
        $accessTokenResult = $this->validate($accessToken, false);

        if ($accessTokenResult['success']) {
            // Access token is valid; return it
            return [
                'success' => true,
                'status' => 'proceed',
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_in' => JWT_ACCESS_TOKEN_EXPIRY,
            ];
        }

        // Step 2: If access token is expired, validate the refresh token
        if ($accessTokenResult['error_code'] === 401 && $accessTokenResult['message'] === 'Token expired') {
            $refreshTokenResult = $this->validate($refreshToken, true);

            if ($refreshTokenResult['success']) {
                // Refresh token is valid; generate a new access token
                unset($refreshTokenResult['payload']['exp'], $refreshTokenResult['payload']['iat']);
                $newAccessToken = $this->generateToken($refreshTokenResult['payload'], $this->secretKey, JWT_ACCESS_TOKEN_EXPIRY);

                return [
                    'success' => true,
                    'status' => 'new_access_token',
                    'access_token' => $newAccessToken,
                    'refresh_token' => $refreshToken,
                    'expires_in' => JWT_ACCESS_TOKEN_EXPIRY,
                ];
            }

            // Step 3: If the refresh token is also expired, generate new tokens
            if ($refreshTokenResult['error_code'] === 401 && $refreshTokenResult['message'] === 'Token expired') {
                return [
                    'success' => true,
                    'status' => 'new_tokens',
                    'tokens' => $this->generateTokenPair($payload),
                ];
            }
        }

        // If validation failed, return an error
        return $this->handleError(401, 'Invalid or expired tokens');
    }

    /**
     * Handle errors
     */
    private function handleError($code, $message, $details = [])
    {

        return [
            'success' => false,
            'error_code' => $code,
            'message' => $message,
            'details' => $details,
        ];
    }

    /**
     * Rotate keys for added security
     */
    public function rotateKeys()
    {
        $this->generateSecretKeys();
        return true;
    }

    /**
     * Get access key (for testing purposes)
     */
    public function getAccessKey()
    {
        return $this->secretKey;
    }

    /**
     * Get refresh key (for testing purposes)
     */
    public function getRefreshKey()
    {
        return $this->refreshSecretKey;
    }
}


// Get an instance of JwtHelper
$jwtHelper = JwtHelper::getInstance();

// Simulated client tokens
$accessToken = $_POST['access_token'] ?? null;
$refreshToken = $_POST['refresh_token'] ?? null;

// Simulated user data
$payload = [
    'id' => 1,
    'username' => 'john_doe'
];

// Handle the token flow
$response = $jwtHelper->handleTokenFlow($accessToken, $refreshToken, $payload);

// Return the response
header('Content-Type: application/json');
echo json_encode($response);
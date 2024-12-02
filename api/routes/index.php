<?php

class Router
{
    private $routes = [];

    /**
     * Add a route to the routing table
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $path Route path with optional parameters
     * @param callable $handler Callback function to handle the route
     */
    public function addRoute($method, $path, $handler)
    {

        $path = trim($path, '/');

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    /**
     * Dispatch the current request to the appropriate route handler
     *
     * @param string $requestMethod HTTP method of the request
     * @param string $requestUri Request URI
     */
    public function dispatch($requestMethod, $requestUri)
    {

        $requestUri = trim(parse_url($requestUri, PHP_URL_PATH), '/');
        $requestMethod = strtoupper($requestMethod);

        foreach ($this->routes as $route) {

            if ($route['method'] !== $requestMethod) {
                continue;
            }

            $pattern = $this->convertRouteToRegex($route['path']);

            if (preg_match($pattern, $requestUri, $matches)) {

                array_shift($matches);

                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                try {
                    $response = call_user_func_array($route['handler'], $params);

                    if ($response !== null) {
                        echo json_encode($response);
                    }
                    return;
                } catch (\Exception $e) {

                    http_response_code(500);
                    echo json_encode([
                        'error' => 'Internal Server Error',
                        'message' => $e->getMessage(),
                    ]);
                    return;
                }
            }
        }

        http_response_code(404);
        echo json_encode([
            'error' => 'Not Found',
            'requestMethod' => $requestMethod,
            'requestUri' => $_SERVER['REQUEST_URI'],
        ]);
    }

    /**
     * Convert a route path to a regex pattern
     *
     * @param string $path Route path with optional parameters
     * @return string Regex pattern
     */
    private function convertRouteToRegex($path)
    {

        $pattern = preg_quote($path, '/');

        $pattern = preg_replace_callback(
            '/\{([a-zA-Z0-9_]+)\}/',
            function ($matches) {
                return "(?P<{$matches[1]}>[^/]+)";
            },
            $pattern
        );

        return '/^' . $pattern . '$/';
    }
}
$router = new Router();

require_once 'license.php';

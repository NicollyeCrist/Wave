<?php
class Router {
    private array $routes = [];
    
    public function add(string $method, string $route, string $controllerOrView, string $action = '', bool $isView = false): void {
        $this->routes[$method][$route] = [
            'controller' => $controllerOrView,
            'action' => $action,
            'isView' => $isView
        ];
    }

    public function get(string $route, string $controllerOrView, string $action = '', bool $isView = false): void {
        $this->add('GET', $route, $controllerOrView, $action, $isView);
    }

    public function post(string $route, string $controllerOrView, string $action = '', bool $isView = false): void {
        $this->add('POST', $route, $controllerOrView, $action, $isView);
    }
    
    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = str_replace('/mesominds', '', $uri);
        $uri = rtrim($uri, '/');
        
        if (empty($uri)) {
            $uri = '/';
        }

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            if (!empty($route['isView'])) {
                $viewFile = __DIR__ . '/../view/' . $route['controller'];
                if (file_exists($viewFile)) {
                    require $viewFile;
                } else {
                    echo "View file not found: {$viewFile}";
                }
                return;
            }
            $controller = $route['controller'];
            $action = $route['action'];
            $controllerFile = __DIR__ . "/../controller/{$controller}.php";
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $action)) {
                        $controllerInstance->$action();
                    } else {
                        echo "Method {$action} not found in controller {$controller}";
                    }
                } else {
                    echo "Class {$controller} not found in file {$controllerFile}";
                }
            } else {
                echo "Controller file not found: {$controllerFile}";
            }
        } else {
            echo "Route not found: {$uri}<br>";
            echo "<pre>";
            print_r([
                'method' => $method,
                'uri' => $uri,
                'routes' => $this->routes
            ]);
            echo "</pre>";
        }
    }
}

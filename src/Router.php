<?php
/**
 * Created by PhpStorm.
 * User: xdsym
 * Date: 19/11/2018
 * Time: 12:33
 */
namespace Framework;
    class Router
    {
        public function match($url, $routes)
        {
            if (isset($routes[$url])) {
                $this->initialize($url, $routes);
                return true;//static route found
            } else {
                if (preg_match('/\d+/', $url, $id)) {
                    $array = explode("/", $url);
                    $array[2] = "{" . "id" . "}";
                    $url = implode("/", $array);
                    if (isset($routes[$url])) {
                        $this->initialize($url, $routes);
                        return true;//dynamic route found
                    }
                } else {
                    echo "Route doesn't exist";
                    return false;
                }
            }
        }

        public function initialize($url, $routes)
        {
            $controller = $routes[$url]["controller"];
            $controller="\\App\\Controllers\\".$controller;
            $controllerObject = new $controller;
            $action = $routes[$url]["action"];
            $controllerObject->{$action}();
        }
}
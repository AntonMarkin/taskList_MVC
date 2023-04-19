<?php

class Route
{
    static function start()
    {
// контроллер и действие по умолчанию
        $controllerName = 'Main';
        $actionName = 'Index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);
// получаем имя контроллера
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }
// получаем имя экшена
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }
// добавляем префиксы
        $controllerName = $controllerName .'Controller';
        $actionName = 'action' . $actionName;

        $controllerFile = strtolower($controllerName) . '.php';
        $controllerPath = "app/controllers/" . $controllerFile;
        if (!file_exists($controllerPath)) {
            Route::ErrorPage404();
        }
        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}

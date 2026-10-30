<?php
namespace App\Core;

final class Router {

    public array $routes;
    public array $craft;

    public View $view;
    public function __construct(array $routes, View $view,array $craft = []) {
        $this->routes = $routes;
        $this->view = $view;
        $this->craft = $craft;
    }
    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as [$routeMethod, $routePath, [$class, $action]]) {
            if ($routeMethod === $request->method && $request->path === $routePath) {
                $controller = ($this->craft[$class])();
                return $controller->$action($request);
            }
        }
        return $this->view->render('404', ['path' => $request->path], 404);
    }
}
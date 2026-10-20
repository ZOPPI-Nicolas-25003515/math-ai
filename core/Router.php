<?php
namespace Core;

final class Router {
    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as [$routeMethod, $routePath, [$class, $action]]) {
            if ($routeMethod === $request->method && $request->path === $routePath) {
                $controller = ($this->craft[$class])();
                return $controller->action($request);
            }
        }
        return $this->view->render('404', ['chemin' => $request->path], 404);
    }
}
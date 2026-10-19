<?php

$root = __DIR__;
require_once $root . '/../vendor/autoload.php'; //AutoLoader de composer
require_once $root . '/../core/AutoLoader.php';
use Core\View;
use Core\Controller;
use Core\Db;
use App\Controller\{HomeController,
    LoginController,
    RegisterController,
    ForgottenpasswordController,
    ResetpasswordController,
    ContactController,
    MentionsController,
    SitemapController};
use App\Model\UserRepository;

session_start();
$repository = new UserRepository();
$controllers = [
    HomeController::class     => fn() => new HomeController(),
    LoginController::class      => fn() => new LoginController($repository),
    RegisterController::class => fn() => new RegisterController($repository),
    ForgottenpasswordController::class => fn() => new ForgottenpasswordController($repository),
    ResetPasswordController::class => fn() => new ResetpasswordController($repository),
    ContactController::class => fn() => new ContactController(),
    MentionsController::class => fn() => new MentionsController(),
    SitemapController::class => fn() => new SitemapController()
];

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';   // "/login?x=1" -> "/login"
$path = rtrim($path, '/') ?: '/';

$routes = require $root . '/../core/config/routes.php';
$method = $_SERVER['REQUEST_METHOD'];
View::openBuffer();
foreach ($routes as [$routeMethod, $routePath, [$class, $action]]) {
    if ($routeMethod === $method && $path === $routePath) {
        $controller = $controllers[$class]();
        $controller->$action();
        $ViewContent = View::getBufferContent();
        echo View::show('Layout',array('body' => $ViewContent));
        exit;
    }

}
View::closeBuffer();
http_response_code(404);
View::show('404', ['path' => $path]);


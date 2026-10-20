<?php

$root = __DIR__;
require_once $root . '/../vendor/autoload.php'; //AutoLoader de composer
require_once $root . '/../core/AutoLoader.php';
use Core\{View,Request,Response};
use Core\Controller;
use Core\Db;
use App\Controller\{AnalyseiaController,
    AssistantiaController,
    ClassiaController,
    ExerciseiaController,
    HomeController,
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
    SitemapController::class => fn() => new SitemapController(),
    AssistantiaController::class => fn() => new AssistantiaController(),
    AnalyseiaController::class => fn() => new AnalyseiaController(),
    ExerciseiaController::class => fn() => new ExerciseiaController(),
    ClassiaController::class => fn() => new ClassiaController(),
];
$request = Request::fromGlobals();
$path = $request->path;
$method = $request->method;
$response = null;
$routes = require $root . '/../core/config/routes.php';
View::openBuffer();
foreach ($routes as [$routeMethod, $routePath, [$class, $action]]) {
    if ($routeMethod === $method && $path === $routePath) {
        $controller = $controllers[$class]();
        $response = $controller->$action();
        break;
    }

    if ($response == null) $response = View::render('404', ['path' => $request->path], 404);
}
$response->send();


<?php

$root = __DIR__;
require_once $root . '/../vendor/autoload.php'; //AutoLoader de composer
require_once $root . '/../core/AutoLoader.php';
use Core\{View,Request,Response};
use Core\Controller;
use Core\Db;


use App\Controller\{AnalyseiaController,
    ClassiaController,
    ExerciseiaController,
    AiassistantController,
    HomeController,
    LoginController,
    RegisterController,
    ForgottenpasswordController,
    ResetpasswordController,
    AccountsettingsController,
    SettingsController,
    ContactController,
    MentionsController,
    LoginchoiceController,
    ViewclassController,
    SitemapController,
    AddexerciseController,
    AddanswerexerciseController,
    AddclassController,
    RegisterchoiceController,
    RegisternotaffiliatedController,
    AddclassroomController};
use App\Model\UserRepository;

session_start();
$repository = new UserRepository();
$controllers = [
    HomeController::class     => fn() => new HomeController(),
    LoginController::class      => fn() => new LoginController($repository),
    RegisterController::class => fn() => new RegisterController($repository),
    ForgottenpasswordController::class => fn() => new ForgottenpasswordController($repository),
    ResetpasswordController::class => fn() => new ResetpasswordController($repository),
    AccountsettingsController::class => fn() => new AccountsettingsController($repository),
    SettingsController::class => fn() => new SettingsController($repository),
    ContactController::class => fn() => new ContactController(),
    MentionsController::class => fn() => new MentionsController(),
    SitemapController::class => fn() => new SitemapController(),
    AiassistantController::class => fn() => new AiassistantController(),
    AnalyseiaController::class => fn() => new AnalyseiaController(),
    ExerciseiaController::class => fn() => new ExerciseiaController(),
    ClassiaController::class => fn() => new ClassiaController(),
    AddexerciseController::class => fn() => new AddexerciseController($repository),
    AddclassController::class => fn() => new AddclassController($repository),
    LoginchoiceController::class => fn() => new LoginchoiceController(),
    ViewclassController::class => fn() => new ViewclassController($repository),
    AddanswerexerciseController::class => fn() => new AddanswerexerciseController(),
    RegisterchoiceController::class => fn() => new RegisterchoiceController(),
    RegisternotaffiliatedController::class => fn() => new RegisternotaffiliatedController($repository),
    AddclassroomController::class => fn() => new AddclassroomController($repository),
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


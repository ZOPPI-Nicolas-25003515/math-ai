<?php

use App\Core\{View,
    Env,
    Database,
    Router,
    Request};

use App\Controller\{AccountsettingsController,
    AddanswerexerciseController,
    AddclassController,
    AddclassroomController,
    AddexerciseController,
    Aianalysis,
    AiassistantController,
    ClassiaController,
    ContactController,
    ExerciseiaController,
    ForgottenpasswordController,
    HomeController,
    LoginchoiceController,
    LoginnotaffiliatedController,
    LoginteacherController,
    LogoutController,
    MentionsController,
    RegisterchoiceController,
    RegisternotaffiliatedController,
    RegisterteacherController,
    ResetpasswordController,
    SettingsController,
    SitemapController,
    ViewclassController};
use App\Model\UserRepository;


$root = __DIR__ . '/..';
require_once $root . '/vendor/autoload.php'; //AutoLoader de composer
require_once $root . '/app/Core/AutoLoader.php';

$env_path = $root. '/.env';
Env::load($env_path);
session_start();

$repository = new UserRepository(Database::connexion($root));

$view = new View($root . '/views', ['loggedUser' => $_SESSION['user'] ?? null]);

$craft = [
    AccountsettingsController::class => fn() => new AccountsettingsController($repository,$view),
    AddanswerexerciseController::class=> fn() => new AddanswerexerciseController($view),
    AddclassController::class=> fn() => new AddclassController($repository,$view),
    AddclassroomController::class=> fn() => new AddclassroomController($repository,$view),
    AddexerciseController::class=> fn() => new AddexerciseController($repository,$view),
    Aianalysis::class=> fn() => new Aianalysis($view),
    AiassistantController::class=> fn() => new AiassistantController($view),
    ClassiaController::class=> fn() => new ClassiaController($view),
    ContactController::class=> fn() => new ContactController($view),
    ExerciseiaController::class=> fn() => new ExerciseiaController($view),
    ForgottenpasswordController::class=> fn() => new ForgottenpasswordController($repository,$view),
    HomeController::class=> fn() => new HomeController($view),
    LoginchoiceController::class=> fn() => new LoginchoiceController($view),
    LoginnotaffiliatedController::class=> fn() => new LoginnotaffiliatedController($repository,$view),
    LoginteacherController::class=> fn() => new LoginteacherController($repository,$view),
    LogoutController::class=> fn() => new LogoutController($view),
    MentionsController::class=> fn() => new MentionsController($view),
    RegisterchoiceController::class=> fn() => new RegisterchoiceController($view),
    RegisternotaffiliatedController::class=> fn() => new RegisternotaffiliatedController($repository,$view),
    RegisterteacherController::class=> fn() => new RegisterteacherController($repository,$view),
    ResetpasswordController::class=> fn() => new ResetpasswordController($repository,$view),
    SettingsController::class=> fn() => new SettingsController($repository,$view),
    SitemapController::class=> fn() => new SitemapController($view),
    ViewclassController::class=> fn() => new ViewclassController($repository,$view),
];


$router = new Router(require $root . '/app/Core/config/routes.php', $view, $craft);

$router->dispatch(Request::fromGlobals())->send();


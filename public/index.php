<?php

use App\Core\{View,
    Env,
    Database,
    Router,
    Request};
use App\Controller\{HomeController,
    LoginController,
    RegisterController,
    ForgottenpasswordController,
    ResetpasswordController,
    SettingsController,
    ContactController,
    MentionsController,
    SitemapController,
    AiassistantController,
};
use App\Model\UserRepository;


$root = __DIR__ . '/..';
require_once $root . '/vendor/autoload.php'; //AutoLoader de composer
require_once $root . '/app/Core/AutoLoader.php';

$env_path = $root. '/.env';
Env::load($env_path);
session_start();

$repository = new UserRepository(Database::connexion($root));

$view = new View($root . '/app/View', ['loggedUser' => $_SESSION['user'] ?? null]);

$craft = [
    HomeController::class     => fn() => new HomeController($view),
    LoginController::class      => fn() => new LoginController($repository, $view),
    RegisterController::class => fn() => new RegisterController($repository, $view),
    ForgottenpasswordController::class => fn() => new ForgottenpasswordController($repository,$view),
    ResetPasswordController::class => fn() => new ResetpasswordController($repository,$view),
    SettingsController::class => fn() => new SettingsController($repository, $view),
    ContactController::class => fn() => new ContactController($view),
    MentionsController::class => fn() => new MentionsController($view),
    SitemapController::class => fn() => new SitemapController($view),
    AiassistantController::class => fn() => new AiassistantController($view)
];

$router = new Router(require $root . '/app/Core/config/routes.php', $view, $craft);

$router->dispatch(Request::fromGlobals())->send();


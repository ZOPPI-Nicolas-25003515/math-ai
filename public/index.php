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
    ContactController,
    MentionsController,
    SitemapController};
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
    HomeController::class     => fn() => new HomeController($view),
    LoginController::class      => fn() => new LoginController($repository, $view),
    RegisterController::class => fn() => new RegisterController($repository),
    ForgottenpasswordController::class => fn() => new ForgottenpasswordController($repository),
    ResetPasswordController::class => fn() => new ResetpasswordController($repository),
    ContactController::class => fn() => new ContactController(),
    MentionsController::class => fn() => new MentionsController(),
    SitemapController::class => fn() => new SitemapController(),
];

$router = new Router(require $root . '/app/Core/config/routes.php', $view, $craft);

$router->dispatch(Request::fromGlobals())->send();


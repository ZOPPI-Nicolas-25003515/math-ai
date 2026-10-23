<?php

use Core\{View,Env,Database,Router,Request,Response};
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
require_once $root . '/core/AutoLoader.php';


Env::load($root. '/.env');
session_start();

$repository = new UserRepository(Database::connexion());
$view = new View($root . '/Views', ['loggedUser' => $_SESSION['user'] ?? null]);
$router = new Router(require $root . '/core/config/routes.php', [/* craft */], $view);

$router->dispatch(Request::fromGlobals())->send();


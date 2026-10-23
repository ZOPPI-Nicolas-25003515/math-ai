<?php

use App\Controller\{HomeController,
    LoginController,
    RegisterController,
    ForgottenpasswordController,
    ResetpasswordController,
    ContactController,
    MentionsController,
    SitemapController,
    AiassistantController};

return [
    ['GET', '/', [HomeController::class, 'homeForm']],
    ['GET', '/home', [HomeController::class, 'homeForm']],
    ['GET', '/login', [LoginController::class, 'loginForm']],
    ['POST', '/login', [LoginController::class, 'loginAction']],
    ['GET', '/register', [RegisterController::class, 'registerForm']],
    ['POST', '/register', [RegisterController::class, 'registerAction']],
    ['GET', '/logout', [LoginController::class, 'logoutAction']],
    ['GET', '/forgottenpassword', [ForgottenpasswordController::class, 'forgottenpasswordForm']],
    ['POST', '/forgottenpassword', [ForgottenpasswordController::class, 'forgottenpasswordAction']],
    ['GET', '/resetpassword', [ResetpasswordController::class, 'resetpasswordForm']],
    ['POST', '/resetpassword', [ResetpasswordController::class, 'resetpasswordAction']],
    ['GET', '/sitemap', [SitemapController::class, 'sitemapForm']],
    ['GET', '/contact', [ContactController::class, 'contactForm']],
    ['GET', '/mentions', [MentionsController::class, 'mentionsForm']],
    ['GET', '/aiassistant', [aiassistantController::class, 'mathForm']],
    ['POST', '/aiassistant', [aiassistantController::class, 'mathAction']],
];
<?php

use App\Controller\{HomeController,
    LoginController,
    RegisterController,
    ForgottenpasswordController,
    ResetpasswordController,
    ContactController,
    MentionsController,
    SitemapController,
    AiassistantController,
    SettingsController};

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
    ['GET', '/aiassistant', [AiassistantController::class, 'aiassistantForm']],
    ['POST', '/aiassistant', [AiassistantController::class, 'aiassitantAction']],
    ['GET', '/settings', [SettingsController::class, 'settingsForm']],
    ['POST', '/settings', [SettingsController::class, 'deleteAction']]
];

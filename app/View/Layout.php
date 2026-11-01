<?php
namespace App\View;
use App\Model\User;
use App\View\Container;
final class Layout extends Component
{
    /**
     * @param string $title
     * @param User $user
     * @param array $content
     */
    public function __construct(
            private readonly string $title,
            private readonly User $user,
            private readonly array $content) {
    }

    public function render(): string
    {
        $title = $this->e($this->title);
        $user = $this->user;
        $nav = $this->renderAll($this->user == null
                ? [new Hypertext('/', ['MathAI']), ' | ', new Hypertext('/login', ['Connexion']), ' | ', new Hypertext('/register', ['Inscription'])]
                : [new Hypertext('/', ['MathAI']), ' | ', new Hypertext('/logout', ['Déconnexion'])]);
        $footer = $this->renderAll([new Container('footer',
                [new Container('ul',[
                        new Container('li',[new Hypertext('/',['Accueil'])]),
                        new Container('li',[new Hypertext('/sitemap',['Plan du site'])]),
                        new Container('li',[new Hypertext('/contact',['Nous contacter'])]),
                        new Container('li',[new Hypertext('/mentions',['Mentions légales'])])])],
                'footer')]);
        $links = $this->renderAll([new Link ('icon', '/res/image/logoMathAi.ico','image/x-icon'),new Link ('stylesheet', '/res/css/style.css')]);
        $par = $this->renderAll($this->content);

        return <<<HTML
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <link rel="icon" type="image/x-icon" href="/res/image/logoMathAi.ico">
                    <link rel="stylesheet" href= "/res/css/style.css">
                    {$this->e($title)}
                </head>
                <body>
                <header>
                    {$nav}
                </header>

                <main>
                    {$par}
                </main>
                
                {$footer}
                </body>
                </html>
                HTML;
    }
}



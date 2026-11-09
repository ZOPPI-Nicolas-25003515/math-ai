<?php
namespace App\View;
use App\Model\User;
final class Layout extends Component
{
    /**
     * @param string $title
     * @param bool $isLogged
     * @param array $content
     * */

    public function __construct(
            private readonly string $title,
            private readonly bool $isLogged,
            private readonly array $content
    ) {
    }

    public function render(): string
    {
        $title = $this->e($this->title);
        $nav = $this->renderAll(!$this->isLogged
                ? [new Hypertext('/', ['MathAI']),new Hypertext('/aiassistant', ['Assistant IA']), new Hypertext('/login', ['Connexion']), new Hypertext('/register', ['Inscription'])]
                : [new Hypertext('/', ['MathAI']),new Hypertext('/aiassistant', ['Assistant IA']), new Hypertext('/settings', ['Paramètres'])]);
        $footer = $this->renderAll([new Container('footer',
                [new Container('ul',[
                        new Container('li',[new Hypertext('/',['Accueil'])]),
                        new Container('li',[new Hypertext('/sitemap',['Plan du site'])]),
                        new Container('li',[new Hypertext('/contact',['Nous contacter'])]),
                        new Container('li',[new Hypertext('/mentions',['Mentions légales'])])])],
                'footer')]);
        $links = $this->renderAll([new Link ('icon', '/res/image/logoMathAi.ico','type="image/x-icon"'),new Link ('stylesheet', '/res/css/style.css')]);
        $par = $this->renderAll($this->content);
/*
 * A ajouter :
 * <script src="/res/js/mathjax-config.js"></script>
 * <script defer src="/res/js/mathjax.js"></script>
 */

        return
                <<<HTML
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    {$links}
                    
                    <script defer src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
                    <script defer src="/res/js/main.js"></script>
                    <title>{$this->e($title)}</title>

                </head>
                <body>
                <header>
                <nav>
                    {$nav}
                </nav>
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



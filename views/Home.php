<?php
use App\View\{Alert,Button,Form,Input,Layout,Link,Hypertext,Paragraph,Title,Container};

/**
 * @param array $loggedUser
 */

echo (new Layout('MathAi',isset($loggedUser),[
isset($loggedUser) ? new Title(
        2,['Bonjour, ' . $loggedUser['email']]) : '',
    new Title(
            1,['Accueil']),
    new Paragraph(['Une application web interactive destinée aux lycéens, permettant d’explorer l’utilisation des intelligences artificielles génératives, et notamment des LLM, pour apprendre les mathématiques.'],'id=homeDescription'),
    new Container('div',[
            new Hypertext('/analyseia',[
                    new Container('div',[
                            new Title(2,['Analyse la réponse d\'une LLM']),
                        new Paragraph(['Paragraphe'])
                    ], 'class=infoCard')
            ],'class=cardTitle')
    ],'class=infoCard-grid')
]))->render();













/*
$isLogged = isset($_SESSION['email']);
if($isLogged) {
    <h2> Bonjour, $_SESSION['email']</h2>
}
<h1>Accueil</h1>
    <p id="homeDescription">Une application web interactive destinée aux lycéens, permettant d’explorer l’utilisation des intelligences artificielles génératives, et notamment des LLM, pour apprendre les mathématiques.</p>
<?php
if($_SESSION['role'] == 'teacher'){?>
    <a class="cardTitle" href="/addclass">
        <h2>Ajouter cours</h2>
    </a>
    <a class="cardTitle" href="/addexercise">
        <h2>Ajouter exercice</h2>
    </a>
    <a class="cardTitle" href="/addclassroom">
        <h2>Ajouter une classe</h2>
    </a><?php
}
?>
<div class="infoCard-grid">
    <a class="cardTitle" href="/analyseia">
        <div class="infoCard">
            <h2>analyse la réponse de l'IA</h2>
            <p>
                Paragraphe
            </p>
        </div>
    </a>
for ($i = 1; $i <= 11; $i++) {
    <a class="cardTitle" href="/login.php?url='title' .  $i">
    <div class="infoCard">
    <h2>Title$i</h2>
    <p>
    Paragraphe
    </p>
    </div>
    </a>

}
</div>
*/

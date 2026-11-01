<?php
use App\View\{Alert,Button,Form,Input,Layout,Link,Hypertext,Paragraph,Title,Container};

echo new Layout('MathAi',$loggedUser,[
$loggedUser === null ? null : new Title(
        2,['Bonjour, ' . $loggedUser]),
    new Title(
            1,['Accueil']),
    new Paragraph(['Une application web interactive destinée aux lycéens, permettant d’explorer l’utilisation des intelligences artificielles génératives, et notamment des LLM, pour apprendre les mathématiques.','homeDescription']),
    new Container('div',[
            new Hypertext('/analysisia',[
                    new Container('div',[
                            new Title(2,['Analyse la réponse d\une LLM']),
                        new Paragraph(['Paragraph'])
                    ])
            ],'cardTitle')
    ],'infoCard-grid')

]);














$isLogged = isset($_SESSION['email']);
if($isLogged) {?>
    <h2> Bonjour, <?=$_SESSION['email']?></h2><?php
}?>
<h1>Accueil</h1>
<p id="homeDescription">Une application web interactive destinée aux lycéens, permettant d’explorer l’utilisation des intelligences artificielles génératives, et notamment des LLM, pour apprendre les mathématiques.</p>
<div class="infoCard-grid">
    <a class="cardTitle" href="/analyseia">
        <div class="infoCard">
            <h2>analyse la réponse de l'IA</h2>
            <p>
                Paragraphe
            </p>
        </div>
    </a><?php
for ($i = 1; $i <= 11; $i++) {?>
    <a class="cardTitle" href="/login.php?url=<?='title' .  $i?>">
    <div class="infoCard">
    <h2>Title<?=$i?></h2>
    <p>
    Paragraphe
    </p>
    </div>
    </a>
    <?php
}
?>
</div>
<?php


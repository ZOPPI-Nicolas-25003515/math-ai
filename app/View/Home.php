<?php
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


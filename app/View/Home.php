<?php
$isLogged = isset($_SESSION['email']);
if($isLogged) {?>
    <h2> Bonjour, <?=$_SESSION['email']?></h2><?php
}?>
<h1>Accueil</h1>
<p id="homeDescription">Bienvenue sur Math-Ai, le premier site de cours de mathématique programme lycée entièrement géré par l’intelligence artificielle ! Il va comporter grand nombre de cours et exercices, qui seront entièrement générés par l’intelligence artificielle !</p>
<div class="infoCard-grid">
    <a class="cardTitle" href="/analyseia">
        <div class="infoCard">
            <h2>analyse la reponse de l'ia</h2>
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


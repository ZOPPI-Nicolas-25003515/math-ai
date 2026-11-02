<?php

use App\Model\UserRepository;

$userRepository = new UserRepository();
$title = $userRepository->classTitleTeacher((int)$_SESSION['id'],$_SESSION['subject']);
?>
<h1>Cours sur la réponse de l'IA</h1>
<a href="/analyseia">Retour</a>

<?php
if($_SESSION['role'] == 'teacher'){?>
    <?php foreach ($title as $titl): ?>
        <a class="cardTitle" href="/viewclass?id=<?= $titl['id']?>" >
            <div class="infoCard">
                <h2><?= htmlspecialchars($titl['title']) ?></h2>
                <p>
                    Paragraphe
                </p>
            </div>
        </a>
    <?php endforeach;
}?>

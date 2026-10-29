<?php

use App\Model\UserRepository;

$userRepository = new UserRepository();
$title = $userRepository->classTitleTeacher((int)$_SESSION['teacher_id'],$_SESSION['subject']);
?>
<h1>Cours sur la reponse de l'IA</h1>
<a href="/analyseia">Retour</a>
<?php
var_dump($_SESSION['teacher_id']);
?>
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
    <?php endforeach; ?>

    <?php
}
?>
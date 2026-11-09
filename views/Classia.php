<?php

use App\View\{Alert,Button,Form,Input,Layout,Label,Hypertext,Paragraph,Title,Container,Select,Option};
use App\Model\UserRepository;

$userRepository = new UserRepository();
$title = $userRepository->classTitleTeacher((int)$_SESSION['id'],$_SESSION['subject']);
$contenu = [];

foreach ($title as $titl) {
    $contenu = new Hypertext("/viewclass?id=".$titl['id'],
            [new Container('div',
                    [new Title(2,[htmlspecialchars($titl['title'])])],'class="infoCard"')
    ],'class="cardTitle"');
}

if($_SESSION['role'] == 'teacher'){
    echo new Layout('vos cours',isset($loggedUser),
        [new Title (1,['Cours sur la réponse de l IA']
        ),new Container('span',
            [new Hypertext('/analyseia',['Retour']
            ), $contenu
            ]
        )]
    );
}

/*
<h1>Cours sur la réponse de l'IA</h1>
<span>
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
</span>
*/
?>
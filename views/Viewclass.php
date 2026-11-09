<?php
use App\View\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container,Select,Option};

$class = $A_view['class'] ?? [];
$pdfPath = '/resources/Class/' . htmlspecialchars($class['path_name']);

echo new Layout('viewclass',isset($loggedUser),
        [new Title (1,[htmlspecialchars($class['title']) ]
        ),new Hypertext('/analyseia',['Retour à la liste']
        ),new Container('div',
                [new Container('iframe',
                        [new Paragraph(['votre navigateur ne peut pas afficher les PDF directement.']
                        ),new Paragraph(['Vous pouvez ',new Hypertext('/downloadclass?id='.$class['id'],['le télécharger ici'])])

                        ],'src="/downloadclass?id='.$class['id'].'" width="100%" height="700px" style="border: 1px solid #ccc;"')

                ],'style="margin-top: 20px;"')

        ]);
/*

<h1><?= htmlspecialchars($class['title']) ?></h1>
<a href="/analyseia">Retour à la liste</a>

<div style="margin-top: 20px;">
    <iframe src="/downloadclass?id=<?= $class['id']?>" width="100%" height="700px" style="border: 1px solid #ccc;">
        <p>Votre navigateur ne peut pas afficher les PDF directement.
            Vous pouvez <a href="/downloadclass?id=<?= $class['id'] ?>">le télécharger ici</a>.
        </p>
    </iframe>
</div>

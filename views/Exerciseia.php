<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};


echo new Layout('vos exercise',isset($loggedUser),
        [new Container('span',
                [new Title(1,['Exercice sur la reponse de l IA']
                ),new Hypertext('/analyseia',['Retour'])
                ])
        ]
);
/*
<h1>Exercice sur la reponse de l'IA</h1>
<a href="/analyseia">Retour</a>
*/
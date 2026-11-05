<?php
use App\Tags\{Alert,Button,Form,Input,Layout,Link,Hypertext,Paragraph,Title,Container};

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
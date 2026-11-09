<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 */

echo new Layout ('Login',isset($loggedUser),
        [
                new Title (1,['Annaliser la reponse de l IA']),
                new Container ('div',
                        [new Hypertext('/classia',
                                [new Container('div',
                                                [new Title (2,['cours']
                                                ),new Paragraph (['Cours sur l analyse de l IA'])
                                                ],'class="infoCard"')
                                ],'class="cardTitle"'),
                        new Hypertext('/exerciseia',
                                [new Container('div',
                                        [new Title (2,['exercice']
                                        ),new Paragraph (['Exercice sur l analyse de l IA'])
                                        ],'class="infoCard"')
                                ],'class="cardTitle"')

                ],'class="infoCard-grid"')
        ]);

/*
<h1>Annaliser la reponse de l'IA</h1>
<div class="infoCard-grid">
    <a class="cardTitle" href="/classia">
        <div class="infoCard">
            <h2>cours</h2>
            <p>
                Cours sur l'analyse de l'IA
            </p>
        </div>
    </a>
    <a class="cardTitle" href="/exerciseia">
            <div class="infoCard">
                <h2>exercice</h2>
                <p>
                    exercice sur l'analyse de l'IA
                </p>
            </div>
        </a>
</div>
*/
?>

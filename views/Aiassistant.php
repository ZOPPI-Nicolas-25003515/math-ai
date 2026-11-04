<?php
use App\View\{Alert,Textarea,Button,Strong,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array<string> $errors
 */


echo new Layout (
        'Assistant IA',isset($loggedUser),[
                new Container('section',[
                        new Title(1,['MathAI']),
                    new Paragraph(['Pose ta question à la LLM']),
                    new Form ('/aiassistant','post',[
                            new Label('question','question',['Version : Chat GPT 4']),
                        new Textarea('question','question',5,2000,'Exemple : Résous 2x + 5 = 15','required',[htmlspecialchars($question ?? '', ENT_QUOTES, 'UTF-8')]),
                        new Button('submit','',['Envoyer'])
                    ]),
                    !empty($answer) ? new Container('section',[
                    new Title(2,['Réponse de l\'IA']),
                        new Paragraph([nl2br(htmlspecialchars($answer, ENT_QUOTES, 'UTF-8'))])
                    ],'class=answer') : new Paragraph([new Alert ($errors)],'class=error')
                ],'class=aiassistant')
        ]
);
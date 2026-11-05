<?php
use App\Tags\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 * @var string $token
 */

echo new Layout ('Réinitialisation do mot de passe',isset($loggedUser),[
        new Title (1,['Réinitialiser le mot de passe']),
    new Paragraph([new Alert($errors)]),
        new Container ('span',[
            new Form ('/resetpassword','post',[
                    new Container('ul',[
                            new Container('li',[
                                    new Label('password','password',['Mot de passe']),
                                new Input('password','password','password','class=textInput required')
                            ]),
                            new Container('li',[
                                    new Label('confirmation','confirmation',['Confirmation du mot de passe']),
                                    new Input('password','confirmation','confirmation','class=textInput required')
                            ]),
                        new Input('hidden', 'token','token', 'value=' . $token),
                        new Button ('submit','',['Valider'])
                    ])
            ])
        ])
]);

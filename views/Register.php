<?php
use App\Tags\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 */

echo new Layout ('Register',isset($loggedUser),[
        new Title (1,['Inscription']),
    new Paragraph([new Alert ($errors)]),
    new Container ('span',[
            new Form('/register','post',[
                    new Container('ul',[
                            new Container ('li',[
                                    new Label('email','email',['E-mail']),
                                            new Input('email','email','email','required')
                                    ]
                            ),
                            new Container ('li',[
                                            new Label('password','password',['Mot de passe']),
                                            new Input('password','password','password','required')
                                    ]
                            ),
                            new Container ('li',[
                                            new Label('confirmation','confirmation',['Confirmation du mot de passe']),
                                            new Input('password','confirmation','confirmation','required')
                                    ]
                            ),
                            new Button('submit','',['S\'inscrire'])
                    ]),


            ]),
            new Paragraph(['Vous avez déjà un compte ? Connectez-vous ', new Hypertext('/login',['ici']),'.'])
    ]),
]);

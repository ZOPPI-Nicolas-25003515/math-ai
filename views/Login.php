<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

/**
 * @param array $errors
 */

echo new Layout ('Login',isset($loggedUser),
        [
                new Title (1,['Connexion']),
                new Paragraph(
                        [new Alert ($errors)]),
            new Container ('span',[
                    new Form('/login','post',[
                    new Container('ul',[
                            new Container('li',[
                                new Label('email','email',['E-mail']),
                                    new Input('email','email','email','required')
                            ]),
                            new Container('li',[
                                new Label('password','password',['Password']),
                                    new Input('password','password','email','required')
                            ]),
                            new Button('submit','','Se connecter')
                            ])
                    ])
            ])
                ,new Paragraph(['Vous n\'avez pas de compte ? Inscrivez-vous ',
                            new Hypertext('/register',['ici']), '.'])
                ,new Paragraph([new Hypertext('/forgottenpassword',['Mot de passe oublié ?'])])
            ]);





























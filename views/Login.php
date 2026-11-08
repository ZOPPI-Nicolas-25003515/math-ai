<?php
use App\Tags\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
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
                                new Label('email','email',['Adresse mail']),
                                    new Input('email','email','email','required')
                            ],''),
                            new Container('li',[
                                new Label('password','password',['Mot de passe']),
                                    new Input('password','password','password','required'),
                                new Container('div',[
                                        new Hypertext('/forgottenpassword',['Mot de passe oublié ?'],'class=forgotpassword')],'class=rightPlaced')
                            ],'')
                            ],''),
                        new Container('li',[
                            new Button('submit','class=postButton',['Se connecter'])
                        ])

                    ])
                ,new Paragraph(['Vous n\'avez pas de compte ? Inscrivez-vous ',
                    new Hypertext('/register',['ici']), '.'],'')
            ],'')

            ]);

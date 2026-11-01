<?php
use App\View\{Alert,Button,Form,Input,Layout,Link,Hypertext,Paragraph,Title,Container};

echo new Layout ('Login',$loggedUser,
        [
                new Title (1,['Connexion']),
                new Paragraph(
                        [new Alert ($errors)]),
            new Container ('span',[
                    new Form('/login','post',[
                    new Container('ul',[
                            new Container('li',[
                                    new Input('email','E-mail','email')
                            ]),
                            new Container('li',[
                                    new Input('password','Mot de passe','password')
                            ]),
                            new Container('li',[
                                    new Button('submit','Se connecter')
                            ])
                    ])
            ])
                ,new Paragraph(['Vous n\'avez pas de compte ? Inscrivez-vous ',
                            new Hypertext('/register','ici'), '.'])
                ,new Paragraph([new Hypertext('/register','Mot de passe oublié ?')])
            ])

                ]
);
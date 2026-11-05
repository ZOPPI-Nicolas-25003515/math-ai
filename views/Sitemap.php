<?php

use App\Tags\{Alert,Button,Form,Input,Layout,Link,Hypertext,Paragraph,Title,Container};

echo new Layout('Site map',isset($loggedUser),[new Container('section',[
        new Title (1,['Plan du site']),
    new Container('ul',[
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/',['Accueil'])])
            ]) ,
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/register',['Inscription'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/login',['Connexion'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/forgottenpassword',['Réinitialisation du mot de passe'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/mentions',['Mentions légales'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/sitemap',['Plan du site'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/contact',['Contact'])])
            ]),
            new Container('li',[
                    new Title (3,[
                            new Hypertext('/aiassistant',['Assistant IA'])])
            ]),
    ])
],'class=sitemap')]);


<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 */

echo new Layout ('Login',isset($loggedUser),
    [
        new Title (1,['Connexion']),
        new Container ('span',[
            new Container('ul',[

                new Paragraph([new Hypertext('/login',['Professeur'])]),

                new Paragraph([new Hypertext('/loginstudent',['Eleve'])]),

                new Paragraph([new Hypertext('/login',['Non affilier'])]),
            ])
        ])
        ,new Paragraph(['Vous n\'avez pas de compte ? Inscrivez-vous ',
        new Hypertext('/register',['ici']), '.'])
        ,new Paragraph([new Hypertext('/forgottenpassword',['Mot de passe oublié ?'])])
    ]);


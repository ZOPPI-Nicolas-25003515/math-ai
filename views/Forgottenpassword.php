<?php
use App\Tags\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 * @var string $message
 */

echo new Layout ('Forgotten passsword',isset($loggedUser),[
    new Title(1,['Mot de passe oublié']),
        new Paragraph([$message]),
    new Container('span',[
            new Form ('/forgottenpassword','post',[
                    new Container('ul',[
                            new Container('li',[
                                    new Label ('email','label',['E-mail']),
                                new Input('email','email','email','required')
                            ]),
                            new Button('submit','',['Réinitialiser votre mot de passe'])
                    ])
            ]),
          new Paragraph(['Retour à la ',
                  new Hypertext('/login',['connexion'])])
    ])
]);

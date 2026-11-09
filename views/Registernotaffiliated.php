<?php

use App\View\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

$A_view = $A_view ?? [];
$error = $A_view['errors'];



/**
 * @var array $errors
 */

echo new Layout ('Register not_affiliated',isset($loggedUser),[
        new Title (1,['Inscription']),
        new Paragraph([new Alert ($errors)]),
        new Container ('span',[
                new Form('/register','post',[
                        new Container('ul',[
                                new Container ('li',[
                                                new Label('name','name',['Nom']),
                                                new Input('text','name','name','required')
                                        ]
                                ),
                                new Container ('li',[
                                                new Label('surname','surname',['Prenom']),
                                                new Input('text','surname','surname','required')
                                        ]
                                ),
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

/*

<h1>Inscription</h1>

<?php
if(!empty($error)){?>
    <p style="color: red;"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
   <form action="/registernotaffiliated" method="post">
     <ul>
         <li>
            <p>
                <label for="name">Nom</label>
                <input type="text" name="name" value="" required>
            </p>
        </li>
        <li>
            <p>
                <label for="surname">Prenom</label>
                <input type="text" name="surname" value="" required>
            </p>
        </li>
           <li>
              <li>
                <label id = "email" for = "email">E-mail</label>
                 <input class="textInput" type="email" name="email" required>
             </li>
         </li>
         <li>
             <li>
                 <label id = "password" for = "password" >Mot de passe</label>
                <input class="textInput" type="password" name="password" value="" required>
            </li>
         </li>
         <li>
            <li>
                <label id = "confirmation" for = "confirmation">Confirmation du mot de passe</label>
                <input class="textInput" type="password" name="confirmation" value="" required>
            </li>
         </li>
        <button type="submit">S'inscrire</button>
       </ul>
   </form>
   <p>vous avez déjà un compte ? Connectez vous <a href="/login">ici</a></p>
</span>
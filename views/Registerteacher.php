<?php

use App\View\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container,Select,Option};
use App\Model\UserRepository;

$A_view = $A_view ?? [];
$error = $A_view['errors'];
$userRepository = new UserRepository();
$highSchools = $userRepository->takeHighSchool();
$option = [];

foreach ($highSchools as $school) {
    $option = new Option(htmlspecialchars($school['id']), [htmlspecialchars($school['high_school_name'])]);
}





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
                                new Container ('li',
                                        [new Select('high_school', 'high_school',
                                                [new Option('', ['-- Choisissez un lycée --']),$option]
                                        )]
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
   <form action="/registerteacher" method="post">
     <ul>
         <li>
            <p>
                <label for="teachername">Nom</label>
                <input type="text" name="teachername" value="" required>
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
                <label id = "label" for = "email">E-mail</label>
              </li>
             <li>
                 <input class="textInput" type="email" name="email" required>
             </li>
         </li>
         <li>
             <li>
                 <label id = "label" for = "password" >Mot de passe</label>
             </li>
             <li>
                <input class="textInput" type="password" name="password" value="" required>
            </li>
        </li>
        <li>
            <li>
                <label id = "label" for = "confirmation">Confirmation du mot de passe</label>
            </li>
            <li>
                <input class="textInput" type="password" name="confirmation" value="" required>
            </li>
        </li>
         <li>
            <select name="high_school" id="high_school">
                <option value="">-- Choisissez un lycée --</option>

                <?php foreach ($highSchools as $school): ?>
                    <option value="<?= htmlspecialchars($school['id']) ?>">
                <?= htmlspecialchars($school['high_school_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
        <button type="submit">S'inscrire</button>
       </ul>
   </form>
   <p>vous avez déjà un compte ? Connectez vous <a href="/login">ici</a></p>
</span>
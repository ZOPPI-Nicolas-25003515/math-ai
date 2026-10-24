<?php

use App\Model\UserRepository;

$A_view = $A_view ?? [];
$error = $A_view['errors'];
$userRepository = new UserRepository();
$highSchools = $userRepository->takeHighSchool();
?>

<h1>Inscription</h1>

<?php
if(!empty($error)){?>
    <p style="color: red;"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
   <form action="/register" method="post">
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
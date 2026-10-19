<?php
$A_view = $A_view ?? [];
$message = [];
$errors = $A_view['errors'];
$message = $A_view['message'];
?>

<h1>Réinitialiser le mot de passe</h1>

<?php
if(!empty($errors)){?>
    <p style="color: red;"><?=htmlspecialchars($errors[0])?></p><?php
}
if(!empty($message)){?>
    <p style="color: red;"><?=htmlspecialchars($message)?></p><?php
}
?>

<span>
   <form action="/resetpassword" method="post">
     <ul>
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
         <button type="submit">Valider</button>
       </ul>
   </form>
</span>
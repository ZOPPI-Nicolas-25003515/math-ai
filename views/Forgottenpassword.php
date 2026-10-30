<?php
$A_view = $A_view ?? [];
$message = $A_view['message']; ?>
    <h1>Mot de passe oublié</h1> <?php
if(!empty($message)){
    ?> <p style="color: red;"><?=htmlspecialchars($message)?></p><?php
} ?>
    <span>
    <form action="/forgottenpassword" method="post">
        <ul>
            <li>
               <p>
                   <label id = "label" for = "email">E-mail</label>
                   <input type="email" name="email" required>
               </p>
          </li>
          <button type="submit">Réinitialiser votre mot de passe</button>
      </ul>
    </form>
    <p>retour à la <a href="/login">connection</a></p>
    </span>
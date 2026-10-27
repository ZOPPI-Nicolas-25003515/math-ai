<?php

$A_view = $A_view ?? [];
$error = $A_view['errors'];
?>

<h1>Connexion</h1>

<?php
if(!empty($error)){?>
    <p style="color: red"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
    <form action="/loginteacher" method="post">
    <ul>
        <li>
            <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" value="" required>
            </p>
        </li>
        <li>
            <p>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" required>
            </p>
            </li>
            <button type="submit">Se connecter</button>
        </ul>
    </form>
    <p>vous n'avez pas de compte ? Inscrivez-vous <a href="/register">ici</a>.</p>
    <p><a href="/forgottenpassword">mot de passe oublié</a> ?
</span>
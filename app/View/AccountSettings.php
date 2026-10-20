<?php
$A_view = $A_view ?? [];
$error = $A_view['errors'] ?? [];
?>

<h1>Paramètres du compte</h1>

<?php if (!empty($error)) { ?>
    <p style="color: red;"><?= htmlspecialchars($error[0]) ?></p>
<?php } ?>

<section class="infoCard">
    <h2>Informations du compte</h2>
    <p><strong>Email :</strong> <?= htmlspecialchars($A_view['email'] ?? 'votre@email.com') ?></p>
    <p><strong>Statut :</strong> Compte actif</p>
</section>

<form action="/delete-account" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ?');">
    <button type="submit"> Supprimer le compte </button>
</form>

<p><a href="/">Retour à l'accueil</a></p>
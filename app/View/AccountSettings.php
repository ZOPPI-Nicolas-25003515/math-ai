<?php
$A_view = $A_view ?? [];
$error = $A_view['errors'] ?? [];
$showModal = !empty($error);
?>

<h1>Profile</h1>

<?php if (!empty($error)) { ?>
    <p style="color: red;"><?= htmlspecialchars($error[0]) ?></p>
<?php } ?>

<section class="infoCard">
    <h2>Informations du compte</h2>
    <p><strong>Email :</strong> <?= htmlspecialchars($A_view['email'] ?? 'votre@email.com') ?></p>
    <p><strong>Statut :</strong> Compte actif</p>
</section>

<section class="infoCard">
    <h2>Paramètres du compte</h2>
    <button><a id="buttons" href="/logout">Déconnexion</a></button>
    <button id="openDeleteModalBtn" type="button">Supprimer le compte</button>
</section>

<button><a id="buttons" href="/">Retour à l'accueil</a></button>

<div id="modalForm" class="popup_block<?= $showModal ? ' is-open' : '' ?>" aria-hidden="<?= $showModal ? 'false' : 'true' ?>">
    <div class="modal-backdrop" data-close-modal="true"></div>
    <div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="deleteAccountTitle">
        <button type="button" class="modal-close" data-close-modal="true" aria-label="Fermer la modale">×</button>
        <h3 id="deleteAccountTitle">Confirmation de suppression</h3>
        <p>Pour confirmer la suppression du compte, saisissez votre mot de passe.</p>

        <form id="deleteAccountForm" action="/settings" method="post">
            <label for="deletePassword">Mot de passe</label>
            <input id="deletePassword" type="password" name="password" autocomplete="current-password" placeholder="Votre mot de passe" required>

            <div class="modal-actions">
                <button type="button" class="secondary" data-close-modal="true">Annuler</button>
                <input type="submit" value="Supprimer mon compte">
            </div>
        </form>
    </div>
</div>
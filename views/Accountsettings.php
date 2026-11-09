<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Hypertext,Paragraph,Title,Container,Select,Option,Strong};

$A_view = $A_view ?? [];
$errors = $A_view['errors'] ?? [];
$showModal = !empty($error);


echo new Layout('parametre compte',isset($loggedUser),[
                new Title (1,['profile']),
                new Paragraph(
                        [new Alert ($errors)]),
                new Container('span',
                        [new Container('section',
                                [new Title('2',['Informations du compte']
                                ),new Paragraph([new Strong(['Email :']),htmlspecialchars($A_view['email'] ?? 'votre@email.com')]
                                ),new Paragraph([new Strong(['Statut :']),'Compte actif'])
                                ],'class="infoCard"'
                        ),new Container('section',
                                [new Title(2,['Paramètres du compte']
                                ),new Button('button','',[new Hypertext('/logout',['Déconnexion'],'id="buttons"')]
                                ),new Button('button','id="openDeleteModalBtn"',['Supprimer le compte'])
                                ],'class="infoCard"'
                        ),new Button('button','',[new Hypertext('/',['Supprimer le compte'],'id="buttons"')]
                        ),new Container('div',
                                [new Container('div',[],'class="modal-backdrop" data-close-modal="true"'
                                ),new Container('div',
                                        [new Button('button','class="modal-close" data-close-modal="true" aria-label="Fermer la modale"',['×']
                                        ),new Title(3,['Confirmation de suppression'],'id="deleteAccountTitle"'
                                        ),new Paragraph(['Pour confirmer la suppression du compte, saisissez votre mot de passe.']
                                        ),new Form('/settings','post',
                                                [new Label('deletePassword','deletePassword',['Mot de passe']
                                                ),new Input("password","deletePassword" ,"password" ,'autocomplete="current-password" placeholder="Votre mot de passe" required'
                                                ),new Container('div',
                                                        [new Button('button', '"secondary" data-close-modal="true"',['Annuler']
                                                        ),new Input('submit','delete','delete','value="Supprimer mon compte"')
                                                        ],'class="modal-actions"')

                                                ],'id="deleteAccountForm"')

                                        ],'class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="deleteAccountTitle"')

                                ], 'id="modalForm" class="popup_block' . $showModal ? ' is-open' : ('' . '" aria-hidden="' . $showModal ? 'false' : 'true' . '"'))
                        ],"multipart/form-data")
            ,]
);
/*
<h1>Profile</h1>

<?php if (!empty($error)) { ?>
    <p style="color: red;"><?= htmlspecialchars($error[0]) ?></p>
<?php } ?>

<span>
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
</span>
*/


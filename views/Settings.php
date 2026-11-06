<?php
use App\Tags\{Alert,Button,Strong,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

/**
 * @var array $errors
 */

$showModal = !empty($errors);

$condition = $showModal ? 'false' : 'true';
$popupCond = $showModal ? ('"popup_block is-open" ' . 'aria-hidden=' . $condition) : ('popup_block ' . 'aria-hidden=' . $condition);
$popupParams = 'id=modalForm class=' . $popupCond;

echo new Layout('Paramètres',isset($loggedUser),[
        new Title(1,['Profil']),
    new Container('section',[
            new Container('ul',[
                    new Container('li',[
                            new Title(2,['Informations du compte'])
                    ]),
                    new Container('li',[
                            new Paragraph([new Strong(['E-mail :']), $loggedUser['email'] ?? 'Vous n\'êtez pas connecté.'])
                    ]),
                    new Container('li',[
                            new Paragraph([new Strong(['Statut :']), isset($loggedUser) ? 'Compte actif' : 'Non connecté'])
                    ])
            ])
    ],'class=infoCard'),
        isset($loggedUser) ? new Container('section',[
                new Container('ul',[
                        new Container('li',[
                                new Title(2,['Paramètres du compte'])
                        ]),
                        new Container('li',[
                                new Button('submit','',[new Hypertext('/logout',['Déconnexion'],'id=buttons')])
                        ]),
                        new Container('li',[
                                new Button('button','id=openDeleteModalBtn',['Supprimer le compte'])
                        ]),
                        new Container('li',[
                                new Button('submit','',[new Hypertext('/profileresetpassword',['Réinitiliser le mot de passe'],'id=buttons')])
                        ])
                ])
        ],'class=infoCard') : '',
    new Button ('submit','',[new Hypertext('/',['Retour à l\'accueil'],'id=buttons')]),
    new Container('div',[
            new Container('div',[],'class=modal-backdrop data-close-modal=true'),
        new Container('div',[
                new Button('button','class=modal-close data-close-modal=true aria-label="Fermer la modale"',['×']),
            new Title (3,['Confirmation de suppression'],'id=deleteAccountTitle'),
                new Paragraph([new Alert($errors)]),
                new Paragraph(['Pour confirmer la suppression du compte, saisissez votre mot de passe.']),
            new Form('/settings','post',[
                    new Container('ul',[
                            new Container('li',[
                                    new Label('deletePassword','dPassword',['Mot de passe'])
                            ]),
                            new Container('li',[
                                    new Input ('password','deletePassword','password','autocomplete=current-password placeholder="Votre mot de passe"')
                            ])
                    ]),
                new Container('div',[
                        new Button('button','class=secondary data-close-modal=true',['Annuler']),
                    new Button('submit','',['Supprimer mon compte'])
                ],'class=modal-actions')
            ],'id=deleteAccountForm')
        ],'class=modal-panel role=dialog aria-modal=true aria-labelledby=deleteAccountTitle'),
    ],$popupParams )
]);

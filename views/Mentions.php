<?php
use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

echo new Layout ('Mentions',isset($loggedUser),[new Container('section',[
        new Title (1,['Mentions légales']),
    new Container('div', [
            new Container('ul',[
                    new Container('li',[
                            new Title (2,['Identité']),
                        new Paragraph(['Ce site a été créé par un groupe de 5 étudiants du BUT Informatique d\'Aix-en-Provence dans le cadre d\'un projet de deuxième année.'])
                    ]),
                    new Container('li',[
                            new Title (2,['Coordonnées']),
                            new Paragraph([' Puisqu\'il s\'agit d\'un projet universitaire, nous n\'avons pas de coordonnées pour que vous puissiez nous contacter.'])
                    ]),
                    new Container('li',[
                            new Title (2,['Mentions relative à la propriétée intellectuelle']),
                            new Paragraph(['Ce site Web relève des législations française et internationales sur le droit d\'auteur et sur la propriétée intellectuelle. Tous les droits de reproduction sont réservés, documents iconographiques et photographiques incluts, et se réfère à la convention de Berne pour la protection des oeuvres littéraires et artistiques.'])
                    ]),
                    new Container('li',[
                            new Title (2,['Mentions relatives à l\'hébérgement du site ']),
                            new Paragraph(['Ce site est hébergé sur Always data, disponible à l\'adresse suivante : ',new Hypertext('https://www.alwaysdata.com/fr/',['Always Data']),', avec son siège social au 91 rue Faubourg St Honoré 75008 Paris, Création de sites, hébergement.'])
                    ]),
                    new Container('li',[
                            new Title (2,['Notifications de contenu erroné']),
                            new Paragraph([' Si un utilisateur de ce site Web constate des informations erronées, ambigues, inexactes ou partiellement inexactes, ce dernier est tenu d\'en informer le propriétaire du site, afin de rectifier les informations.'])
                    ]),
                    new Container('li',[
                            new Title (2,['Contenu et mise à jour']),
                            new Paragraph(['Les informations mises à disposition sur ce site Web n\'ont qu\'une valeur indicative.
                    Le contenu de ce site Web peut comporter des oublis ou des erreurs, et est par ailleurs sujet à des modifications ou mises à jours sans préavis.
                    La responsabilitée du propriétaire du site ne peut en aucun cas être engagé quant au contenu figurants sur son site ou aux conséquences de ces dernières.
                    De plus, le propriétaire de ce site ne saurait être engagé au titre d\'un site tiers atteint via ce site Web.'])
                    ]),

                    new Container('li',[
                            new Title (2,['Modifications de la notice légale de ce site web']),
                            new Paragraph(['Le propriétaire de ce site Web se réserve le droit de modifier cette notice sans préavis. L\'utilisateur est donc tenu à consulter régulierement cette notice afin de prendre note des changements.'])
                    ]),
            ])
    ], 'class=mentions-liens')

],'class=mentions-legales')]);



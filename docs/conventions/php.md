# Conventions PHP

Ce document fixe les règles à suivre pour tout nouveau code PHP de MathAI. Le
projet utilise PHP 8.3 ou supérieur, Composer, l'autoload PSR-4 et une
architecture MVC complétée par des services et une couche d'accès aux données.

Le code existant n'est pas entièrement homogène. Ces règles servent de référence
pour les nouveaux développements et les modifications ciblées ; elles ne
justifient pas un renommage global sans besoin fonctionnel.

## Nommage et emplacement

- Respecter la correspondance PSR-4 déclarée dans `composer.json` : les classes
  de l'application sont dans le namespace `App\` et leurs fichiers se trouvent
  sous `app/`.
- Le namespace reflète le dossier, avec la même casse : par exemple
  `App\Controller`, `App\Core`, `App\Model`, `App\Service` et `App\Tags`.
- Nommer les classes et les fichiers de classe en `PascalCase`, avec un fichier
  par classe : `LoginController` dans `app/Controller/LoginController.php`.
- Nommer méthodes et propriétés en `camelCase`. Les constantes de classe sont
  en `UPPER_SNAKE_CASE`. Éviter les abréviations et les noms ambigus.
- Garder les vues PHP dans `app/View/`. Le nom transmis à `View::render()` doit
  correspondre exactement au nom du fichier, casse comprise, par exemple
  `render('Login')` pour `app/View/Login.php`.
- Garder les tests dans `tests/` et terminer leur nom de fichier par `Test.php`,
  par exemple `ControllerRoutingTest.php`.
- Les fichiers de configuration et scripts d'entrée ne contenant pas une
  classe peuvent conserver un nom descriptif en minuscules, comme
  `app/Core/config/routes.php` et `public/index.php`.

## Suffixes des classes

Utiliser un suffixe qui identifie clairement la responsabilité :

| Suffixe | Responsabilité | Exemple |
| --- | --- | --- |
| `Controller` | Traiter les actions HTTP et produire une réponse | `LoginController` |
| `Repository` | Lire et écrire les données persistées | `UserRepository` |
| `Service` | Encapsuler un service ou une intégration externe | `OpenRouterService` |
| `Exception` | Représenter une erreur applicative précise | `ControllerException` |
| `Test` | Identifier une classe de tests | `ControllerRoutingTest` |

Les objets métier gardent un nom de domaine sans suffixe, comme `User`. Une
classe dédiée à la validation doit porter le suffixe `Validator` (par exemple
`UserValidator`) ; `UserValidate` est le nom historique à ne pas reproduire.
Réserver `UserMail` aux responsabilités liées au courrier existantes ; pour
une nouvelle classe, choisir un nom qui exprime précisément son rôle, tel que
`UserMailer`.

Les classes d'infrastructure génériques (`Request`, `Response`, `Router`,
`View`, `Database`, `Env`) et les composants HTML (`Button`, `Input`, `Layout`)
ne prennent pas de suffixe artificiel.

## Architecture en couches

Le point d'entrée est `public/index.php`. Il charge l'autoload, initialise
l'environnement et la session, assemble les dépendances, crée le routeur et
envoie la réponse. Il ne contient pas de logique métier.

| Couche | Emplacement | Rôle et limites |
| --- | --- | --- |
| Présentation HTTP | `app/Controller/` | Reçoit un `Request`, valide les données d'entrée, coordonne le cas d'usage et retourne une `Response` ou le rendu d'une vue. Un contrôleur ne construit pas de SQL et ne contient pas le rendu HTML. |
| Vues | `app/View/` | Présentent les données reçues du contrôleur. Elles ne font ni accès aux données ni traitement métier ; échapper les données affichées et réutiliser les composants de `app/Tags/` lorsque c'est pertinent. |
| Métier | `app/Model/` | Contient les objets du domaine et les règles métier associées. Les entités ne dépendent ni des contrôleurs ni des vues. |
| Accès aux données | `app/Model/` (dépôts `*Repository`) | Encapsule les requêtes PDO et la persistance. Utiliser des requêtes préparées ; ne pas exposer les détails SQL aux contrôleurs ou aux vues. |
| Services | `app/Service/` | Porte les traitements applicatifs réutilisables et les intégrations externes, par exemple l'appel à OpenRouter. Ne dépend pas des vues. |
| Infrastructure commune | `app/Core/` | Fournit les mécanismes transverses : requête/réponse, routage, rendu, environnement, base de données et exceptions techniques. |
| Ressources statiques | `public/res/` | Contient CSS, JavaScript et images servis directement, sans logique métier PHP. |

Le flux attendu est :

```text
Navigateur -> public/index.php -> Core/Router -> Controller
                                              -> Model/Repository et Service
Controller -> View -> Response -> Navigateur
```

Les dépendances sont assemblées au point d'entrée (`public/index.php`) et
injectées aux contrôleurs. Garder les dépendances orientées vers les couches
appropriées : une vue ne dépend pas d'un dépôt, et le métier ne dépend pas du
protocole HTTP.

## Règles de code

- Suivre un format cohérent de type PSR-12 : indentation de quatre espaces,
  accolades lisibles, une instruction par ligne et aucun espace final.
- Chaque fichier de code commence par `<?php` et omet la balise de fermeture
  `?>`.
- Pour tout nouveau fichier de classe, déclarer le namespace avant les imports,
  regrouper les imports après le namespace et utiliser des noms pleinement
  qualifiés plutôt que des inclusions manuelles. Composer est l'autoloader de
  référence.
- Pour tout nouveau code, déclarer `strict_types=1`, typer les paramètres,
  propriétés et valeurs de retour, et préciser les valeurs nullables. Préférer
  des types précis à `mixed`; utiliser `readonly` lorsque l'état ne doit pas
  changer après construction.
- Garder les méthodes courtes et centrées sur une responsabilité. Extraire une
  règle métier ou une intégration réutilisable plutôt que de la dupliquer dans
  plusieurs contrôleurs.
- Ne jamais concaténer une entrée utilisateur dans du SQL : utiliser les
  requêtes PDO préparées. Ne jamais intégrer de secret ou de donnée
  d'environnement dans le code ; lire la configuration via les mécanismes du
  projet et ne pas committer le fichier `.env`.
- Échapper les données au moment de leur sortie HTML. Ne pas considérer une
  donnée reçue comme fiable, même si elle provient d'un formulaire.
- Signaler les erreurs de manière explicite et adaptée au contexte. Ne pas
  masquer une erreur avec une valeur de repli qui ressemble à un succès.
- Ajouter ou mettre à jour les tests PHPUnit pour le comportement modifié.
  Vérifier les changements avec `composer check` (PHPStan puis PHPUnit).
- Pour les dépendances, utiliser Composer et maintenir `composer.lock` à jour
  lorsque `composer.json` change. Ne pas versionner `vendor/`.

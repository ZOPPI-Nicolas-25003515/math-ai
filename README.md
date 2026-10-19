# MathAI

Projet de développement web réalisé dans le cadre du module R3.01. L’application utilise une architecture MVC en PHP.

- **Maquette Figma** : [https://www.figma.com/design/RkEKAqYKMDIyW4lrNG88gB/Projet-Web?node-id=0-1&t=3iKZ6zowKWYxOzEI-1](https://www.figma.com/design/RkEKAqYKMDIyW4lrNG88gB/Projet-Web?node-id=0-1&t=3iKZ6zowKWYxOzEI-1)

  
- **Equipe** : OLS Lucas, SEILLER William, SISE Aboubakar, ZOPPI Nicolas

- [Le site](https://webserver-s301.alwaysdata.net/)

## Prérequis

- PHP 8.4 ou supérieur, avec l’extension PDO
- Composer
- Une base de données compatible avec le pilote PDO configuré

## Architecture

```text
math-ai
├── app/                  # Code applicatif selon le modèle MVC
│   ├── .htaccess
│   ├── Controller/       # Actions et logique des pages
│   ├── Model/            # Accès aux données et logique métier
│   └── View/             # Vues PHP affichées à l'utilisateur
├── Core/                 # Composants communs du framework
│   ├── AutoLoader.php    # Chargement automatique des classes
│   ├── config/           # Configuration PHP
│   │   └── php.ini
│   ├── Constants.php     # Chemins des composants du projet
│   ├── Controller.php    # Résolution et exécution des routes
│   ├── Db.php            # Connexion à la base de données
│   ├── env.php           # Chargement des variables d'environnement
│   ├── exceptions/       # Exceptions du framework
│   └── View.php          # Rendu des vues
├── public/               # Racine web de l'application
│   ├── .htaccess
│   ├── index.php         # Point d'entrée des requêtes
│   ├── res/              # Ressources statiques
│   │   ├── css/          # Feuilles de style
│   │   ├── image/        # Images
│   │   └── js/           # Scripts JavaScript
│   ├── robots.txt
│   └── sitemap.xml
├── tests/                # Test unitaires PHPUnit
├── docs/                 # Documentation du projet
├── composer.json         # Dépendances et commandes Composer
├── composer.lock         # Versions installées des dépendances
├── .env.example          # Modèle de configuration locale
├── .gitignore
├── LICENSE
├── phpstan.neon          # Configuration de PHPStan
├── phpunit.xml           # Configuration de PHPUnit
└── README.md             # Présentation et instructions du projet
```

## Lancer le projet en local

Depuis la racine du projet :

```bash
composer install
```

Copiez `.env.example` vers `.env`, puis renseignez les paramètres de connexion à la base de données (`DB_DRIVER`, `DB_HOST`, `DB_NAME`, `DB_USERNAME`, `DB_PASSWORD`). Les paramètres SMTP sont à renseigner si l’envoi de courriels est nécessaire.

Démarrez le serveur PHP intégré :

```bash
php -S 127.0.0.1:8000 -t public
```

Ouvrez ensuite [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Qualité de code

## Vérifications

```bash
composer test
composer phpstan
```

## Documentation

- [Documentation du framework](docs/frameworks.md)
- [Création du mot de passe oublié](https://blog.crea-troyes.fr/5426/jour-17-systeme-pour-reinitialiser-un-mot-de-passe-oublie/)
- [Ancien Framework MVC](https://github.com/moinal/LP2020).
- [Répo MVC-Explication](https://github.com/hadeli/MVC-Explication)
- [Documentation PHP](https://www.php.net/docs.php)

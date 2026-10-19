# Framework de test et d'analyse
L'implementation de **PHPStan** (analyse statique) et **PHPUnit** (tests unitaires et d'intégration) permet de garantir  la qualité et la robustesse du framework.<br>

## Installation
Exécutez la commande suivante à la racine de votre projet pour installer PHPStan et PHPUnit en dépendances de développement : <br>
```bash
composer require --dev phpstan/phpstan phpunit/phpunit
```

## Configuation
### Prérequis :
- **PHP** >= 8.4
- **Composer** installé sur votre machine

### PHPStan (phpstan.neon)
Créez le fichier `phpstan.neon` à la racine de votre projet :
```text
parameters:
    level: 6
    paths:
        - app
        - noyau
        - public
    excludePaths:
        - vendor
```
### PHPUnit (phpunit.xml)
Créez le fichier `phpunit.xml` à la racine du projet :
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true">
    <testsuites>
        <testsuite name="Framework Test Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>noyau</directory>
        </include>
    </source>
</phpunit>
```
### Scripts Composer (composer.json)

Mettez à jour votre fichier composer.json pour ajouter les raccourcis de commande dans la section `scripts` :
```json
{
    "require-dev": {
        "phpunit/phpunit": "^13.3",
        "phpstan/phpstan": "^2.2"
    },
    "scripts": {
        "test": "phpunit",
        "phpstan": "phpstan analyse",
        "check": [
            "@phpstan",
            "@test"
        ]
    }
}
```
## Commandes Essentielles

| Commande | Description |
| :--- | :--- |
| `composer phpstan` | Lance l'analyse statique basée sur `phpstan.neon` |
| `composer test` | Exécute l'ensemble de la suite de tests |
| `composer test:coverage` | Génère un rapport de couverture de code dans la console |
| `vendor/bin/phpstan analyse --level=8 <nom_dossier>` | Lance une analyse temporaire à un niveau plus strict (ex: Niveau 8) |
| `vendor/bin/phpstan generate-baseline` | Génère une ligne de base (baseline) pour ignorer temporairement les erreurs existantes |
| `vendor/bin/phpunit tests/Test.php` | Exécute un fichier de test spécifique |
| `vendor/bin/phpunit --filter test_route_dispatch` | Exécute un test spécifique selon son nom |
| `vendor/bin/phpunit --coverage-html coverage` | Génère un rapport de couverture HTML dans le dossier `./coverage` |

### Validation global 
```bash
composer check
```

## Documentaion
- [Documentation PHPStan](https://phpunit.de/documentation.html)
- [Documentation PHPUnit](https://docs.phpunit.de/en/13.3/)
- [Documentation Composer](https://getcomposer.org/doc/)
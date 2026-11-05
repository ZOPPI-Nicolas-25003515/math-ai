# Conventions Git

Ces règles s'appliquent aux branches et aux commits du projet MathAI. Les
messages historiques n'étant pas tous uniformes, utiliser le format ci-dessous
pour toute nouvelle contribution.

## Branches

- Créer une branche de travail dédiée ; éviter les commits directs sur `main`.
- Préfixer son nom par le type de travail, puis ajouter un sujet court en
  minuscules et en `kebab-case` :

| Préfixe | Utilisation |
| --- | --- |
| `feat/` | Nouvelle fonctionnalité |
| `fix/` | Correction de bogue |
| `docs/` | Documentation |
| `refactor/` | Réorganisation sans changement fonctionnel attendu |
| `test/` | Ajout ou modification de tests |
| `chore/` | Maintenance et tâches techniques |

Exemples : `feat/reset-password`, `fix/router-dispatch`,
`docs/php-conventions`.

## Format des commits

Écrire le sujet d'un commit selon le format Conventional Commits :

```text
<type>(<scope>): <résumé à l'impératif>
```

- Écrire le type et le scope en minuscules, sans espace avant les deux-points.
- Choisir un type parmi `feat`, `fix`, `docs`, `style`, `refactor`, `test`,
  `build`, `ci`, `chore`, `perf` ou `revert`.
- Le scope est facultatif ; lorsqu'il est utile, il désigne la partie modifiée,
  par exemple `auth`, `router`, `core`, `controller`, `model`, `service`,
  `view`, `tests`, `docs` ou `deps`.
- Rédiger le résumé en français, à l'impératif, en une phrase courte. Commencer
  par une minuscule et ne pas terminer par un point.
- Décrire le changement apporté, pas seulement le fichier modifié. Un commit
  doit rester cohérent et porter sur un seul objectif.

Exemples :

```text
feat(auth): ajouter la réinitialisation du mot de passe
fix(router): corriger la correspondance des routes
docs(conventions): documenter les règles PHP et Git
test(user): couvrir la suppression d'un compte
refactor(core): injecter les dépendances du routeur
```

## Corps et références

Le corps est facultatif. L'ajouter lorsque le sujet ne suffit pas à expliquer
la raison du changement ou ses conséquences. Séparer le sujet du corps par une
ligne vide et rester concis.

Pour un changement incompatible, le signaler dans le corps avec un pied de
commit `BREAKING CHANGE: <description>`. Référencer une issue si elle existe,
par exemple `Refs #42`.

## Avant de committer

- Exécuter les vérifications adaptées au changement ; pour le code PHP,
  lancer `composer check`.
- Relire `git diff` et `git status` afin de ne pas inclure de fichiers sans
  rapport avec le changement.
- Ne jamais committer `.env`, des clés, mots de passe ou autres secrets.
- Ne pas ajouter `vendor/` ; committer `composer.lock` lorsqu'une modification
  des dépendances le nécessite.
- Ne pas inclure de fichiers générés ou temporaires qui ne sont pas requis par
  le projet.
- Si plusieurs changements indépendants sont prêts, les séparer en commits
  distincts et ciblés.

Les commits de fusion créés par Git ou GitHub peuvent conserver leur format
automatique ; les règles de sujet ci-dessus visent les commits de développement
rédigés par l'équipe.

# PBC - Pilotage Budgétaire des Conventions

[![DOI](https://www.zenodo.org/badge/172482280.svg)](https://www.zenodo.org/badge/latestdoi/172482280)

Outil à destination des unités de recherche pour suivre leurs conventions et dotations budégtaires

**_En cours de développement :_** à utiliser uniquement dans un environnement de test. La documentation n'est pas encore disponible.

## Historique des versions

### v0.4-dev

- ajout d'un champ 'précision' aux lignes budgétaires
- ajout d'un tableau de consommation du budget
- ergonomie : affichage du titre des tables enfants
- mise à jour AppGini 5.92

### v0.3

- changement du statut *réservé* des dépenses en *non liquidé*. **ATTENTION :** cela entraîne une rupture de compatibilité avec la version 2.0. (voir ci-dessous)
- ajout des rubriques de ventilation
- calcul des salaires restant à verser par ligne budgétaire
- ajout d'un script de sauvegarde automatique de la base de données (https://forums.appgini.com/phpbb/viewtopic.php?f=4&t=3341)
- ajout d'un champ 'chef de projet' sur les fiches convention
- ajout d'un champ 'référence' sur les dépenses
- ajout d'un système de vérification des dépenses
- ajout d'un lien vers la documentation

En raison de la rupture de compatibilité entre la version 0.2 et la version 0.3, exécutez le code SQL ci-dessous juste avant de procéder à la mise à jour. Sinon, vous perdrez l'information concernant le statut des dépenses (elles seront toutes considérées comme non liquidées).

```sql
ALTER TABLE depenses ADD COLUMN `liquidee` TINYINT null AFTER statut
UPDATE `depenses` SET `liquidee`=1 WHERE `statut`='liquidée'
```

### v0.2

- gestion des recrutements prévus sur les conventions
- ajout du champs 'Exercice comptable' aux lignes de crédits. Dans le cadre d'une
  convention multi-année, il est donc nécessaire de prévoir des lignes de crédits
  différentes pour chaque année.
- amélioration des filtres de recherche grâce au plugin *Search Page Maker*

### v0.1

- première version de test

# LeBarD : Mise en Oeuvre

## Acteurs

- Rémi Mollandin ~~aka Lineal aka [ibdw.fr](http://ibdw.fr) à vendre 5$~~
- Théo Peuckert ~~aka Toast aka la salière~~
- Antoine Chapusot ~~aka Chap aka Fantôme~~
- Xavier Grimaldi ~~aka Xerx aka Application God~~
- Benoit Scholl ~~aka Gefclic aka DB Man~~

## Le choix des fonctionnalités

### Brainstorming avec Trello

Pour le cahier des charges, nous nous sommes reposé sur Trello pour communiquer nos idées autour du projet. Nous avons donc pris 30min de temps pour mettre des mots sur ce que nous a évoqué le projet.

### Transformation en tâches

Suite à cela, nous avons préciser certaines idées vague. Il nous a fallu aussi épurer les cartes afin de ne garder que les plus à propos. Puis atomiser ces dernières en tâches unitaires que l'on a finalement prioriser selon leurs degré d'importance.

## L'implémentation

### Démarrage

#### Affectation des tâches depuis Trello

Toujours via Trello, nous nous sommes affecté les tâches unitaires.
En prenant comme modèle le template docker fourni avec le sujet, nous avons pu nous abstraire de la partie technique middleware de tout projet web.

#### Découpage fichier du projet

Au niveau du squelette du projet, nous avons opéré le découpage suivant :

- **Database** : tout repose dans data/, l'architecture de la base de données se veut simple. 


- **Backend** : dans le dossier module, avec pour chaque objet (Product /news/Client...) un dossier : entity, repository, hydrator contenant réciproquement : les caractériqtiques de l'objet, les requêtes bases de données, les méthodes pour passer de l'un à l'autre.

- L'**autoloader** permet de charger les dépendances sur les modules du backend (namespaces)
  
- **Frontend** :
  
  - public/ correspond à la gestion du code php, à l'initialisation du code et des variables, et à l'appel des vues
  - view/ contient les vues html
  - public/assets/ contient toutes les ressources (js/images/etc...)
  - public/CSS/ contient les fichier CSS
  - data/ possède 3 copies de la DB
    - un sample avec des valeurs exemples
    - un export vide sans données avec seulement la structure de la DB
    - la DB actuelle, celle utilisée en prod

Nous avons ajouté un router initialisé via le fichier ".htaccess",et qui pointe sur index.php. C'est index.php qui s'occupe de charger les pages nécessaires en fonction de l'URL donné. Si l'URL est mauvaise ou inconnue, redirection sur la page 404.php, avec "mademoiselle oups"

- **Tests**

Dans le dossier public/ nous avons disposé des tests qui peuvent être lancés avec php.unit

#### Découpage du site

Le site tiens compte de la gestion du responsive qui pourra permettre d'adapter le contenu à une tablette et rendre l'application utilisable avec une tablette directement au bar : plus simple d'utilisation.

Deux parties au site :

- Partie utilisateur avec connexion obligatoire par Arise Id pour s'authentifier et accéder à l'application
- Partie administrateur/console , pour effectuer des commandes, créer et gérer des fonctionnalités du site: Gestion utilisateurs, news, produits, visualisation des transactions globales,etc...

L'utilisateur pourra visualiser son compte, ses informations, ses statistiques de consommation, les transactions effectuées, les news du bar, le catalogue du bar. Éventuellement d'autres features tel que le vote pour un nouveau produit.

La sécurité des pages est gérée au moyen de variable de session objet utilisateur/admin.

### Problèmes rencontrés

- Peu de problème de communication entre les membres de l'équipe
- Sous-estimation de la charge de travail

## Propositions d'améliorations

- Responsive design
- Remplacer dans le débit la saisie du mot de passe barman par une authent NFC (ID office de clé unique)
- Gestion news et produits
- Améliorer les shortcuts
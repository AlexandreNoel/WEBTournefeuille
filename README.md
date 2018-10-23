# PHAT-ADVISOR / ENSIIE OBDW2

## Install you application

* Change the parameters in .env file by your own values.
* To install and start the application run `make install`
* Your web site is running here [http://localhost:8080](http://localhost:8080)

## Start you application

```bash
# This command starts the application without installing anything.
make start
```

## Connect to the database

```bash
make db.connect
```

## Run unit tests

```bash
make phpunit.run
```

## Générer la doc (UML)

```bash
make doc.uml
```

## Les dossiers à connaitre

* postgres-data : Répertoire de données de la  DB
* public : contient l'index.php qui incluera des fichiers .php de src/ et le vendor/autoload.php
* data/phat-advisor.sql : contiendra les requêtes SQL pour la création du modèle physique de données (Tables etc) S'utilise à l'installation avec :

```bash
make db.install
```

* docs : contient toutes les documentations nécessaire

## Development

### Git

#### Basic commands

* Clone repository:

```bash
 git clone git@gitlab.com:Mianaan/phat_advisor.git
 ```

* Create new branch:

```bash
git checkout -B branch_name
```

* Download a branch:

```bash
git pull
```

* Go to another branch:

```bash
git checkout branch_name
```

* Stage changes before commit:

```bash
git add file1 file2`
```

* Commit changes:

```bash
git commit -m message
#ou
git commit
```

* Upload a branch:

```bash
git push
````

* Update *master* on current branch:

```bash
git rebase master
```

* Delete branch:

```bash
git branch -d branch_name`
```

#### Create a merge request

1. Login to GitLab
2. In *Repository -> Branches*
3. Click on the *Merge Request* button of your branch
4. Wait for approuval, it will be merge to *master*

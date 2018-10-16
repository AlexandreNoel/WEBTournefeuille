# PHAT-ADVISOR / ENSIIE Project Skeleton

## Install you application
* Change the parameters in .env file by your own values.
* To install and start the application run `make install`
* Your web site is running here [http:localhost:8080](http:localhost:8080)

## Start you application
`make start`

This command starts the application without installing anything.

## Connect to the database
`make db.connect`

## Run unit tests
`make phpunit.run`

## Les dossiers à connaitre
- postgres-data : Répertoire de données de la  DB
- public : contient l'index.php qui incluera des fichiers .php de src/ et le vendor/autoload.php
- data/phat-advisor.sql : contiendra les requêtes SQL pour la création du modèle physique de données (Tables etc) S'utilise à l'installation avec `make phat-db.install`
- docs : contient toutes les documentations nécessaire

## Development 
#### Git
###### Basic commands
- Clone repository: `$ git clone git@gitlab.com:Mianaan/phat_advisor.git`
- Create new branch: `$ git checkout -B branch_name`
- Download a branch: `$ git pull`
- Go to another branch: `$ git checkout branch_name`
- Stage changes before commit: `$ git add file1 file2`
- Commit changes: `$ git commit -m message` ou `$ git commit` 
- Upload a branch: `$ git push`
- Update *master* on current branch: `$ git rebase master`
- Delete branch: `$ git branch -d branch_name`

###### Create a merge request:
1. Login to GitLab
2. In *Repository -> Branches*
3. Click on the *Merge Request* button of your branch
4. Wait for approuval, it will be merge to *master*

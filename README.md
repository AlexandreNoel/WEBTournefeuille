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


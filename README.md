# ENSIIE Project Web Trouvemonbar [![Build Status](https://travis-ci.org/swanncastel/ensiie-project.svg?branch=master)](https://travis-ci.org/swanncastel/ensiie-project)

Projet Web ENSIIE:
* Samir Lazzali
* Jerôme O'Keffe
* Emilio De sousa
* Swann Castel

## Site disponible ici <https://okeeffe.ovh>

Installation de nginx, php-fpm et création d'un user ensiie.

Génération du certificat SSL avec Certbot <https://certbot.eff.org/.>

Définition des variables d'env dans /etc/php/7.2/fpm/pool.d/www.conf

Comment déployer avec en travis en toute sécurité <https://oncletom.io/2016/travis-ssh-deploy/>

## Notre Projet
Notre souhait est de créer une application Web qui propose à nos utilisateurs des bars qui correspondent à leurs préférences. les utilisateurs pourront se créer un compte afin d'enregistrer leurs paramètres et ainsi profiter de nos recommandations. Ils pourront aussi donner des avis sur les bars.

## Architecture du projet
Pour la partie backend, nous utilisons nginx et php-fpm pour fournir une API REST.

Pour le partie frontend, c'est une application Vue.js complétement indépendante alimentée par des reqêtes AJAX par le biais de l'api exposé par nginx.

---

## Install you application
* Change the parameters in .env file by your own values.
* To install and start the application run `make install`
* Your web site is running here [http:localhost:3000](http:localhost:3000)

## Start you application
`make start`

This command starts the application without installing anything.

## Connect to the database
`make db.connect`

## Run backend unit tests
`make phpunit.run`

## Run frontend unit tests
`make npmunit.run`

## Build frontend project
`make npm.build`

## Compte user
`login: John mot de passe 123` 

## Compte administrateur
`login: Admin   mot de passe: 123`

# ENSIIE - LE BAR D

Le rapport de ce projet est présent dans le dossier _document/_

### Install your application
* Change the parameters in .env file by your own values (for DOCKER_USER and DOCKER_USER_ID). Keep those configuration:

Nginx listen port on local machine: NGINX_PORT=80
Nginx hostname: SERVER_NAME=localhost

* To install and start the application run `make install`
* Your web site is running here [http:localhost](http:localhost)

### Start you application
`make start`

This command starts the application without installing anything.

### Connect to the database
`make db.connect`

### Run unit tests
`make phpunit.run`

## Launch LeBarD Application
### Access  with 'DEMO USER':
You can log the application without passing by ARISE ID, to test with a demo user:
* connect to YourAppURL/demo.php
Exemple: `localhost/demo.php`

You will be logged with the user 'DEMO' that have a sample of data, to present you those differents pages:
```
/home
/statistiques
/transaction
/userInfo
```

### Access with ARISE account:
You can log yourself on the application with your ARISE ID. 
* Connect to the YourAppUrl/. 
*Exemple:* `localhost/`
* You will be redirected to ARISE where you'll have to log with your own account.
* After accepting application's connection throught ARISE, you'll be redirect to the home page.

### Access Admin Console
To access the admin console, go to YourAppUrl/console.
Exemple: `localhost/console`
> Note: If you're not connected, you will be redirect to the connect page `/connect-console`

You can access the application admin CONSOLE with one of the following login/pwd: 

| Login | Password |
| ----------- | ----------- |
| PCBAR1 | fullAdmin |
| PCBAR2 | BadBarC|



 

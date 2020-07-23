# Desafio HostGator BackEnd

This is the backend of the app, built in PHP and MySQL.

## Environment

To run the app, you must run a stack of Docker constainers. Follow the instructions bellow:

1. `git clone https://github.com/julianobressan/desafio-hostgator-backend.git`
2. `cd desafio-hostgator-backend`
3. `docker-compose up -d`


## The application

Built with PHP 7.4, uses Slim Framework to generate a REST API, that counts with two endpoints, returning JSON objects:

* /prices
* /prices/<id do produto>

The app was modeled with a data layer built by Models, that reprpesents the database, and one class that manipulates the DB, named Database. Its function was modeled to run similiar to ORM Eloquent framework. It was implemented only the methods needed to realize the search of data, to acomplish the challenge, resting the other operations to be implemented in following versions. 

![Arquitetura](arquitetura.png?raw=true "Arquitetura")

The configurations of environment must be inserted in the env.php file. Pay attention in following items:

* 'frontend_address' => 'http://localhost:3000', //The URL of frontend
* 'database' => [ 'development' ] //The connection string of database. Change only if it is necessary

## Database

![Diagrama ER](db.png?raw=true "Diagrama ER")
The table and data must be created by migrations and seeders, using the Phinx framework. So, in first use, follow the steps bellow to generate the database (at this point, you already must be ran the `docker-compose up -d` command):

* Type `docker ps` and copy the ID of the container with sufix *-php74
* Type `docker exec -i -t <id do container> /bin/bash` and enter
* Type `vendor/bin/phinx migrate` and enter
* Type `vendor/bin/phinx seed:run` and enter

## Use

If you don't changed the address and port of apps, you can test the app with the following URLs:
* http://localhost:8001/prices
* http://localhost:8001/prices/5
* http://localhost:8001/prices/6 and etc.

## Unit tests

The PHPUnit framework was used to realize unit tests.

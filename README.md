# Desafio HostGator BackEnd

Consiste no backend da aplicação, composto por uma aplicação em PHP e banco de dados MySQL. 

## A aplicação

Desenvolvida em PHP 7.4, utiliza Slim Framework para gerar uma API Rest, a qual conta com dois endpoints que retornam objetos JSON:
* prices
* prices/<id do produto>

A aplicação está modelada com uma data layer composta por Models, que representam o banco de dados, e uma classe manipuladora do banco de dados, Database. O funcionamento foi modelado para funcionaar semelhante ao framework Eloquent, mas sem utilizar frameworks terceiros. Foram implementados somente os métodos necessários para realizar a busca dos dados, para cumprir o desafio, ficando o resto das operações de manipulação a serem implementadas posteriormente.

As configurações do ambiente devem ser inseridas no arquivo env.php. Atente para os itens abaixo:
* 'frontend_address' => 'http://localhost:3001', //esta configuração libera o backend para permitir requisições do frontend hospedado na mesma máquina. Caso você esteja utilizando outra porta ou endereço, nào esqueça de alterar aqui
* 'database' => [ 'development' // Os dados se referem à stack docker, conforme arquivo docker-compose.yml. Altere se for necessário

## Banco de dados
![Diagrama ER](db.png?raw=true "Diagrama ER")
As tabelas e os dados são criados por migrations e seeders, utilizando o framework Phinx. Assim, na primeira utilização, siga os passos abaixo para gerar o banco de dados:

* Digite `docker ps` e copie a ID do container com final *-php74
* Digite `docker exec -i -t <id do container> /bin/bash` e entre
* Digite `vendor/bin/phinx migrate` e entre
* Digite `vendor/bin/phinx seed:run` e entre

## Utilização
Se você não alterou a porta e o endereço, poderá testar acessando as URL como:
* http://localhost:8001/prices
* http://localhost:8001/prices/5

## Testes

Foram realizados testes unitários utilizando PHPUnit.

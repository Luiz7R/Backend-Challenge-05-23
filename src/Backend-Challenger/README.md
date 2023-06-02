<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Backend Challenger 20230105 by Coodesh

<br>

### Projeto de uma api que busca dados de um arquivo compactado da Open Food Facts.

<br>

que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios.
O projeto tem como objetivo dar suporte a equipe de nutricionistas da empresa Fitness Foods LC para que eles possam revisar de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel.

## Tecnologias Usadas:

PHP, Laravel, MongoDB, Docker , CRON,

* No armazenamentos de dados foi utilizado MongoDB que é um dos extras
* Utilizando as melhores práticas em projetos voltados ao Backend como Clean Code, DDD, TDD, Design Patterns, SOLID entre outros.

## Esse é um Challenge da plataforma Coodesh =D
<br>

## Link da Apresentação:

<a href="https://www.loom.com/share/7927a605488e46a1bf31abdb6ee3ab0d">Apresentação</a>
## Clonar o Projeto:

```
git clone https://github.com/Luiz7R/BackendChallenge.git
```

## Subindo o Ambiente no Docker:

```
docker-compose build
```
### Instalando Dependências:
```
composer install
```

### Copiar o .env

```
.env.example para novo arquivo .env
```

## Banco de Dados:

### rodar as migrate

```
php artisan migrate
```

## Endpoints:
```
==============================================================================================
Metódo   | Endpoints                | nome endpoint      | Controller@Função
===============================================================================================
GET|HEAD |   api                    | detalhesApi ›      | ApiDetailsController@index
GET|HEAD |   api/importar           | importar ›         | ProductsController@importarProdutos
GET|HEAD |   api/products           | products.index ›   |  ProductsController@index
POST     |   api/products           | products.store ›   | ProductsController@store
GET|HEAD |   api/products/{product} | products.show ›    | ProductsController@show
PUT|PATCH|   api/products/{product} | products.update ›  | ProductsController@update
DELETE|      api/products/{product} | products.destroy › | ProductsController@destroy
GET|HEAD |   api/search             | search ›           | ProductsController@search

```



## Endpoints do Postman no repositório ou no Link abaixo::

<a href="https://documenter.getpostman.com/view/12724363/2s93sW8FVy">Endpoints POSTMAN</a>

## CRON:

### ver quantas horas falta pra rodar o CRON:

```
php artisan schedule:list
```

### Execute o seguinte comando para iniciar o schedule do CRON:

```
php artisan schedule:work
```

### Execute o seguinte comando para rodar os testes:

```
php artisan test
```

### Importar os dados manualmente:

```
php artisan import:openfoodfacts
```

### Extras Desenvolvidos:

* Diferencial 2: Utilizando Docker
* Diferencial 4: Descrever a documentação da API utilizando o conceito de Open API 3.0;

* Diferencial 5: Escrever Unit Tests para os endpoints  GET e PUT do CRUD;

* Diferencial 6: Escrever um esquema de segurança utilizando API KEY nos endpoints. Ref: https://learning.postman.com/docs/sending-requests/authorization/#api-key


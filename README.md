Projeto: http://egetmarketplace.herokuapp.com

Passo a passo para rodar o projeto localmente:

- Clone o projeto em sua máquina.
- Instale em sua máquina o [docker compose](https://docs.docker.com/compose/install/).
- Entre na pasta do laradock.
- Renomeie o arquivo env-example por .env com o comando: cp env-example .env.
- Na pasta raiz do projeto, renomeie o arquivo env-example por .env com o comando: cp env-example .env.
- Rode o comando na pasta do laradock: docker-compose up -d nginx postgres redis workspace.
- Entre no worskpace do seu conteiner com o comando: docker-compose exec workspace bash.
- composer install
- php artisan migrate
- php artisan db:seed
- php artisan key:generate
- sudo chmod -R 777 storage bootstrap/cache

Laravel is accessible, powerful, and provides tools required for large, robust applications.

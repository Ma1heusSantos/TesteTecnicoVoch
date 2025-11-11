# TesteVoch

Teste Prático para Desenvolvedor Full Stack

# Sistema de Gestão para Grupo Econômico

Este projeto é um sistema de gestão para um grupo econômico que possui várias bandeiras, unidades e colaboradores. O sistema permite a administração de grupos econômicos, bandeiras, unidades e colaboradores, além de possibilitar a consulta de relatórios, auditoria e exportação de dados.

## Requisitos:

Antes de começar, verifique se você tem os seguintes requisitos:

-   [Git](https://git-scm.com/)
-   [Composer](https://getcomposer.org/)
-   [Laravel](https://laravel.com/docs/11.x)

## Instalação e Configuração:

Siga os passos abaixo para configurar o projeto localmente em seu ambiente de desenvolvimento.

### 1. Clonar o Repositório:

Clone o repositório para a sua máquina local:

```bash
git clone https://github.com/Ma1heusSantos/TesteVoch.git

```

```bash
    composer install
```

### 2. clonar o arquivo .env-example:

clone o arquivo .env-example e altere o nome para .env

### 3. configure o arquivo apartir das configurações a seguir:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=economicGroup
    DB_USERNAME=(seu-usuario)
    DB_PASSWORD=(sua senha)

### 4.Rode as migrations:

    Rode na pasta do projeto o comando :

    php artisan migrate --seed

### 5.inicie o servidor laravel:

    Rode na pasta do projeto o comando

    php artisan serve

### 6.inicie o npm:

    Rode na pasta do projeto o comando

    npm run dev

### 7. usuario e senha:

usuario: admin@admin
senha: admin

### 8. rodando teste unitarios :

    php artisan test

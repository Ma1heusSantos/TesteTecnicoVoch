# TesteVoch

Teste Prático para Desenvolvedor Full Stack

# Sistema de Gestão para Grupo Econômico

Este projeto é um sistema de gestão para um grupo econômico que possui várias bandeiras, unidades e colaboradores. O sistema permite a administração de grupos econômicos, bandeiras, unidades e colaboradores, além de possibilitar a consulta de relatórios, auditoria e exportação de dados.

## Requisitos:

Antes de começar, verifique se você tem os seguintes requisitos:

-   [Git](https://git-scm.com/)
-   [Composer](https://getcomposer.org/)
-   [Laravel](https://laravel.com/docs/11.x)
-   [NPM](https://www.npmjs.com/) Versão 20 superior
-   [PHP](https://www.php.net/) versão 8.2 superior

## Instalação e Configuração:

Siga os passos abaixo para configurar o projeto localmente em seu ambiente de desenvolvimento.

### 1. Clonar o Repositório:

Clone o repositório para a sua máquina local:

```bash
git clone https://github.com/Ma1heusSantos/TesteVoch.git

```

```bash
    composer install
    npm install
```

### 2. clonar o arquivo .env-example:

clone o arquivo .env-example e altere o nome para .env
#### 2.1 alternar o tipo da fila
    ´´´
    QUEUE_CONNECTION=database
    ´´´

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

    Rode na pasta do projeto os seguintes comandos

    php artisan key:generate
    php artisan serve

### 6.inicie o npm:

    Rode na pasta do projeto o comando

    npm run dev

### 7. usuario admin e senha:

usuario: admin@admin
senha: admin

### 7. usuario comun e senha:

usuario: iago@voch
senha: iago123

### 9. rodando teste unitarios :

    php artisan test

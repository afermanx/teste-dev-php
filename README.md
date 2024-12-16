## Teste para Desenvolvedor PHP/Laravel

Bem-vindo ao teste de desenvolvimento para a posição de Desenvolvedor PHP/Laravel.

## Tecnologias Utilizadas

-   Laravel
-   MySQL (ou outro banco de dados suportado)
-   Laravel Sail (para ambiente Docker)
-   Eloquent ORM

## Pré-requisitos

-   PHP >= 8.0
-   Composer
-   Docker (se usar Laravel Sail)
-   Postgres (ou outro banco de dados)

## Instalação

### Clone o Repositório

```bash
git clone https://github.com/afermanx/teste-dev-php.git
cd teste-dev-php
```

### Instalação com e sem o Laravel Sail

1. Instale as dependências com Composer:

    ##### Sail:

    ```bash
    ./vendor/bin/sail up -d
    ./vendor/bin/sail composer install
    ```

    ##### Normal:

    ```bash
    composer install
    ```

2. Configuração do Ambiente:

    ##### Copie o arquivo .env.example para .env:

    ```bash
    cp .env.example .env
    ```

3. Execute as Migrações com as seeds:
    ##### Sail:
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
    ##### Normal:
    ```bash
    php artisan artisan migrate --seed
    ```
4. Inicie a Aplicação:

    ##### Sail:

    A aplicação estará disponível em http://localhost/api/v1. Você pode acessar a API através dos endpoints definidos.

    ##### Normal:

    ```bash
    php artisan serve
    ```

    A aplicação estará disponível em http://localhost:8000/api/v1. Você pode acessar a API através dos endpoints definidos.

    ##### Retorno:

    ```json
    {
        "message": "Welcome!",
        "name": "RevendaMais-teste-dev-php",
        "version": "1.0.0",
        "documentation": "https://documenter.getpostman.com/view/5380407/2sAYHzG38n"
    }
    ```

    ## Test

    ##### Sail:

    ```bash
      ./vendor/bin/sail art test
    ```

    ##### Normal:

    ```bash
        php artisan test
    ```
    ## Documentação
    A documentação esta em uma collection do postman e se encontra no seguinte link: https://documenter.getpostman.com/view/5380407/2sAYHzG38n.
    Acesso direto a collection: https://orange-star-150212.postman.co/workspace/Invest~01e5cdef-d3b1-4d85-974f-77dd8739b484/collection/5380407-8cd4ca65-8072-4b07-abdc-b70804e6ba4c?action=share&creator=5380407&active-environment=5380407-c8f093e4-3733-467c-86f8-b66137a0e7ab

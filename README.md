# Ambiente Laravel, php8.2, docker, sail


## Docker-compose sqlserver Desenvolvimento

> Exemplo de criação de ambiente do SQL Server com Docker Compose, incluindo a execução de scripts de inicialização com a imagem mcr.microsoft.com/mssql-tools.

```
    user: sa
    PASSWORD: "SqlServer2019!"
    ports: 1433
```
```sh
docker compose exec laravel.test apt update
docker compose exec -u root laravel.test chmod -R 777 installSqlsrv.sh
docker compose exec -u root laravel.test bash installSqlsrv.sh
docker compose exec -u root laravel.test bash cp .env.example .env
./vendor/bin/sail artisan migrate --seed 
./vendor/bin/sail artisan make:model -c -f -m --api -R --test Exemplo
```

## Dockerfile para executar no Jenkins

```sh
    docker build -t php82apache .
    docker run -d -p 8080:80 php82apache                                                                                                       
```


## Documentação
http://laravel.test/api/documentation


### Atualizar documentação
#### Usando bash (recomendado para dev)
```bash
    ./vendor/bin/sail artisan l5-swagger:generate
```

#### Usando docker compose
```bash
./vendor/bin/sail  artisan l5-swagger:generate
```

## Manutenção
### Gerar APP_KEY
```bash
./vendor/bin/sail artisan key:generate
```

### Adicionar bibliotecas
```bash
docker compose exec laravel.test composer install <package-name>
```

### Atualizar bibliotecas
```bash
docker compose exec laravel.test composer update
```

### Recriar ambiente - quando houver mudanças no ambiente
```bash
./vendor/bin/sail down --rmi all -v
./vendor/bin/sail up --force-recreate --build
```

### Acessar logs
```bash
docker compose logs -f laravel.test
```


## Criando módulos

Utilizamos a biblioteca [nwidart/laravel-modules](https://github.com/nWidart/laravel-modules) para construir uma aplicação modular.

Execute `php artisan module:make MeuModulo` para criar um novo módulo na pasta Modules.

A seguinte estrutura de pastas será criada:

```bash
Modules
├── MeuModulo/
│   ├── Config/                 # pasta para configurações do módulo no app
│   │   └── config.php          # arquivo para configurações de setup do módulo
│   ├── Console/                # todo comments
│   ├── Database/               # ...
│   │   ├── factories/
│   │   ├── Migrations/
│   │   └── Seeders/
│   ├── Entities/
│   ├── Http/                   # ...
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Providers/
│   ├── Resources/
│   │   ├── assets/
│   │   ├── lang/
│   │   └── views/
│   ├── Routes/
│   │   └── api.php
│   ├── Tests/                  # ...
│   │   ├── Feature/
│   │   ├── Unit/
│   │   └── views/
│   ├── composer.json
│   ├── module.json
│   ├── package.json
│   └── webpack.mix.json
└── ...
```

# Ambiente
## Levantar (copiar o .env.example par .env)
```bash
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs
docker compose up
```

## Documentação
http://localhost/api/documentation

## Desenvolvimento
### Criar novo crud
```bash
docker compose exec laravel.test /bin/bash
php artisan make:model -c -f -m --api -R --test Exemplo
```

### Atualizar documentação
#### Usando bash (recomendado para dev)
```bash
docker compose exec laravel.test /bin/bash
php artisan l5-swagger:generate
```

#### Usando docker compose
```bash
docker compose exec laravel.test php artisan l5-swagger:generate
```

## Manutenção
### Gerar APP_KEY
```bash
docker compose exec laravel.test php artisan key:generate
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
docker compose down --rmi all -v
docker compose build --no-cache
docker compose up --force-recreate --build
```

### Acessar logs
```bash
docker compose logs -f laravel.test
```

### Acessar o terminal
```bash
docker compose exec laravel.test /bin/bash
```

### Acessar um container temporário (usar quando não levar o oficial)
CMD
```bash
docker run --rm -it -v %cd%:/app -t php:8.2-cli-alpine /bin/bash --login
```

PowerShell
```bash
docker run --rm -it -v ${PWD}:/app -t php:8.2-cli-alpine /bin/sh --login
```

Linux
```bash
docker run --rm -it -v "$(pwd)":/app -t php:8.2-cli-alpine /bin/bash --login
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

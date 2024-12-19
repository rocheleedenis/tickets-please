## Sobre o projeto

Projeto criado à partir da série **[Laravel API Master Class](https://laracasts.com/series/laravel-api-master-class)** do Laracasts.
Este projeto está em Laravel 11 e a série foi criada com uma versão anterior, acredito que a versão 10, então existem algumas diferenças entre o projeto da série e este, já que precisei adaptar para funcionar algumas coisas.

O formato dos retornos da API foram baseados nas especificações indicadas pela [JSON:API](https://jsonapi.org/)

## Instalação

O projeto tem suporte para rodar com Docker. Na pasta raiz do projeto rode:
```bash
docker compose up -d
```

Entre no container e execute:
```bash
php artisan migrate
php artisan key:generate
php artisan db:seed
```

### Autenticação

É possível se logar e usar os endpoints do projeto estando autenticado. Para a autenticação foi usado [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum#how-it-works).

## Documentação


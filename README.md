# Grupo A - Backend

## Desafio

Lista de desafios a serem executados, seguir orientações conforme link abaixo:

[Instruções](https://github.com/grupo-a/challenge-full-stack-web-laravel)

## Requerimentos

Requerimentos minímos para o funcionamento da aplicação.

[Requerimentos](https://laravel.com/docs/8.x/deployment#server-requirements)

## Executar a aplicação

1 - Clonar repositório

```bash
git clone https://github.com/rbferreyra/grupo-a-desafio-backend
```

2 - Instalar dependências

```bash
composer install
```

3 - Executar as migrations

```bash
php artisan migrate
```

4 - Popular banco de dados

```bash
php artisan db:seed
```

5 - Executar aplicação

```bash
php artisan serve
```

- Ambiente local

[http://127.0.0.1:8000](http://127.0.0.1:8000)

- Ambiente produção (Heroku)

[https://rbferreyra-grupo-a.herokuapp.com](https://rbferreyra-grupo-a.herokuapp.com)

## Recursos

- Lista de estudantes
  - GET: /api/v1/students
- Filtrar lista de estudantes
  - GET: /api/v1/students?keywords=John+Doe
- Buscar estudante
  - GET: /api/v1/students/1
- Cadastrar novo estudante
  - POST: /api/v1/students
- Atualizar estudante
  - PUT: /api/v1/students/1
- Remover estudante
  - DELETE: /api/v1/students/1

## Teste

Executar testes da aplicação

```bash
./vendor/bin/pest --filter studentTest 
```

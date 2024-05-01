# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)
---

# Documentação da API REST com Lumen

## Introdução
Esta é a documentação da API REST desenvolvida com o framework Lumen. Aqui você encontrará informações sobre os endpoints disponíveis, como autenticar-se, e exemplos de solicitações e respostas.

## Endpoints Disponíveis
- **GET /usuarios**: Retorna todos os usuários.
- **POST /usuario/cadastrar**: Cadastra um novo usuário.
- **GET /usuario/{id}**: Retorna um usuário específico pelo ID.
- **PUT /usuario/{id}/atualizar**: Atualiza os dados de um usuário.
- **DELETE /usuario/{id}/deletar**: Deleta um usuário.

## Autenticação
Para autenticar-se, envie uma solicitação POST para `/login` com o email e senha do usuário. O token JWT será retornado em caso de sucesso.

## Exemplos de Solicitações
```http
POST /login
Content-Type: application/json

{
  "email": "example@example.com",
  "password": "password123"
}
```

## Exemplos de Respostas
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"
}
```

## Recursos Adicionais
Para mais detalhes sobre os endpoints e suas funcionalidades, consulte o código-fonte da aplicação.

---

# Gerenciador de Tarefas

Este é um projeto de exemplo para gerenciamento de tarefas, com controle de usuários para administradores. A aplicação permite que os usuários criem, atualizem, removam, concluam e listem tarefas. O administrador tem a capacidade de gerenciar todos os usuários do sistema.

## Planejamento do Projeto

Antes de iniciar o desenvolvimento, foi realizado um planejamento das funcionalidades e arquitetura do sistema:

![Planejamento do Sistema]([https://raw.githubusercontent.com/WanCarvalho/sistema-gestao-tarefas/refs/heads/documentacao/planejamento_sistema_gestao.png?token=GHSAT0AAAAAADAJMNVPSJGXG3HGJDKPIZWCZ6WCJIA](https://github.com/WanCarvalho/sistema-gestao-tarefas/blob/main/planejamento_sistema_gestao.png))

## Funcionalidades

- **Cadastro e Login**: Usuários podem se registrar e fazer login no sistema.
- **Gerenciamento de Tarefas**: Criar, editar, listar, concluir e excluir tarefas.
- **Controle de Usuários para Administradores**:
  - Administradores podem criar, editar, listar e excluir usuários.
  - Proteção de rotas para garantir que apenas administradores tenham acesso a funcionalidades administrativas.
  
## Tecnologias Utilizadas

- **Laravel 11**: Framework PHP para o desenvolvimento da aplicação.
- **Blade**: Template engine do Laravel para a criação das views.
- **Bootstrap CSS**: Framework CSS para estilização da interface.
- **Breeze**: Pacote de autenticação simples para gerenciamento de usuários.
- **PostgreSQL**: Banco de dados relacional.

## Requisitos

- PHP 8.2 ou superior
- Composer
- Javascript
- PostgreSQL

## Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/WanCarvalho/sistema-gestao-tarefas.git
cd sistema-gestao-tarefas
```

### 2. Instale as dependências do PHP
```bash
composer install
```

### 3. Configure o arquivo .env
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sistema-gestao-tarefas
DB_USERNAME={usuario-do-banco}
DB_PASSWORD={senha-do-banco}
```

### 4. Gere a chave da aplicação
```bash
php artisan key:generate
```

### 5. Execute as migrations e seeders
```bash
php artisan migrate --seed
```

### 6. Instale as dependências do frontend
```bash
npm install
```

### 7. Compile os assets
```bash
npm run dev
```

### 8. Inicie o servidor
```bash
php artisan serve
```

## Itens Atendidos

- a) Criar uma aplicação web utilizando PHP usando o Framework Laravel.
- b) Utilizar persistência em um banco de dados Postegres SQL.
- c) Utilizar Eloquent ORM
- d) Utilizar Bootstrap


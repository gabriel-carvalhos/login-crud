# Login + Crud 🔐📄

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

https://github.com/user-attachments/assets/111924c7-642f-4598-9328-4d5f779e1a29

Este projeto implementa um sistema de autenticação de usuários (login) e operações CRUD (Create, Read, Update, Delete).

1. [Setup](#-setup)
2. [Funcionalidades](#️-funcionalidades)
3. [To do](#-to-do)

## 💻 Setup

### Pré-Requisitos

- Servidor web (Apache ou Nginx).
- PHP.
- MySQL (ou MariaDB).

### Instalação

1. Clone o repositório:
    ```
    git clone https://github.com/gabriel-carvalhos/login-crud.git
    ```

2. Crie um banco de dados com o script abaixo:
    ```mysql
    CREATE DATABASE IF NOT EXISTS login_crud;

    USE login_crud;

    CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    );

    INSERT INTO user (email, password) 
    VALUES ('admin@admin.com', '$2y$10$MJzwVqrOEHEKS9G2fSMfRegDlkoAPPPj4dPJhJf816knIhdo/Zdw2');

    CREATE TABLE IF NOT EXISTS address (
        id INT AUTO_INCREMENT PRIMARY KEY,
        street VARCHAR(100),
        district VARCHAR(50),
        city VARCHAR(50),
        state CHAR(2),
        cep CHAR(8)
    );

    CREATE TABLE IF NOT EXISTS client (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50),
        email VARCHAR(100) UNIQUE,
        phone CHAR(11) UNIQUE,
        address_id INT,
        FOREIGN KEY (address_id) REFERENCES address(id)
    );
    ```

3. Substitua com suas informações de usuário e senha do banco de dados em "database/Database.php".

4. Execute o projeto, e faça login com o email "**admin@admin.com**" e com a senha **"admin"**.

## 🛠️ Funcionalidades

**1. Sistema de Login:**

- Login seguro com hashing de senhas (utilizando password_hash).
- Gerenciamento de sessões para verificar se o usuário está autenticado antes de acessar áreas restritas.
- Logout para encerrar a sessão do usuário.

**2. Operações CRUD:**

- Create: Adicionar novos registros de clientes ao sistema.
- Read: Visualizar todos os clientes armazenados.
- Update: Editar informações de clientes existentes.
- Delete: Excluir clientes.

**3. Validacão de Formulários:**

- Verificação de campos obrigatórios e seus requisitos mínimos.
- Exibição de mensagens de erro amigáveis ao usuário em caso de entradas inválidas.

**4. Autocomplete de Endereço:**

- Integração com a API ViaCEP para preenchimento automático de informações de endereço ao informar o CEP.

**5. Segurança:**

- Proteção contra SQL Injection utilizando prepared statements.

## ✅ To do

- "Dockerizar" aplicação para deploy
- Paginação
- Preenchimento de formulário automático
- Sistema de cadastro de usuários
- Tema claro/escuro

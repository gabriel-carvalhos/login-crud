# [Teste - Backend] Gabriel Carvalho dos Santos
Teste desenvolvido para o processo seletivo da AMZ|MP.

Tecnologias utilizadas:
- PHP
- MySQL

## Setup
É necessário criar um banco de dados MySQL com o código abaixo.

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

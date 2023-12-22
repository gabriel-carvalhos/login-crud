# [Teste - Backend] Gabriel Carvalho dos Santos
Teste desenvolvido para o processo seletivo da AMZ|MP.

Tecnologias utilizadas:
- PHP
- MySQL

## Setup
É necessário criar um banco de dados MySQL chamado client_crud.

```mysql
  CREATE DATABASE client_crud;

  USE client_crud;

  CREATE TABLE usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    email_usuarios VARCHAR(100) NOT NULL,
    senha_usuarios VARCHAR(100) NOT NULL
  );

  INSERT INTO usuarios (email_usuarios, senha_usuarios) 
  VALUES ('admin@admin.com', '$2y$10$MJzwVqrOEHEKS9G2fSMfRegDlkoAPPPj4dPJhJf816knIhdo/Zdw2');

  CREATE TABLE endereco (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rua VARCHAR(100),
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado CHAR(2),
    cep CHAR(8)
  );

  CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    telefone CHAR(11) UNIQUE,
    endereco_id INT,
    FOREIGN KEY (endereco_id) REFERENCES endereco(id)
  );
```

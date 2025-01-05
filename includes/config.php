<?php 

    $user = 'root';
    $password = 'root';
    $database = 'login_crud';
    $host = 'localhost';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->error) {
        die("Erro ao conectar com o banco de dados: $conn->error");
    }

?>
<?php 

    $user = 'root';
    $password = '';
    $database = 'client-crud';
    $host = 'localhost';

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->error) {
        die("Erro ao conectar com o banco de dados: $mysqli->error");
    }

?>
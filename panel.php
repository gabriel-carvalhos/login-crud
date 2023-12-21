<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['id'])) {
        die('Acesso negado!');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <h1>Bem Vindo</h1>
    <a href="./logout.php">Sair da Conta</a>
</body>
</html>
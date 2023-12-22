<?php 
    include('protect.php');

    include('config.php');

    $query = "SELECT * FROM cliente AS c
              INNER JOIN endereco as e
              ON c.endereco_id = e.id";

    $res = $conn->query($query) or die("Erro na query SQL:" . $conn->error);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    
    <?php
        if (isset($_SESSION['error404'])) {
            echo $_SESSION['error404'];
            unset($_SESSION['error404']);
        }
    ?>
    
    <h1>Bem Vindo</h1>
    
    <?php 
        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                echo $row['id'] . " | ";
                echo $row['nome'] . " | ";
                echo $row['email'] . " | ";
                echo $row['telefone'] . "| ";
                echo $row["rua"] . ", " . $row["bairro"] . ", " . $row["cidade"] . ", " . $row["estado"] . ", " . $row["cep"];
                echo " | <a href=\"delete.php?id={$row['id']}\">deletar</a> | ";
                echo "<a href=\"update.php?id={$row['id']}\">atualizar</a><br>";
            }
        } else {
            echo 'Nenhum cliente encontrado';
        }
    ?>

    <a href="./create.php">Criar</a>
    <a href="./logout.php">Sair da Conta</a>

</body>
</html>
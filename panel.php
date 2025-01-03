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
    <?php include('head.php') ?>
    <title>Painel</title>
</head>
<body>
    
    <?php include('notify.php') ?>
    
    <h1>Bem Vindo</h1>
    
    <?php 
        if ($res->num_rows) {
            while ($row = $res->fetch_assoc()) {
                echo $row['id'] . " | ";
                echo $row['nome'] . " | ";
                echo $row['email'] . " | ";
                echo $row['telefone'] . " | ";
                echo $row["rua"] . ", " . $row["bairro"] . ", " . $row["cidade"] . ", " . $row["estado"] . ", " . $row["cep"];
                echo " | <button type=\"button\" onclick=\"if(confirm('Deseja apagar este usuário?')) { location.assign('./delete.php?id={$row['id']}') }\">Apagar</button>";
                echo " <button type=\"button\" onclick=\"location.assign('./update.php?id={$row['id']}')\">Editar</button><br>";
            }
        } else {
            echo 'Nenhum cliente encontrado';
        }
    ?>

    <button type="button" onclick="location.assign('./create.php')">Cadastrar</button>
    <button type="button" onclick="location.assign('./logout.php')">Sair da conta</button>

</body>
</html>
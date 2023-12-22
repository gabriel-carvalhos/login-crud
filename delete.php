<?php 
    include('protect.php');

    include('config.php');

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
    }

    $id = $conn->real_escape_string($_GET['id']);
    # echo $id;

    $query = "DELETE FROM cliente WHERE id = '$id'";
    # echo $query;
    $sql_query = $conn->query($query) or die("Erro na query SQL:" . $conn->error);

    header('Location: panel.php');
?>
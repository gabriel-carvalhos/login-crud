<?php 
    include('protect.php');

    include('config.php');

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
    }

    $id = $_GET['id'];

    $query = "DELETE FROM cliente WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    # $res = $stmt->get_result()->fetch_assoc();
    # $sql_query = $conn->query($res) or die("Erro na query SQL:" . $conn->error);

    header('Location: panel.php');
?>
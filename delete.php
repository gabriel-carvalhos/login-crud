<?php 
    include('protect.php');

    include('config.php');

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
        die();
    }

    $id = $_GET['id'];
    $query = "DELETE FROM address WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    
    $_SESSION['delete'] = "Usuário deletado!";
    
    header('Location: panel.php');
    die();
?>
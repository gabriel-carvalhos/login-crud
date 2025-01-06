<?php 
    include('includes/protect.php');
    require_once 'database/Database.php';
    require_once 'database/Address.php';

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
        die();
    }

    $id = $_GET['id'];
    $address = new Address();
    $address->delete($id);
    
    $_SESSION['delete'] = "Usuário deletado!";
    
    header('Location: panel.php');
    die();
?>
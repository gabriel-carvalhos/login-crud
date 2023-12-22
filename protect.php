<?php 
    session_start();

    if(!isset($_SESSION['id'])) {
        $_SESSION['error'] = 'Acesso Negado!';
        header('Location: index.php');
        die();
    }
?>
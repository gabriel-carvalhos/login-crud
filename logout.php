<?php 
    include('includes/protect.php');

    session_start();

    unset($_SESSION['id']);
    $_SESSION['logout'] = 'Logout realizado com sucesso!';

    header('Location: index.php');
    die();
?>
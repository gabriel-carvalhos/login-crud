<?php

    $status = [
        "login" => "info",
        "logout" => "info",
        "create" => 'success',
        "update" => 'warning',
        "error404" => 'error',
        "delete" => 'error',
        "error" => 'error',
        "error_email" => 'error',
        "error_password" => 'error'
    ];

    foreach($_SESSION as $index => $msg) {
        if (key_exists($index, $status)) {
            echo "<script>notify('$status[$index]', '$msg')</script>";
    
            unset($_SESSION[$index]);
        }
    }

?>
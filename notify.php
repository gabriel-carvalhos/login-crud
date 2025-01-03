<?php

    foreach($_SESSION as $index => $msg) {
        echo "<script>notify('error', '$msg')</script>";

        unset($_SESSION[$index]);
    }

?>
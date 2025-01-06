<?php

function validate($name, $email, $phone, $cep, $street, $district, $city, $state, $id) {
    $isValid = true;

    $client = new Client();
    $email_repeated = $client->findByEmail($email, $id);
    $phone_repeated = $client->findByPhone($phone, $id);

    if (strlen($name) <= 2 || strlen($name) > 50) {
        $_SESSION['error_name'] = 'Nome deve conter entre 2 a 50 caracteres';
        $isValid = false;
    }

    if (strlen($email) <= 5 || strlen($email) > 100) {
        $_SESSION['error_email'] = 'Email deve conter entre 5 a 100 caracteres';
        $isValid = false;
    }

    if ($email_repeated) {
        $_SESSION['error_email'] = "Email já utilizado!";
        $isValid = false;
    }
    
    if (!preg_match("/^[0-9]{11}$/", $phone)) {
        $_SESSION['error_phone'] = 'Telefone inválido';
        $isValid = false;
    }

    if ($phone_repeated) {
        $_SESSION['error_phone'] = "Telefone já utilizado!";
        $isValid = false;
    }

    if (!preg_match("/^[0-9]{8}$/", $cep)) {
        $_SESSION['error_cep'] = 'Cep inválido';
        $isValid = false;
    }

    if (strlen($street) <= 2 || strlen($street) > 100) {
        $_SESSION['error_street'] = 'Rua deve conter entre 2 a 100 caracteres';
        $isValid = false;
    }

    if (strlen($district) <= 2 || strlen($district) > 50) {
        $_SESSION['error_district'] = 'Bairro deve conter entre 2 a 50 caracteres';
        $isValid = false;
    }

    if (strlen($city) <= 2 || strlen($city) > 50) {
        $_SESSION['error_city'] = 'Cidade deve conter entre 2 a 50 caracteres';
        $isValid = false;
    }

    if (strlen($state) < 2) {
        $_SESSION['error_state'] = 'Estado deve conter 2 caracteres';
        $isValid = false;
    }

    return $isValid;
}

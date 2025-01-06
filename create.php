<?php
    include('includes/protect.php');

    require_once 'database/Database.php';
    require_once 'database/Client.php';
    require_once 'database/Address.php';

    if (isset($_POST['name'])) {
        createClient();
    }

    function createClient() {
        // Desestruturando $_POST
        [
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'cep'=>$cep,
            'street'=>$street,
            'district'=>$district,
            'city'=>$city,
            'state'=>$state
        ] = $_POST;
        
        // Limpando formatação
        $phone = str_replace(["(",")","-"," "], "", $phone);
        $cep = str_replace("-", "", $cep);

        // Validando formulário
        include('includes/validate.php');
        $isValid = validate($name, $email, $phone, $cep, $street, $district, $city, $state, null);
        if (!$isValid) return;
        
        // Insere endereço no banco e retorna o insert_id
        $address = new Address();
        $address_id = $address->insert($street, $district, $city, $state, $cep);
        
        $client = new Client();
        $client->insert($name, $email, $phone, $address_id);
        
        $_SESSION['create'] = "Usuário criado!";

        header('Location: panel.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('includes/head.php') ?>
    <title>Criar Usuário</title>
</head>

<body>

    <?php 
        $page = 'create';
        include('includes/header.php');
    ?>

    <main class="d-flex justify-content-center align-items-center py-4" style="min-height: calc(100vh - 56px);">
        <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <h1>Criar Cliente</h1>
            <?php include('includes/fields.php') ?>
        </div>
    </main>

    <script src="js/viacep.js"></script>
    <script src="js/mask.js"></script>
    
    <?php include('includes/notify.php') ?>
</body>

</html>
<?php 
    include('includes/protect.php');
    require_once 'database/Database.php';
    require_once 'database/Client.php';
    require_once 'database/Address.php';

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
        die();
    }

    $id = $_GET['id'];
    $client = new Client();
    $res = $client->findById($id);

    if (!$res) {
        $_SESSION['error404'] = 'Página não encontrada!';
        header('Location: panel.php');
        die();
    }
    
    if ($_POST) {
        update($id, $client);
    }

    function update($id, $client) {
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
        $isValid = validate($name, $email, $phone, $cep, $street, $district, $city, $state, $id);
        if (!$isValid) return;
        
        $client->update($name, $email, $phone, $id);

        $address = new Address();
        $address->update($street, $district, $city, $state, $cep, $id);

        $_SESSION['update'] = "Usuário atualizado!";

        header('Location: panel.php');
        die();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('includes/head.php') ?>
    <title>Editar</title>
</head>

<body>

    <?php include('includes/header.php') ?>

    <main class="d-flex justify-content-center align-items-center py-4" style="min-height: calc(100vh - 56px);">
        <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <h1>Editar Usuário</h1>
            <?php include('includes/fields.php') ?>
        </div>
    </main>

    <script src="js/viacep.js"></script>
    <script src="js/mask.js"></script>

    <?php include('includes/notify.php') ?>
</body>
</html>
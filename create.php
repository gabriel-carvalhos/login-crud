<?php
    include('protect.php');
    
    include('config.php');

    if (isset($_POST['name'])) {
        create($conn);
    }

    function create($conn) {
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

        $query = "SELECT id FROM client WHERE email = ? OR phone = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();

        $data_repeated = $stmt->get_result()->fetch_assoc();
        if ($data_repeated) {
            echo "Dados fornecidos já estão em uso!";
            return;
        }

        $query = "INSERT INTO address (street, district, city, state, cep) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $street, $district, $city, $state, $cep);
        $stmt->execute();
    
        // obtém o ID do último registro inserido na tabela Endereco
        $address_id = $stmt->insert_id;

        $query = "INSERT INTO client (name, email, phone, address_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $phone, $address_id);
        $stmt->execute();
        
        $_SESSION['create'] = "Usuário criado!";

        header('Location: panel.php');
        die();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('head.php') ?>
    <title>Criar Usuário</title>
</head>

<body>

    <?php 
        $page = 'create';
        include('header.php');
    ?>

    <main class="d-flex justify-content-center align-items-center py-4" style="min-height: calc(100vh - 56px);">
        <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <h1>Criar Cliente</h1>
            <?php include('fields.php') ?>
        </div>
    </main>

    <?php include('notify.php') ?>
    <?php include('api.php'); ?>
</body>

</html>
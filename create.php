<?php
    include('protect.php');
    
    include('config.php');

    if (isset($_POST['name'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['phone'];
        $cep = $_POST['cep'];
        $rua = $_POST['street'];
        $bairro = $_POST['district'];
        $cidade = $_POST['city'];
        $estado = $_POST['state'];

        $query = "SELECT id FROM client WHERE email = ? OR phone = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $telephone);
        $stmt->execute();
        $data_repeated = $stmt->get_result()->fetch_assoc();

        if (!$data_repeated) {
            $query = "INSERT INTO address (street, district, city, state, cep) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $rua, $bairro, $cidade, $estado, $cep);
            $stmt->execute();
        
            # obtém o ID do último registro inserido na tabela Endereco
            $endereco_id = $stmt->insert_id;

            $query = "INSERT INTO client (name, email, phone, address_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $name, $email, $telephone, $endereco_id);
            $stmt->execute();
            
            $_SESSION['create'] = "Usuário: $name criado!";

            header('Location: panel.php');
            die();
        } else {
            echo "Dados fornecidos já estão em uso!";
        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('head.php') ?>
    <title>Criar Usuário</title>
</head>

<body class="w-100 min-vh-100 d-flex flex-column justify-content-center align-items-center">

    <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <h1>Criar Cliente</h1>
        <?php include('fields.php') ?>
    </div>

    <?php include('notify.php') ?>

    <?php include('api.php'); ?>
</body>

</html>
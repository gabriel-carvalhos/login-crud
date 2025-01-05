<?php 
    include('protect.php');

    include('config.php');

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
        die();
    }

    $id = $_GET['id'];
    $query = "SELECT * FROM client AS c
              INNER JOIN address AS a
              ON c.address_id = a.id
              WHERE c.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_object();

    if (!$res) {
        $_SESSION['error404'] = 'Página não encontrada!';
        header('Location: panel.php');
        die();
    }
    
    if ($_POST) {
        update($id, $conn);
    }

    function update($id, $conn) {
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

        $query = "SELECT email, phone FROM client WHERE (email = ? OR phone = ?) AND id != ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $email, $phone, $id);
        $stmt->execute();
        $data_repeated = $stmt->get_result()->fetch_object();
        
        // Validando formulário
        require 'validate.php';
        $isValid = validate($name, $email, $phone, $cep, $street, $district, $city, $state, $data_repeated);
        if (!$isValid) return;
        
        $query = "UPDATE client
                    SET name = ?, email = ?, phone = ?
                    WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $name, $email, $phone, $id);
        $stmt->execute();

        $query = "UPDATE address
                    SET street = ?, district = ?, city = ?, state = ?, cep = ?
                    WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $street, $district, $city, $state, $cep, $id);
        $stmt->execute();

        $_SESSION['update'] = "Usuário atualizado!";

        header('Location: panel.php');
        die();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('head.php') ?>
    <title>Editar</title>
</head>

<body>

    <?php include('header.php') ?>

    <main class="d-flex justify-content-center align-items-center py-4" style="min-height: calc(100vh - 56px);">
        <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <h1>Editar Usuário</h1>
            <?php include('fields.php') ?>
        </div>
    </main>

    <?php include('notify.php') ?>
    <?php include('api.php'); ?>
</body>
</html>
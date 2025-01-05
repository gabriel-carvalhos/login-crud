<?php
    include('protect.php');

    include('config.php');


    if (isset($_POST['name'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
</head>

<body>
    <h1>Criar Usuário</h1>

    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input value="<?=$name ?? '' ?>" type="text" name="name" placeholder="nome" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?=$email ?? ''?>" type="email" name="email" placeholder="email" required>
        <input value="<?=$telephone ?? ''?>" type="tel" name="telephone" placeholder="telefone" pattern="[0-9]{11}" required>
        <input value="<?=$cep ?? ''?>" type="text" id="cep" class="cep" name="cep" placeholder="cep" pattern="[0-9]{8}" required>
        <input value="<?=$rua ?? ''?>" type="text" id="logradouro" class="address" name="rua" placeholder="rua" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?=$bairro ?? ''?>" type="text" id="bairro" class="address" name="bairro" placeholder="bairro" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?=$cidade ?? ''?>" type="text" id="localidade" class="address" name="cidade" placeholder="cidade" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?=$estado ?? ''?>" type="text" id="uf" class="address" name="estado" placeholder="estado" pattern="[A-Z]{2}" required>
        <button type="submit">Enviar</button>
        <button type="button" onclick="location.assign('./panel.php')">Voltar</button>
    </form>

    <?php include('api.php'); ?>
</body>

</html>
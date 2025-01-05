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
    $res = $stmt->get_result()->fetch_assoc();

    if ($_POST) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $query = "SELECT * FROM client WHERE (email = ? OR phone = ?) AND id != ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $email, $telephone, $id);
        $stmt->execute();
        $data_repeated = $stmt->get_result()->fetch_assoc();

        if (!$data_repeated) {
            $query = "UPDATE client
                      SET name = ?, email = ?, phone = ?
                      WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $telephone, $id);
            $stmt->execute();
    
            $query = "UPDATE address
                      SET street = ?, district = ?, city = ?, state = ?, cep = ?
                      WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssss', $rua, $bairro, $cidade, $estado, $cep, $id);
            $stmt->execute();

            $_SESSION['update'] = "Usuário: $name atualizado!";
    
            header('Location: panel.php');
            die();
        } else {
            echo "Dados fornecidos já estão em uso!";
        }

    } else if (!$res) {
        $_SESSION['error404'] = 'Página não encontrada!';

        header('Location: panel.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <h1>Editar Usuário</h1>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <input value="<?= $_POST['name'] ?? $res['name']?>" type="text" name="name" placeholder="nome" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?= $_POST['email'] ?? $res['email']?>" type="email" name="email" placeholder="email" required>
        <input value="<?= $_POST['telephone'] ?? $res['phone']?>" type="tel" name="telephone" placeholder="telefone" pattern="[0-9]{11}" required>
        <input value="<?= $_POST['cep'] ?? $res['cep']?>" type="text" id="cep" class="cep" name="cep" placeholder="cep" pattern="[0-9]{8}" required>
        <input value="<?= $_POST['rua'] ?? $res['street']?>" type="text" id="logradouro" class="address" name="rua" placeholder="rua" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?= $_POST['bairro'] ?? $res['district']?>" type="text" id="bairro" class="address" name="bairro" placeholder="bairro" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?= $_POST['cidade'] ?? $res['city']?>" type="text" id="localidade" class="address" name="cidade" placeholder="cidade" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?= $_POST['estado'] ?? $res['state']?>" type="text" id="uf" class="address" name="estado" placeholder="estado" pattern="[A-Z]{2}" required>
        <button type="submit">Enviar</button>
        <button type="button" onclick="location.assign('./panel.php')">Voltar</button>
    </form>

    <?php include('api.php'); ?>
</body>
</html>
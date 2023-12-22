<?php 
    include('protect.php');

    include('config.php');

    if (!isset($_GET['id'])) {
        header('Location: panel.php');
    }

    $id = $_GET['id'];
    $query = "SELECT * FROM cliente AS c
              INNER JOIN endereco AS e
              ON c.endereco_id = e.id
              WHERE c.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    var_dump($res);

    if ($_POST) {
        echo "enviado";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $query = "UPDATE cliente
                  SET nome = ?, email = ?, telefone = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $name, $email, $telephone, $id);
        $stmt->execute();

        $query = "UPDATE endereco
                  SET rua = ?, bairro = ?, cidade = ?, estado = ?, cep = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $rua, $bairro, $cidade, $estado, $cep, $id);
        $stmt->execute();

        header('Location: panel.php');
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

<form action="" method="post">
    <input value="<?php echo $res['nome']?>" type="text" name="name" placeholder="nome" pattern="[A-Za-zÀ-ÿ ]+" required>
    <input value="<?php echo $res['email']?>" type="email" name="email" placeholder="email" required>
    <input value="<?php echo $res['telefone']?>" type="tel" name="telephone" placeholder="telefone" pattern="[0-9]{11}" required>
    <input value="<?php echo $res['cep']?>" type="text" id="cep" class="cep" name="cep" placeholder="cep" pattern="[0-9]{8}" required>
    <input value="<?php echo $res['rua']?>" type="text" id="logradouro" class="address" name="rua" placeholder="rua" pattern="[A-Za-zÀ-ÿ ]+" required>
    <input value="<?php echo $res['bairro']?>" type="text" id="bairro" class="address" name="bairro" placeholder="bairro" pattern="[A-Za-zÀ-ÿ ]+" required>
    <input value="<?php echo $res['cidade']?>" type="text" id="localidade" class="address" name="cidade" placeholder="cidade" pattern="[A-Za-zÀ-ÿ ]+" required>
    <input value="<?php echo $res['estado']?>" type="text" id="uf" class="address" name="estado" placeholder="estado" pattern="[A-Z]{2}" required>
    <button type="submit">Enviar</button>
</form>

<script>
    const address = document.querySelectorAll('.address')
    const cep = document.querySelector('.cep')

    cep.addEventListener('blur', async () => {         
        console.log(cep.value)
        const url = `https://viacep.com.br/ws/${cep.value}/json/`
        const res = await fetch(url)
        const dataRes = await res.json()
        autocomplete(dataRes)
    })

    const autocomplete = (data) => {
        if (data.erro) {
            console.error('erro')
        } else {
            address.forEach(item => {
                item.value = data[item.id]
            })
        }
    }

</script>
</body>
</html>
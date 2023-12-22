<?php
include('protect.php');

include('config.php');


if (isset($_POST['name'])) {
    var_dump($_POST);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sqlCheckUnique = "SELECT id FROM cliente WHERE email = ? OR telefone = ?";
    $stmtCheckUnique = $conn->prepare($sqlCheckUnique);
    $stmtCheckUnique->bind_param("ss", $email, $telephone);
    $stmtCheckUnique->execute();
    $res = $stmtCheckUnique->get_result()->fetch_assoc();

    if (!$res) {
        $sqlEndereco = "INSERT INTO Endereco (rua, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?)";
        $stmtEndereco = $conn->prepare($sqlEndereco);
        $stmtEndereco->bind_param("sssss", $rua, $bairro, $cidade, $estado, $cep);
        $stmtEndereco->execute();
    
        // Obtém o ID do último registro inserido na tabela Endereco
        $endereco_id = $stmtEndereco->insert_id;
        // Insere os dados na tabela Pessoa com o ID do Endereco relacionado
        $sqlPessoa = "INSERT INTO cliente (nome, email, telefone, endereco_id) VALUES (?, ?, ?, ?)";
        $stmtPessoa = $conn->prepare($sqlPessoa);
        $stmtPessoa->bind_param("sssi", $name, $email, $telephone, $endereco_id);
        $stmtPessoa->execute();
    
        header('Location: panel.php');
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

    <form action="" method="post">
        <input value="<?php echo $name?>" type="text" name="name" placeholder="nome" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?php echo $email?>" type="email" name="email" placeholder="email" required>
        <input value="<?php echo $telephone?>" type="tel" name="telephone" placeholder="telefone" pattern="[0-9]{11}" required>
        <input value="<?php echo $cep?>" type="text" id="cep" class="cep" name="cep" placeholder="cep" pattern="[0-9]{8}" required>
        <input value="<?php echo $rua?>" type="text" id="logradouro" class="address" name="rua" placeholder="rua" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?php echo $bairro?>" type="text" id="bairro" class="address" name="bairro" placeholder="bairro" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?php echo $cidade?>" type="text" id="localidade" class="address" name="cidade" placeholder="cidade" pattern="[A-Za-zÀ-ÿ ]+" required>
        <input value="<?php echo $estado?>" type="text" id="uf" class="address" name="estado" placeholder="estado" pattern="[A-Z]{2}" required>
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
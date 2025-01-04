<?php
    include('protect.php');

    include('config.php');

    $query = "SELECT * FROM cliente AS c
              INNER JOIN endereco as e
              ON c.endereco_id = e.id";

    $res = $conn->query($query) or die("Erro na query SQL:" . $conn->error);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('head.php') ?>
    <title>Painel</title>
</head>

<body class="w-100 min-vh-100 d-flex flex-column justify-content-center align-items-center">

    <?php include('notify.php') ?>
    <?php include('header.php') ?>
    
    <div class="px-2 col-12 col-sm-12 col-md-10 col-lg-7">
        <h1>Usuários</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered m-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($res->num_rows) {
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>
                                        <th scope='row'>{$row['id']}</th>
                                        <td>{$row['nome']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['telefone']}</td>
                                        <td>{$row['rua']}, {$row['bairro']}, {$row['cidade']}, {$row['estado']}, {$row['cep']}</td>
                                        <td>
                                            <div class='d-flex flex-wrap gap-1'>
                                                <a href='/update.php?id={$row['id']}' class='btn btn-warning flex-grow-1'>Editar</a>
                                                <button class='btn btn-danger flex-grow-1' onclick=\"if(confirm('Deseja apagar este usuário?')) { location.assign('./delete.php?id={$row['id']}') }\">Apagar</button>
                                            </div>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='6' class='text-center'>Nenhum cliente encontrado</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- <button type="button" onclick="location.assign('./logout.php')">Sair da conta</button> -->
</body>

</html>
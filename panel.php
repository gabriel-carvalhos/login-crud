<?php
include('includes/protect.php');

require_once 'database/Database.php';
require_once 'database/Client.php';

$client = new Client();
$res = $client->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('includes/head.php') ?>
    <title>Painel</title>
</head>

<body>

    <?php include('includes/notify.php') ?>
    <?php 
        $page = 'panel';
        include('includes/header.php');
    ?>

    <main class="d-flex justify-content-center align-items-center py-4" style="min-height: calc(100vh - 56px);">
        <div class="px-2 col-12 col-sm-12 col-md-10 col-lg-7">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Clientes</h1>
                <a href="/create.php" class="btn btn-success">Cadastrar</a>
            </div>
    
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
                        if (count($res)) {
                            foreach ($res as $row) {
                                echo "<tr>
                                            <th scope='row'>{$row['id']}</th>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td class='phone'>{$row['phone']}</td>
                                            <td>{$row['street']}, {$row['district']}, {$row['city']}, {$row['state']}, <span class='cep'>{$row['cep']}</span></td>
                                            <td>
                                                <div class='d-flex flex-wrap gap-1'>
                                                    <a href='/update.php?id={$row['id']}' class='btn btn-warning flex-grow-1'>Editar</a>
                                                    <button data-bs-toggle='modal' data-bs-target='#deleteModal' data-action='delete.php?id={$row['id']}' class='btn btn-danger flex-grow-1'>Apagar</button>
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
    </main>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar Usuário?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja apagar esse usuário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirm">Deletar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/mask.js"></script>
    <script src="js/deleteModal.js"></script>
</body>

</html>
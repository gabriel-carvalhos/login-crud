<?php
include('protect.php');

include('config.php');

$query = "SELECT * FROM client AS c
          INNER JOIN address AS a
          ON c.address_id = a.id
          ORDER BY c.id DESC";

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
        <h1>Clientes</h1>

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
                                        <td>{$row['name']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['phone']}</td>
                                        <td>{$row['street']}, {$row['district']}, {$row['city']}, {$row['state']}, {$row['cep']}</td>
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

    <script>
        const deleteModal = document.getElementById('deleteModal')
        const confirm = deleteModal.querySelector('#confirm')
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const action = button.getAttribute('data-action')

                confirm.addEventListener('click', () => {
                    location.assign(`/${action}`)
                })
                
            })
        }
    </script>
</body>

</html>
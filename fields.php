<?php
    $res = $res ?? null
?>

<form action="<?= "{$_SERVER['REQUEST_URI']}" ?>" method="post">
    <div class="form-floating mb-3">
        <input class="form-control <?= isset($_SESSION['error_name']) ? 'is-invalid' : '' ?>" id="name" type="text" name="name" placeholder="Nome" value="<?= $_POST['name'] ?? $res?->name ?>">
        <label for="name">Nome</label>
        <div class="invalid-feedback"><?= $_SESSION['error_name'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control <?= isset($_SESSION['error_email']) ? 'is-invalid' : '' ?>" id="email" type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? $res?->email ?>">
        <label for="email">Email</label>
        <div class="invalid-feedback"><?= $_SESSION['error_email'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control <?= isset($_SESSION['error_phone']) ? 'is-invalid' : '' ?>" id="phone" type="tel" name="phone" placeholder="Telefone" value="<?= $_POST['phone'] ?? $res?->phone ?>">
        <label for="phone">Telefone</label>
        <div class="invalid-feedback"><?= $_SESSION['error_phone'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control <?= isset($_SESSION['error_cep']) ? 'is-invalid' : '' ?>" id="cep" type="text" name="cep" placeholder="Cep" value="<?= $_POST['cep'] ?? $res?->cep ?>">
        <label for="cep">Cep</label>
        <div class="invalid-feedback">Cep inválido</div>
        <div class="spinner position-absolute top-50 end-0 translate-middle pe-1 d-none">
            <div class="spinner-border spinner-border-sm text-primary" role="status">
                <span></span>
            </div>
        </div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control address <?= isset($_SESSION['error_street']) ? 'is-invalid' : '' ?>" id="logradouro" type="text" name="street" placeholder="Rua" value="<?= $_POST['street'] ?? $res?->street ?>">
        <label for="street">Rua</label>
        <div class="invalid-feedback"><?= $_SESSION['error_street'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control address <?= isset($_SESSION['error_district']) ? 'is-invalid' : '' ?>" id="bairro" type="text" name="district" placeholder="Bairro" value="<?= $_POST['district'] ?? $res?->district ?>">
        <label for="district">Bairro</label>
        <div class="invalid-feedback"><?= $_SESSION['error_district'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control address <?= isset($_SESSION['error_city']) ? 'is-invalid' : '' ?>" id="localidade" type="text" name="city" placeholder="Cidade" value="<?= $_POST['city'] ?? $res?->city ?>">
        <label for="city">Cidade</label>
        <div class="invalid-feedback"><?= $_SESSION['error_city'] ?></div>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control address <?= isset($_SESSION['error_state']) ? 'is-invalid' : '' ?>" id="uf" type="text" name="state" placeholder="Estado" value="<?= $_POST['state'] ?? $res?->state ?>">
        <label for="state">Estado</label>
        <div class="invalid-feedback"><?= $_SESSION['error_state'] ?></div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary flex-grow-1" type="submit">Enviar</button>
        <a class="btn btn-light flex-grow-1" href="/panel.php">Voltar</a>
    </div>
</form>

<script>
    $('#phone').mask('(00) 00000-0000')
    $('#cep').mask('00000-000')
</script>
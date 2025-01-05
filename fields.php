<?php
    $res = $res ?? null
?>
<form action="<?= "{$_SERVER['REQUEST_URI']}" ?>" method="post">
    <div class="form-floating mb-3">
        <input required class="form-control" id="name" type="text" name="name" placeholder="Nome" value="<?= $_POST['name'] ?? $res?->name ?>">
        <label for="name">Nome</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? $res?->email ?>">
        <label for="email">Email</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="phone" type="tel" name="phone" placeholder="Telefone" value="<?= $_POST['phone'] ?? $res?->phone ?>">
        <label for="phone">Telefone</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="cep" type="text" name="cep" placeholder="Cep" value="<?= $_POST['cep'] ?? $res?->cep ?>">
        <label for="cep">Cep</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="street" type="text" name="street" placeholder="Rua" value="<?= $_POST['street'] ?? $res?->street ?>">
        <label for="street">Rua</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="district" type="text" name="district" placeholder="Bairro" value="<?= $_POST['district'] ?? $res?->district ?>">
        <label for="district">Bairro</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="city" type="text" name="city" placeholder="Cidade" value="<?= $_POST['city'] ?? $res?->city ?>">
        <label for="city">Cidade</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-floating mb-3">
        <input required class="form-control" id="state" type="text" name="state" placeholder="Estado" value="<?= $_POST['state'] ?? $res?->state ?>">
        <label for="state">Estado</label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary flex-grow-1" type="submit">Criar</button>
        <a class="btn btn-light flex-grow-1" href="/panel.php">Voltar</a>
    </div>
</form>
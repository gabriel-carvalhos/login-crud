<?php
require_once 'database/Database.php';
require_once 'database/User.php';

session_start();

if (isset($_SESSION['id'])) {
    $_SESSION['login'] = 'Logado com sucesso!';
    header('Location: panel.php');
    die();
}

if (isset($_POST['email']) || isset($_POST['password'])) {
    login();
}

function login() {
    if (!validateFields('email', 'Campo de E-mail vazio!')) return;
    
    if (!validateFields('password', 'Campo de Senha vazio!')) return;
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $res = $user->findByEmail($email);

    if (!$res || !password_verify($password, $res['password'])) {
        $_SESSION['error_email'] = 'Email ou senha incorreta!';
        return;
    }

    $_SESSION['id'] = $res['id'];
    $_SESSION['login'] = 'Logado com sucesso!';

    header("Location: panel.php");
    die();
}

function validateFields($field, $msg) {
    if (strlen($_POST[$field]) == 0) {
        $_SESSION["error_$field"] = $msg;
        return false;
    }

    return true;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('includes/head.php') ?>
    <title>Login</title>
</head>

<body>
    
    <main class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <h1 class="mb-3">Login</h1>
    
                <div class="form-floating mb-3">
                    <input class="form-control <?= isset($_SESSION['error_email']) ? 'is-invalid' : '' ?>" id="email" type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
                    <label for="email">Digite seu email (admin@admin.com)</label>
                    <div class="invalid-feedback"><?= $_SESSION['error_email'] ?></div>
                </div>
    
                <div class="form-floating">
                    <input class="form-control <?= isset($_SESSION['error_password']) ? 'is-invalid' : '' ?>" id="password" type="password" name="password" placeholder="Senha" value="<?= $_POST['password'] ?? '' ?>">
                    <label for="password">Digite sua senha (admin)</label>
                    <div class="invalid-feedback"><?= $_SESSION['error_password'] ?></div>
                </div>
    
                <button class="btn btn-primary mt-3 w-100" type="submit">Entrar</button>
            </form>
        </div>
    </main>

    <?php include('includes/notify.php') ?>
</body>

</html>
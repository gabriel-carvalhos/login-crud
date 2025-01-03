<?php
include('config.php');

session_start();

if (isset($_SESSION['id'])) {
    $_SESSION['login'] = 'Logado com sucesso!';
    header('Location: panel.php');
    die();
}

if (isset($_POST['email']) || isset($_POST['password'])) {
    login($conn);
}

function login($conn) {
    if (!validateFields($_POST['email'], 'Campo de E-mail vazio!')) return;
    
    if (!validateFields($_POST['password'], 'Campo de Senha vazio!')) return;
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email_usuarios = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if (!$res || !password_verify($password, $res['senha_usuarios'])) {
        $_SESSION['error'] = 'Email ou senha incorreta!';
        return;
    }

    $_SESSION['id'] = $res['id_usuarios'];
    $_SESSION['login'] = 'Logado com sucesso!';

    header("Location: panel.php");
    die();

}

function validateFields($field, $msg) {
    if (strlen($field) == 0) {
        $_SESSION['error'] = $msg;
        return false;
    }

    return true;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('head.php') ?>
    <title>Login</title>
</head>

<body class="w-100 vh-100 d-flex flex-column justify-content-center align-items-center">

    <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <?php include('notify.php') ?>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <h1 class="mb-3">Login</h1>

            <div class="form-floating mb-3">
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
                <label for="email">Digite seu email (admin@admin.com)</label>
            </div>

            <div class="form-floating">
                <input class="form-control" id="password" type="password" name="password" placeholder="Senha" value="<?= $_POST['password'] ?? '' ?>">
                <label for="password">Digite sua senha (admin)</label>
            </div>

            <button class="btn btn-primary mt-3 w-100" type="submit">Entrar</button>
        </form>
    </div>

</body>

</html>
<?php
include('config.php');

session_start();

if (isset($_SESSION['id'])) {
    $_SESSION['login'] = 'Logado com sucesso!';
    header('Location: panel.php');
    die();
}

if (isset($_POST['email']) || isset($_POST['password'])) {
    if (strlen($_POST['email']) == 0) {
        $_SESSION['error'] = 'Campo de E-mail vazio!';
    } else if (strlen($_POST['password']) == 0) {
        $_SESSION['error'] = 'Campo de Senha vazio!';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE email_usuarios = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();

        if (!$res) {
            $_SESSION['error'] = 'Email incorreto!';
        } else {
            if (password_verify($password, $res['senha_usuarios'])) {
                $_SESSION['id'] = $res['id_usuarios'];
                $_SESSION['login'] = 'Logado com sucesso!';

                header("Location: panel.php");
                die();
            } else {
                $_SESSION['error'] = 'Senha incorreta!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="w-100 vh-100 d-flex flex-column justify-content-center align-items-center">
    <?php
        $email_value = $_POST['email'] ?? '';
        $password_value = $_POST['password'] ?? '';
    ?>

    <div class="container col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
        
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php } else if (isset($_SESSION['logout'])) { ?>
            <div class="alert alert-primary" role="alert"><?= $_SESSION['logout'] ?></div>
            <?php unset($_SESSION['logout']); ?>
        <?php } ?>

        <form class="" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <h1 class="mb-3">Login</h1>

            <div class="form-floating mb-3">
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?= $email_value ?>">
                <label for="email">Digite seu email (admin@admin.com)</label>
            </div>

            <div class="form-floating">
                <input class="form-control" id="password" type="password" name="password" placeholder="Senha" value="<?= $password_value ?>">
                <label for="password">Digite sua senha (admin)</label>
            </div>

            <button class="btn btn-primary mt-3 w-100" type="submit">Entrar</button>
        </form>
    </div>

    
</body>

</html>
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
            echo "Campo de E-mail vazio!";
        } else if (strlen($_POST['password']) == 0) {
            echo "Campo de Senha vazio!";
        } else {
            # salvar campos email senha, evitando SQL injection
            $email = $_POST['email'];
            $password = $_POST['password'];

            # sql query
            $query = "SELECT * FROM usuarios WHERE email_usuarios = ? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            # var_dump($res);
            
            if (!$res) {
                echo "Email incorreto!";
            } else {
                if (password_verify($password, $res['senha_usuarios'])) {
                    $_SESSION['id'] = $res['id_usuarios'];
                    $_SESSION['login'] = 'Logado com sucesso!';

                    header("Location: panel.php");
                    die();
                } else {
                    echo 'Senha incorreta!';
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
</head>
<body>
    <?php
        $email_value = $_POST['email'] ?? '';
        $password_value = $_POST['password'] ?? '';
    ?>

    <?php 
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } else if (isset($_SESSION['logout'])) {
            echo $_SESSION['logout'];
            unset($_SESSION['logout']);
        }
    ?>

    <h1>Login</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="email" name="email" placeholder="Email" value="<?=$email_value?>"><br>
        <input type="password" name="password" placeholder="Senha" value="<?=$password_value?>"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
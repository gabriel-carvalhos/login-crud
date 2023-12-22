<?php 
    include('config.php');

    session_start();

    if (isset($_SESSION['id'])) {
        header('Location: panel.php');
    }
    
    if (isset($_POST['email']) || isset($_POST['password'])) {
        if (strlen($_POST['email']) == 0) {
            echo "Campo de E-mail vazio!";
        } else if (strlen($_POST['password']) == 0) {
            echo "Campo de Senha vazio!";
        } else {
            # salvar campos email senha, evitando SQL injection
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['password']);

            # sql query
            $query = "SELECT * FROM usuarios WHERE email_usuarios = '$email' LIMIT 1";
            $sql_query = $conn->query($query) or die("Erro na query SQL:" . $conn->error);
            
            $empty_query = !$sql_query->num_rows;

            if ($empty_query) {
                echo "Email incorreto!";
            } else {
                $user = $sql_query->fetch_assoc();
                if (password_verify($password, $user['senha_usuarios'])) {
                    $_SESSION['id'] = $user['id_usuarios'];

                    header("Location: panel.php");
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
        <input type="text" name="email" placeholder="Email" value="<?=$email_value?>"><br>
        <input type="password" name="password" placeholder="Senha" value="<?=$password_value?>"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
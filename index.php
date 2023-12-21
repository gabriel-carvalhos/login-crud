<?php 
    include('config.php');
    
    if (isset($_POST['email']) || isset($_POST['password'])) {

        if (strlen($_POST['email']) == 0) {
            echo "Campo de E-mail vazio!";
        } else if (strlen($_POST['password']) == 0) {
            echo "Campo de Senha vazio!";
        } else {
            # salvar campos email senha, evitando SQL injection
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->real_escape_string($_POST['password']);

            # sql query
            $query = "SELECT * FROM usuarios WHERE email_usuarios = '$email' LIMIT 1";
            $sql_query = $mysqli->query($query) or die("Erro na query SQL:" . $mysqli->error);
            
            $empty_query = !$sql_query->num_rows;

            if ($empty_query) {
                echo "Email incorreto!";
            } else {
                $user = $sql_query->fetch_assoc();
                if (password_verify($password, $user['senha_usuarios'])) {
                    # config session
                    if (!isset($_SESSION)) {
                        session_start();
                    }

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
    <title>Document</title>
</head>
<body>
    <?php 
        $emailVal = $_POST['email'] ?? '';
        $passwordlVal = $_POST['password'] ?? '';
    ?>

    <h1>Login</h1>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" value="<?= $emailVal?>"><br>
        <input type="password" name="password" placeholder="Senha" value="<?= $passwordlVal?>"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
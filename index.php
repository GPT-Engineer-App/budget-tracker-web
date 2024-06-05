<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

        $query = "INSERT INTO usuario (nomeCompleto, email, senha) VALUES ('$nomeCompleto', '$email', '$senha')";
        mysqli_query($conn, $query);
        $_SESSION['email'] = $email;
        header('Location: home.php');
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $query = "SELECT * FROM usuario WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if (password_verify($senha, $user['senha'])) {
            $_SESSION['email'] = $email;
            header('Location: home.php');
        } else {
            echo "Email ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Login</button>
        </form>
        <h2>Cadastro</h2>
        <form method="POST">
            <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="register">Cadastrar</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];

    $query = "INSERT INTO economia (descricao, valor, data, usuario_email) VALUES ('$descricao', '$valor', '$data', '{$_SESSION['email']}')";
    mysqli_query($conn, $query);
    header('Location: economias.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Economia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Economia</h1>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" step="0.01" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>
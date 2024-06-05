<?php
session_start();
include('db.php');
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $valor_atual = $_POST['valor_atual'];
    $retorno = $_POST['retorno'];
    $data = $_POST['data'];

    $query = "INSERT INTO investimento (nome, valor_atual, retorno, data, usuario_email) VALUES ('$nome', '$valor_atual', '$retorno', '$data', '{$_SESSION['email']}')";
    mysqli_query($conn, $query);
    header('Location: investimentos.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Investimento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Investimento</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="number" step="0.01" name="valor_atual" placeholder="Valor Atual" required>
            <input type="number" step="0.01" name="retorno" placeholder="Retorno" required>
            <input type="date" name="data" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>
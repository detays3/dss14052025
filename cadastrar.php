<?php
// Conexão
$host = "localhost";
$user = "root";
$pass = "";
$db = "cadastro_produtos";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) 
{
    die("Erro na conexão: " . $conn->connect_error);
}

// Validação
$nome = trim($_POST['nome']);
$preco = floatval($_POST['preco']);
$descricao = trim($_POST['descricao']);

if (!$nome || !$preco || !$descricao || $preco <= 0) 
{
    die("Dados inválidos. Verifique o formulário.");
}

// Inserção segura com prepared statement
$stmt = $conn->prepare("INSERT INTO produtos (nome, preco, descricao) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $nome, $preco, $descricao);

if ($stmt->execute()) 
{
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar produto.";
}

$stmt->close();
$conn->close();
?>

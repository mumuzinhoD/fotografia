<?php
// Configuração do banco de dados
$servidor = 'localhost';
$usuario = 'usuario';
$senha = 'senha';
$banco_de_dados = 'banco_de_dados';

// Conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco_de_dados);

// Verifique a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header("Location: index.php");
    exit();
}

// Fecha a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include_once '../includes/header.php'; ?>
<body>
    <h1>Perfil do Cliente</h1>
    <p>Nome: <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
    <p>E-mail: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <a href="index.php">Voltar para Cadastro</a>
</body>
</html>

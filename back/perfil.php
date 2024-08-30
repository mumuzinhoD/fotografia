<?php
// Configuração do banco de dados
$servidor = 'localhost';
$usuario = 'root'; // Usuário padrão do MySQL no XAMPP
$senha = ''; // Senha padrão é vazia no XAMPP
$banco_de_dados = 'fotografia'; // Nome do banco de dados

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
    header("Location: index.php"); // Redireciona para a página de login/cadastro se não estiver logado
    exit();
}

// Pega o nome do usuário da sessão
$nome = $_SESSION['nome'];

// Recupera os dados do usuário logado
$query = "SELECT * FROM clientes WHERE nome = '$nome'"; // Use 'clientes' ou 'usuarios' conforme necessário
$result = $conexao->query($query);

// Verifica se o usuário existe
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Cliente</title>
</head>
<body>
    <h1>Perfil do Cliente</h1>
    <p>Nome: <?php echo htmlspecialchars($usuario['nome']); ?></p>
    <p>E-mail: <?php echo htmlspecialchars($usuario['email']); ?></p>
    
    <a href="index.php">Voltar para Cadastro</a>
</body>
</html>

<?php
// Fecha a conexão
$conexao->close();
?>

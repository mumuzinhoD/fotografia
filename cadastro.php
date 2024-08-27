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

// Processa o cadastro se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Protege a senha com hash
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere os dados no banco de dados
    $query = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
    if ($conexao->query($query) === TRUE) {
        // Salva as informações na sessão
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        // Redireciona para a página de perfil
        header("Location: perfil.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
}

// Fecha a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include_once 'includes/header.php'; ?>
<body>
    <h2>Cadastro de Cliente</h2>
    <form action="index.php" method="post">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</body>
</html>

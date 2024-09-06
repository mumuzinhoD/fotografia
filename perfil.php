<?php
session_start();
include 'includes/conexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirecionar para a página de login se não estiver autenticado
    exit();
}

// Obter os dados do usuário
$email = $_SESSION['email'];
$stmt = $connect->prepare("SELECT id, nome, email FROM clientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $nome, $email);
$stmt->fetch();
$stmt->close();

// Atualizar as informações do perfil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    if (!empty($senha)) {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $connect->prepare("UPDATE clientes SET nome = ?, senha = ? WHERE email = ?");
        $stmt->bind_param("sss", $nome, $hashed_password, $email);
    } else {
        $stmt = $connect->prepare("UPDATE clientes SET nome = ? WHERE email = ?");
        $stmt->bind_param("ss", $nome, $email);
    }
    
    $stmt->execute();
    $stmt->close();
    echo "Perfil atualizado com sucesso!";
}

// Excluir a conta do usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stmt = $connect->prepare("DELETE FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
    
    // Destruir a sessão e redirecionar para a página de login
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f4f4f4;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #f4f4f4;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #444;
            color: #f4f4f4;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }
        
        .alert {
            color: #f4f4f4;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Perfil</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha">
                <small>Deixe em branco se não quiser alterar a senha.</small>
            </div>
            <button type="submit" name="update">Atualizar Perfil</button>
        </form>
        <form action="" method="post">
            <button type="submit" name="delete" style="background-color: #d9534f;">Excluir Conta</button>
        </form>
        <div class="alert">
            <a href="index.php">Voltar para a página inicial</a>
        </div>
    </div>
</body>
</html>

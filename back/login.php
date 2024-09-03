<?php
session_start();
include '../includes/conexao.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta para evitar SQL Injection
    $stmt = $connect->prepare("SELECT senha FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verificar se a senha informada corresponde ao hash armazenado
        if (password_verify($senha, $hashed_password)) {
            // Iniciar a sessão e redirecionar para a página inicial
            $_SESSION['email'] = $email;
            header("Location: ../index.php"); // Redirecione para a página de sucesso
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta!";
        }
    } else {
        // E-mail não encontrado
        echo "E-mail não encontrado!";
    }

    $stmt->close();
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
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
            max-width: 400px;
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
        input[type="email"],
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
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .entrar {
            top: 500px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Cliente</h2>
        <form action="back/login.php" method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Login</button>
            <br>
            <hr>
            <div class="entrar">
                <a href="cadastro_usuario.php">Cadastrar</a>
            </div>
        </form>
    </div>
</body>
</html>

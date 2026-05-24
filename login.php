<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="style.css">

<?php
$host="localhost";
$user="root";
$pass="";
$db="sistema";

$conn = new mysqli(
    $host,
    $user,
    $pass,
    $db
);

if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}

$mensagem="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $login = trim($_POST["login"]);
    $senha = trim($_POST["senha"]);

    if(empty($login) || empty($senha)){
        $mensagem="⚠ Preencha todos os campos";
    }
    else{

        // tabela usuarios
        $sql = "SELECT * FROM usuarios 
                WHERE login='$login' 
                AND senha='$senha'";

        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){

            header("Location: acesso.php");
            exit();

        }else{

            $mensagem="❌ Login ou senha incorretos";

        }
    }
}
?>

</head>

<body>

    <h1>Login</h1>

    <h3>Este conteúdo é reservado para usuários cadastrados.</h3>

    <form method="POST">
    
        <div>
            <label>Login:</label>

            <input
            type="text"
            name="login"
            placeholder="Informe seu Login"
            maxlength="10"
            required>
        </div>

        <br>

        <div>

            <label>Senha:</label>

            <input
            type="password"
            name="senha"
            placeholder="Informe sua Senha"
            maxlength="8"
            required>

        </div>

        <br>

        <div class="redefinir-senha">
            <a href="recuperar.php">
                Esqueceu sua senha?
            </a>
        </div>

        <br>

        <button type="submit">
            Entrar
        </button>

    </form>

    <p style="color:red;">
        <?php echo $mensagem; ?>
    </p>

</body>
</html>
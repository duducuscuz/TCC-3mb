<?php
session_start();

// CONEXÃO BANCO
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
    die("Erro ao conectar");
}


// GERA POSIÇÃO ALEATÓRIA
if(!isset($_SESSION['posicao'])){

    $_SESSION['posicao']=rand(1,40);

}

$posicao=$_SESSION['posicao'];

$erro="";


// VERIFICA CHAVE
if(isset($_POST['entrar'])){

    $chave=$_POST['chave'];

    $sql="SELECT * FROM chaves
    WHERE posicao='$posicao'
    AND codigo='$chave'";

    $resultado=$conn->query($sql);


    if($resultado->num_rows > 0){

        unset($_SESSION['posicao']);

        header("Location: index.php");

        exit();

    }else{

        $erro="Chave incorreta!";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Chave de Acesso</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="topo">

<h1>Login</h1>

</div>


<div class="box">

<p>
Este conteúdo é reservado para usuários cadastrados.
</p>

<p>

Nº acesso - posição:

<b>

<?php echo $posicao; ?>

</b>

</p>

</div>


<form method="POST">

<input
type="text"
name="chave"
maxlength="4"
placeholder="Digite a chave"
required>

<br><br>

<button
type="submit"
name="entrar">

Entrar

</button>

</form>


<br>


<a href="login.php">

<button>

Voltar

</button>

</a>


<?php

if($erro!=""){

echo "<p style='color:red'>$erro</p>";

}

?>

</body>

</html>
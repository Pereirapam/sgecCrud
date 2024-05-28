<?php
session_start();
// var_dump($_SESSION['id']);
if(!isset($_SESSION['id'])){
    header('Location: login.php');
    exit();
}

echo $_SESSION['nome'];
?>

<a href="Verify/logout.php">Sair da conta</a>
<h1>Seja bem vindo <?php echo $_SESSION['nome']; ?></h1>
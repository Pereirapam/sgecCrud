<?php
//conexao que liga o php com o mySQL S2

$db_name = 'sgec';
$db_host = 'localhost:3306';
$db_user = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "deu certo";
 
} catch (PDOException $error) {
    echo 'Não deu certo' . $error->getMessage();
}





<?php

if(isset($_POST['btnDelete'])){
    require 'config.php';

    $id = $_POST['idEspacos'];
    $nome = $_POST['nome'];

    $sql = "DELETE FROM espacos WHERE idEspacos = :id";
    $result = $pdo->prepare($sql);
    $result->bindValue(":id", $id);
    $result->execute();

    header('Location: ../home.php?delete=ok');
}
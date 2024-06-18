<?php
if (isset($_POST['btnInsert'])) {
    require 'config.php';
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    $capacidade = $_POST['capacidade'];
    $preco = $_POST['preco'];
    $idCategoria = $_POST['idCategoria'];


    $sql = "INSERT INTO espacos (nome, endereco, descricao, capacidade, preco, idCategoria) VALUES (:nome, :endereco, :descricao, :capacidade, :preco, :idCategoria)";
    $result = $pdo->prepare($sql);
    $result->bindValue(":nome", $nome);
    $result->bindValue(":endereco", $endereco);
    $result->bindValue(":descricao", $descricao);
    $result->bindValue(":capacidade", $capacidade);
    $result->bindValue(":preco", $preco);
    $result->bindValue(":idCategoria", $idCategoria);
    $result->execute();

    header('Location: ../home.php?sucesso=ok');
} else {
    header('Location: ../home.php?error=404');
}

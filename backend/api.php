<?php
include 'config/database.php';

// Se for GET - listar dados
if (isset($_GET['action']) && $_GET['action'] == 'listar') {
    $sql = "SELECT * FROM tb_infraestrutura_escolar";
    $result = $pdo->query($sql);
    $dados = $result->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($dados);
}

// Se for POST - criar novo
if (isset($_POST['action']) && $_POST['action'] == 'criar') {
    $nome = $_POST['nome_escola'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    
    $sql = "INSERT INTO tb_infraestrutura_escolar (nome_escola, endereco, bairro) VALUES ('$nome', '$endereco', '$bairro')";
    
    if ($pdo->exec($sql)) {
        echo "Sucesso!";
    } else {
        echo "Erro!";
    }
}

// Se for deletar
if (isset($_GET['action']) && $_GET['action'] == 'deletar') {
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_infraestrutura_escolar WHERE id = $id";
    
    if ($pdo->exec($sql)) {
        echo "Deletado!";
    } else {
        echo "Erro!";
    }
}
?>
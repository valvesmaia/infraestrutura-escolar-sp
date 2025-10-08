<?php
// TESTE SIMPLES - ignora o .env temporariamente
try {
    $pdo = new PDO(
        "mysql:host=localhost;charset=utf8mb4",
        "root",
        "" // senha vazia
    );
    echo "✅ CONEXÃO OK!";
    
    // Tenta criar o banco
    $pdo->exec("CREATE DATABASE IF NOT EXISTS infraestrutura_escolar");
    echo "<br>✅ BANCO CRIADO/VERIFICADO!";
    
} catch(PDOException $e) {
    echo "❌ ERRO: " . $e->getMessage();
}
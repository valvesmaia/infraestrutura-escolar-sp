<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Content-Type: application/json');
    echo json_encode(['logado' => false]);
    exit;
}

echo json_encode(['logado' => true, 'usuario' => $_SESSION['usuario']]);
?>
<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'infraestrutura_escolar';

$pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

if (!$pdo) {
    echo "Erro ao conectar no banco!";
    exit;
}
?>
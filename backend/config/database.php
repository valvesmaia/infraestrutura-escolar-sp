<?php
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'infraestrutura_escolar';

    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8mb4", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        $mensagemErro = "Erro de conexão com o banco de dados.";
        
        // Identificar tipo de erro
        if (strpos($e->getMessage(), 'getaddrinfo') !== false || strpos($e->getMessage(), 'host') !== false) {
            $mensagemErro = "Erro: Não foi possível conectar ao servidor.";
        } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
            $mensagemErro = "Erro: Usuário ou senha do banco de dados incorretos.";
        } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
            $mensagemErro = "Erro: Banco de dados '$banco' não encontrado.";
        }
        
        // Exibir página de erro formatada
        http_response_code(500);
        die("
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <title>Erro de Conexão</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container py-5'>
                <div class='row justify-content-center'>
                    <div class='col-md-6'>
                        <div class='alert alert-danger'>
                            <h4 class='alert-heading'><i class='bi bi-exclamation-triangle'></i> Erro de Conexão</h4>
                            <p>$mensagemErro</p>
                            <hr>
                            <p class='mb-0'><strong>Detalhes:</strong><br><small>" . htmlspecialchars($e->getMessage()) . "</small></p>
                        </div>
                        <div class='d-grid gap-2'>
                            <a href='login.php' class='btn btn-primary'>Tentar Novamente</a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ");
    }
?>
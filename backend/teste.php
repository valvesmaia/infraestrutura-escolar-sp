<!DOCTYPE html>
<html>
<head>
    <title>Teste Conexão</title>
</head>
<body>
    <h1>Teste do Sistema</h1>
    
    <h2>1. Teste de Conexão:</h2>
    <?php include 'config/database.php'; ?>
    
    <h2>2. Teste Upload CSV:</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv">
        <button type="submit">Enviar CSV</button>
    </form>
    
    <h2>3. Ver dados:</h2>
    <a href="api.php?action=listar">Ver todos os registros</a>
</body>
</html>
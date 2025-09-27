<?php
include 'config/database.php';

if (isset($_FILES['csv_file'])) {
    
    $arquivo = $_FILES['csv_file'];
    $nome_arquivo = $arquivo['name'];
    
    // Verificar se é CSV
    if (strpos($nome_arquivo, '.csv') === false) {
        echo "Erro: Só aceita arquivo CSV!";
        exit;
    }
    
    // Ler o arquivo
    $handle = fopen($arquivo['tmp_name'], "r");
    
    if ($handle) {
        
        // Pular primeira linha (cabeçalho)
        $primeira_linha = fgetcsv($handle);
        $contador = 0;
        
        // Ler linha por linha
        while (($linha = fgetcsv($handle)) !== FALSE) {
            
            $nome_escola = $linha[0];
            $endereco = $linha[1];
            $bairro = $linha[2];
            $distrito = $linha[3];
            $tipo_instalacao = $linha[4];
            
            // Só inserir se tem nome da escola
            if (!empty($nome_escola)) {
                
                $sql = "INSERT INTO tb_infraestrutura_escolar (nome_escola, endereco, bairro, distrito, tipo_instalacao) 
                        VALUES ('$nome_escola', '$endereco', '$bairro', '$distrito', '$tipo_instalacao')";
                
                if ($pdo->exec($sql)) {
                    $contador++;
                }
            }
        }
        
        fclose($handle);
        
        echo "Upload concluído! $contador registros inseridos.";
        
    } else {
        echo "Erro ao ler arquivo!";
    }
    
} else {
    echo "Nenhum arquivo enviado!";
}
?>
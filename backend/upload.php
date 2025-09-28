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
        $primeira_linha = fgetcsv($handle, 0, ';');
        $contador = 0;
        $erros = 0;
        
        // Preparar statement - CORRIGIDO: Incluído nomedep no INSERT
        $sql = "INSERT INTO tb_infraestrutura_escolar 
                (codesc, nomedep, nomesc, mun, distr, tipoesc_desc, salas_aula, biblioteca, quadra_coberta, quadra_descoberta, refeitorio, laboratorio_info, laboratorio_ciencias) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        
        // Ler linha por linha
        while (($linha = fgetcsv($handle, 0, ';')) !== FALSE) {
            
            // Mapear campos do CSV
            $codesc = isset($linha[4]) ? $linha[4] : '';
            $nomedep = isset($linha[0]) ? $linha[0] : '';
            $nomesc = isset($linha[5]) ? $linha[5] : '';
            $mun = isset($linha[2]) ? $linha[2] : '';
            $distr = isset($linha[3]) ? $linha[3] : '';
            $tipoesc_desc = isset($linha[7]) ? $linha[7] : '';
            $salas_aula = isset($linha[10]) ? (int)$linha[10] : 0;
            $biblioteca = isset($linha[27]) ? (int)$linha[27] : 0;
            $quadra_coberta = isset($linha[29]) ? (int)$linha[29] : 0;
            $quadra_descoberta = isset($linha[30]) ? (int)$linha[30] : 0;
            $refeitorio = isset($linha[22]) ? (int)$linha[22] : 0;
            $laboratorio_info = isset($linha[56]) ? (int)$linha[56] : 0;
            $laboratorio_ciencias = isset($linha[57]) ? (int)$linha[57] : 0;
            
            // Só inserir se tem código e nome da escola
            if (!empty($codesc) && !empty($nomesc)) {
                
                try {
                    // CORRIGIDO: Incluído $nomedep no array de valores
                    $stmt->execute([
                        $codesc, $nomedep, $nomesc, $mun, $distr, $tipoesc_desc, 
                        $salas_aula, $biblioteca, $quadra_coberta, 
                        $quadra_descoberta, $refeitorio, $laboratorio_info, 
                        $laboratorio_ciencias
                    ]);
                    $contador++;
                    
                } catch(PDOException $e) {
                    $erros++;
                }
            } else {
                $erros++;
            }
        }
        
        fclose($handle);
        
        // Mostrar apenas resultado final
        if ($contador > 0) {
            echo "✅ Upload realizado com sucesso! $contador registros importados.";
            if ($erros > 0) {
                echo " ($erros registros com erro foram ignorados)";
            }
        } else {
            echo "❌ Erro: Nenhum registro foi importado. Verifique o formato do arquivo.";
        }
        
    } else {
        echo "❌ Erro: Não foi possível ler o arquivo.";
    }
    
} else {
    echo "❌ Erro: Nenhum arquivo foi enviado.";
}
?>
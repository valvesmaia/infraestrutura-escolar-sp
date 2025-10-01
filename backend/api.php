<?php
    include 'config/database.php';

    // Se for GET - listar dados
    if (isset($_GET['action']) && $_GET['action'] == 'listar') {
        $sql = "SELECT * FROM tb_infraestrutura_escolar ORDER BY id DESC";
        $result = $pdo->query($sql);
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($dados);
    }

    // Se for POST - criar novo
    if (isset($_POST['action']) && $_POST['action'] == 'criar') {
        $codesc = $_POST['codesc'];
        $nomedep = $_POST['nomedep'];
        $nomesc = $_POST['nomesc'];
        $mun = $_POST['mun'];
        $distr = $_POST['distr'];
        $tipoesc_desc = $_POST['tipoesc_desc'];
        $salas_aula = $_POST['salas_aula'];
        $biblioteca = $_POST['biblioteca'];
        $quadra_coberta = $_POST['quadra_coberta'];
        $quadra_descoberta = $_POST['quadra_descoberta'];
        $refeitorio = $_POST['refeitorio'];
        $laboratorio_info = $_POST['laboratorio_info'];
        $laboratorio_ciencias = $_POST['laboratorio_ciencias'];
        
        $sql = "INSERT INTO tb_infraestrutura_escolar 
                (codesc, nomedep, nomesc, mun, distr, tipoesc_desc, salas_aula, biblioteca, quadra_coberta, quadra_descoberta, refeitorio, laboratorio_info, laboratorio_ciencias) 
                VALUES ('$codesc', '$nomedep', '$nomesc', '$mun', '$distr', '$tipoesc_desc', $salas_aula, $biblioteca, $quadra_coberta, $quadra_descoberta, $refeitorio, $laboratorio_info, $laboratorio_ciencias)";
        
        if ($pdo->exec($sql)) {
            echo "Sucesso!";
        } else {
            echo "Erro!";
        }
    }

    // Se for editar
    if (isset($_POST['action']) && $_POST['action'] == 'editar') {
        $id = $_GET['id'];
        $codesc = $_POST['codesc'];
        $nomedep = $_POST['nomedep'];
        $nomesc = $_POST['nomesc'];
        $mun = $_POST['mun'];
        $distr = $_POST['distr'];
        $tipoesc_desc = $_POST['tipoesc_desc'];
        $salas_aula = $_POST['salas_aula'];
        $biblioteca = $_POST['biblioteca'];
        $quadra_coberta = $_POST['quadra_coberta'];
        $quadra_descoberta = $_POST['quadra_descoberta'];
        $refeitorio = $_POST['refeitorio'];
        $laboratorio_info = $_POST['laboratorio_info'];
        $laboratorio_ciencias = $_POST['laboratorio_ciencias'];
        
        $sql = "UPDATE tb_infraestrutura_escolar SET 
                codesc='$codesc', nomedep='$nomedep', nomesc='$nomesc', mun='$mun', distr='$distr', 
                tipoesc_desc='$tipoesc_desc', salas_aula=$salas_aula, biblioteca=$biblioteca,
                quadra_coberta=$quadra_coberta, quadra_descoberta=$quadra_descoberta,
                refeitorio=$refeitorio, laboratorio_info=$laboratorio_info,
                laboratorio_ciencias=$laboratorio_ciencias
                WHERE id=$id";
        
        if ($pdo->exec($sql)) {
            echo "Atualizado!";
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
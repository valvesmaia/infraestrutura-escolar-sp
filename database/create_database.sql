/* Tabela para armazenar os dados de infraestrutura escolar */
CREATE TABLE tb_infraestrutura_escolar (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nomedep VARCHAR(100) DEFAULT NULL,
    codesc VARCHAR(20) NOT NULL,
    nomesc VARCHAR(255) NOT NULL,
    mun VARCHAR(100) NOT NULL,
    distr VARCHAR(100) NOT NULL,
    tipoesc_desc VARCHAR(100) DEFAULT NULL,
    salas_aula INT(11) DEFAULT 0,
    biblioteca TINYINT(1) DEFAULT 0,
    quadra_coberta TINYINT(1) DEFAULT 0,
    quadra_descoberta TINYINT(1) DEFAULT 0,
    refeitorio TINYINT(1) DEFAULT 0,
    laboratorio_info TINYINT(1) DEFAULT 0,
    laboratorio_ciencias TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/* Tabela para armazenar os dados dos usuários */
CREATE TABLE usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    senha VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY idx_usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

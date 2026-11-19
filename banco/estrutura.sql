-- Projeto Final - Painel ENADE - Grupo 02 (recorte R01)
-- Estrutura do banco: usuário, oferta, resultado e ação, com as regras mínimas do enunciado.
-- Murilo Alves
-- Importar com o banco do projeto selecionado (apaga e recria as 4 tabelas).

-- APAGAR TABELAS ANTIGAS:
DROP TABLE IF EXISTS acoes;
DROP TABLE IF EXISTS resultados;
DROP TABLE IF EXISTS ofertas;
DROP TABLE IF EXISTS usuarios;

-- CRIAR TABELAS:
-- Usuário (senha guardada com password_hash, como na Aula 12):
CREATE TABLE usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(60) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuarios_login (login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Oferta = curso + grau + modalidade (id igual ao do CSV: O01, O02, O32):
CREATE TABLE ofertas (
    id VARCHAR(3) NOT NULL,
    recorte_id VARCHAR(3) NOT NULL,
    curso VARCHAR(150) NOT NULL,
    grau_academico VARCHAR(30) NOT NULL,
    modalidade VARCHAR(30) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_ofertas_curso_grau_modalidade (curso, grau_academico, modalidade)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Resultado ENADE por oferta e ano (notas com 5 casas, como no CSV):
CREATE TABLE resultados (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    oferta_id VARCHAR(3) NOT NULL,
    ano SMALLINT UNSIGNED NOT NULL,
    inscritos INT UNSIGNED NOT NULL,
    participantes INT UNSIGNED NOT NULL,
    nota_formacao_geral DECIMAL(8, 5) NOT NULL,
    nota_componente_especifico DECIMAL(8, 5) NOT NULL,
    conceito_continuo DECIMAL(7, 5) NOT NULL,
    conceito_faixa VARCHAR(2) NOT NULL,
    ponto_forte VARCHAR(255) NOT NULL,
    ponto_atencao VARCHAR(255) NOT NULL,
    origem_dado VARCHAR(20) NOT NULL,
    fonte_oficial TEXT NULL,
    aviso VARCHAR(100) NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_resultados_oferta_ano (oferta_id, ano),
    CONSTRAINT fk_resultados_oferta FOREIGN KEY (oferta_id) REFERENCES ofertas (id),
    CONSTRAINT chk_resultados_participantes CHECK (participantes <= inscritos),
    CONSTRAINT chk_resultados_fg CHECK (nota_formacao_geral BETWEEN 0 AND 100),
    CONSTRAINT chk_resultados_ce CHECK (nota_componente_especifico BETWEEN 0 AND 100),
    CONSTRAINT chk_resultados_continuo CHECK (conceito_continuo BETWEEN 0 AND 5),
    CONSTRAINT chk_resultados_faixa CHECK (conceito_faixa IN ('1', '2', '3', '4', '5', 'SC')),
    CONSTRAINT chk_resultados_origem CHECK (origem_dado IN ('OFICIAL_INEP', 'SIMULADO_DIDATICO'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ação de acompanhamento da oferta, com anexo opcional (CRUD e upload: resto do grupo):
CREATE TABLE acoes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    oferta_id VARCHAR(3) NOT NULL,
    titulo VARCHAR(120) NOT NULL,
    descricao TEXT NOT NULL,
    situacao VARCHAR(20) NOT NULL,
    responsavel VARCHAR(100) NOT NULL,
    prazo DATE NOT NULL,
    anexo_nome_original VARCHAR(255) NULL,
    anexo_arquivo VARCHAR(255) NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_acoes_oferta (oferta_id),
    CONSTRAINT fk_acoes_oferta FOREIGN KEY (oferta_id) REFERENCES ofertas (id),
    CONSTRAINT chk_acoes_situacao CHECK (situacao IN ('Planejada', 'Em andamento', 'Concluída'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

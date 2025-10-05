DROP TABLE alunos;
DROP TABLE turmas;
DROP TABLE professores;
DROP TABLE salas;
DROP DATABASE exercicio_escola;

CREATE DATABASE exercicio_escola;
USE exercicio_escola;

CREATE TABLE alunos (
	id 					INT PRIMARY KEY AUTO_INCREMENT,
    nome 				VARCHAR(100) NOT NULL,
    data_nascimento 	DATE NULL,
    email				VARCHAR(100) UNIQUE
) ENGINE=InnoDB;

SHOW TABLES;
DESCRIBE alunos;

CREATE TABLE professores (
	id					INT PRIMARY KEY AUTO_INCREMENT,
    nome				VARCHAR(100) NOT NULL UNIQUE,
    disciplina			VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE turmas (
	id					INT PRIMARY KEY AUTO_INCREMENT,
    nome				VARCHAR(100),
    id_professor		INT,
    
    CONSTRAINT fk_professor
		FOREIGN KEY (id_professor)
        REFERENCES professores (id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ALTER TABLE professores
-- ADD CONSTRAINT uq_professores_nome UNIQUE(nome);

CREATE TABLE salas (
	numero 				INT NOT NULL,
    capacidade			INT NOT NULL CHECK (capacidade BETWEEN 5 AND 40),
    andar				TINYINT CHECK (andar BETWEEN 0 AND 4),
    tipo				ENUM("Teórica", "Prática", "Mista"),
    
    PRIMARY KEY (numero)
) ENGINE=InnoDB;

INSERT INTO professores (nome, disciplina) VALUES
  ('Ana Martins', 'Matemática'),
  ('Bruno Silva',  'Física'),
  ('Carla Sousa',  'Química'),
  ('Diogo Ramos',  'Biologia');
  
INSERT INTO alunos (nome, data_nascimento, email) VALUES
  ('João Pinto',   '2006-03-12', 'joao.pinto@example.com'),
  ('Maria Lopes',  '2005-11-02', 'maria.lopes@example.com'),
  ('Rui Gomes',    NULL,         'rui.gomes@example.com'),
  ('Sara Faria',   '2006-07-25', 'sara.faria@example.com');
  
-- INSERT INTO alunos (nome, data_nascimento, email) VALUES ('Zacarias Jacare', '2007-01-01', 'joao.pinto@example.com');

INSERT INTO salas (numero, capacidade, andar, tipo) VALUES
  (101, 30, 0, 'Teórica'),
  (102, 20, 1, 'Prática'),
  (201, 40, 2, 'Mista'),
  (305, 10, 3, 'Teórica'),
  (401, 25, 4, 'Prática');
  
-- INSERT INTO salas (numero, capacidade, andar, tipo) VALUES (500, 3, 0, 'Teórica'); -- capacidade < 5
-- INSERT INTO salas (numero, capacidade, andar, tipo) VALUES (500, 25, 5, 'Teórica'); -- andar > 4
-- INSERT INTO salas (numero, capacidade, andar, tipo) VALUES (402, 20, 4, 'Laboratorio'); -- valor fora do enum

INSERT INTO turmas (nome, id_professor) VALUES
  ('10ºA', (SELECT id FROM professores WHERE nome = 'Ana Martins')),
  ('10ºB', (SELECT id FROM professores WHERE nome = 'Bruno Silva')),
  ('11ºC', (SELECT id FROM professores WHERE nome = 'Carla Sousa')),
  ('12ºD', (SELECT id FROM professores WHERE nome = 'Diogo Ramos'));
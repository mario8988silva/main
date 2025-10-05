CREATE DATABASE IF NOT EXISTS cinema;

CREATE TABLE IF NOT EXISTS cinema.realizadores (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome            VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cinema.filmes (
    id              INT UNSIGNED AUTO_INCREMENT,
    titulo          VARCHAR(255) NOT NULL,
    ano             YEAR NULL,
    id_realizador   INT UNSIGNED,

    PRIMARY KEY(id),

    FOREIGN KEY (id_realizador)
    REFERENCES cinema.realizadores (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

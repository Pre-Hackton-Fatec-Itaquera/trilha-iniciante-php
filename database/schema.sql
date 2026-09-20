CREATE DATABASE IF NOT EXISTS professor_mensuring
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE professor_mensuring;
SET NAMES utf8mb4;   

CREATE TABLE professores(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL
);

CREATE TABLE materias(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    semestre INT NOT NULL
);

CREATE TABLE professor_materia(
    professorId INT NOT NULL,
    materiaId INT NOT NULL,
    PRIMARY KEY (professorId, materiaId),

    FOREIGN KEY (professorId) 
        REFERENCES professores(id)
        ON DELETE CASCADE,

    FOREIGN KEY (materiaId)
        REFERENCES materias(id)
        ON DELETE CASCADE
);

CREATE TABLE avaliacoes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nota INT NOT NULL,
    comentario VARCHAR(256),
    criadoEm DATETIME DEFAULT CURRENT_TIMESTAMP,
    professorId INT NOT NULL,
    materiaId INT NOT NULL,
    
    FOREIGN KEY (professorId, materiaId) 
        REFERENCES professor_materia(professorId, materiaId)
        ON DELETE CASCADE,

    CHECK(nota BETWEEN 1 and 5)
);

INSERT INTO professores (nome) VALUES 
("José"),
("Ana"),
("Gustavo");

INSERT INTO materias (nome, semestre) VALUES
("BD", 2),
("DS", 1);

INSERT INTO professor_materia (professorId, materiaId) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);

INSERT INTO avaliacoes (nota, comentario, professorId, materiaId) VALUES
(5, "Didatica muito boa", 2, 2)
CREATE DATABASE IF NOT EXISTS escuela CHARACTER SET utf8mb4;
USE escuela;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email_verificado BOOLEAN DEFAULT FALSE,
    token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS materias (
    id VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

INSERT INTO materias (id, nombre) VALUES
('MAT101', 'Matemáticas'),
('FIS101', 'Física'),
('QUI101', 'Química'),
('BIO101', 'Biología'),
('HIS101', 'Historia'),
('GEO101', 'Geografía'),
('LIT101', 'Literatura'),
('ART101', 'Arte'),
('MUS101', 'Música'),
('EDU101', 'Educación Física'),
('PROG001', 'Programación')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre);

CREATE TABLE IF NOT EXISTS calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    materia_id VARCHAR(20) NOT NULL,
    calificacion DECIMAL(5, 2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (materia_id) REFERENCES materias(id) ON DELETE CASCADE
);
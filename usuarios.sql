DROP DATABASE IF EXISTS usuarios;

CREATE DATABASE usuarios CHARACTER SET utf8 COLLATE utf8_general_ci;

USE usuarios;

CREATE TABLE denuncia (
    denuncia_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    denuncia_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    denuncia_email VARCHAR(255) NOT NULL,
    denuncia_senha VARCHAR(255) NOT NULL,
    denuncia_cidade VARCHAR(255) NOT NULL,
    denuncia_comentarios VARCHAR(1000) NOT NULL
);

INSERT INTO denuncia (
denuncia_email,
denuncia_senha,
denuncia_cidade,
denuncia_comentarios
) VALUES (
    "wet@gmail.com",
    "123456789@",
    "Rio",
    "oioioioi"
);

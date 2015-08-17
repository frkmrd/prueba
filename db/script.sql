CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE autor(
	id_autor INT PRIMARY KEY AUTO_INCREMENT
	,nombre VARCHAR(30) NOT NULL
	,ap_paterno VARCHAR(30) NOT NULL
	,ci INT NOT NULL UNIQUE
);

CREATE TABLE genero(
	id_genero INT PRIMARY KEY AUTO_INCREMENT
	,nombre VARCHAR(50) NOT NULL UNIQUE
);
CREATE TABLE lector(
	id_lector INT PRIMARY KEY AUTO_INCREMENT
	,nombre VARCHAR(30) NOT NULL
	,ap_paterno VARCHAR(30) NOT NULL
	,ci INT NOT NULL UNIQUE
);

CREATE TABLE libro(
	id_libro INT PRIMARY KEY AUTO_INCREMENT
	,titulo VARCHAR(30) NOT NULL
	,id_autor INT
	,id_genero INT
	,isbn INT NOT NULL UNIQUE
	,n_paginas INT NOT NULL
	,estado VARCHAR(30) NOT NULL
	,id_lector INT
);

ALTER TABLE libro
ADD CONSTRAINT chk_n_paginas CHECK (n_paginas>0);

ALTER TABLE libro
ADD FOREIGN KEY (id_autor)
REFERENCES autor(id_autor);

ALTER TABLE libro
ADD FOREIGN KEY (id_genero)
REFERENCES genero(id_genero);

ALTER TABLE libro
ADD FOREIGN KEY (id_lector)
REFERENCES lector(id_lector);

CREATE TABLE prestamo(
	id_prestamo INT PRIMARY KEY AUTO_INCREMENT
	,id_libro INT
	,id_lector INT
	,fecha DATETIME
);
ALTER TABLE prestamo
ADD FOREIGN KEY (id_lector)
REFERENCES lector(id_lector);

ALTER TABLE prestamo
ADD FOREIGN KEY (id_libro)
REFERENCES libro(id_libro);

CREATE TABLE devolucion(
	id_devolucion INT PRIMARY KEY AUTO_INCREMENT
	,id_libro INT
	,id_lector INT
	,fecha DATETIME
);
ALTER TABLE devolucion
ADD FOREIGN KEY (id_lector)
REFERENCES lector(id_lector);

ALTER TABLE devolucion
ADD FOREIGN KEY (id_libro)
REFERENCES libro(id_libro);

CREATE TABLE bitacora(
	id_bitacora INT PRIMARY KEY AUTO_INCREMENT
	,id_libro INT
	,id_lector INT
	,fecha DATETIME
	,accion VARCHAR(20)

);

DELIMITER //
CREATE TRIGGER nueva_prestamo AFTER INSERT ON prestamo
    FOR EACH ROW
    BEGIN
        INSERT INTO bitacora
        (id_libro,id_lector,fecha,accion)
        VALUES
        (NEW.id_libro,New.id_lector,NEW.fecha,'Prestamo');
    END
//
DELIMITER ;


DELIMITER //
CREATE TRIGGER nueva_devolucion AFTER INSERT ON devolucion
    FOR EACH ROW
    BEGIN
        INSERT INTO bitacora
        (id_libro,id_lector,fecha,accion)
        VALUES
        (NEW.id_libro,New.id_lector,NEW.fecha,'Devolucion');
    END
//
DELIMITER ;

CREATE USER UsuarioBiblio
	IDENTIFIED BY 'infocal';
	
GRANT UPDATE,INSERT,SELECT ON biblioteca.* 
         TO 'UsuarioBiblio'@'localhost';

SELECT p.id_prestamo,l.titulo,le.nombre,p.fecha FROM prestamo p
INNER JOIN libro l ON p.id_libro=l.id_libro
INNER JOIN lector le ON p.id_lector=le.id_lector;



SELECT id_genero, nombre FROM genero;

SELECT id_lector, CONCAT( nombre,' ',  ap_paterno) AS nombre FROM lector;

SELECT id_libro, titulo FROM libro;


SELECT p.id_prestamo id,l.titulo titulo,le.nombre nombre,p.fecha fecha FROM prestamo p
					INNER JOIN libro l ON p.id_libro=l.id_libro
					INNER JOIN lector le ON p.id_lector=le.id_lector;





























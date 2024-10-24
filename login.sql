

CREATE TABLE usuario (
    idusuario bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usnombre varchar(50),
    uspass int(11),
    usmail varchar(50),
    usdeshabilitado timestamp
)

CREATE TABLE rol (
    idrol bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roldescripcion varchar(50)
)

CREATE TABLE usuariorol (
    idusuario bigint(20),
    idrol bigint(20) 
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)ON UPDATE cascade ON DELETE RESTRICT
    FOREIGN KEY (idrol) REFERENCES rol(idrol)ON UPDATE cascade ON DELETE RESTRICT
    PRIMARY KEY (idusuario, idrol)
)

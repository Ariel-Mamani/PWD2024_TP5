
-- ¿vamos a usar otra base de datos?
CREATE DATABASE bdcarritocompras;

USE bdcarritocompras;

-- Tabla Menu
CREATE TABLE menu (
    idmenu BIGINT(20) NOT NULL,
    menombre VARCHAR(50) NOT NULL,
    medescripcion VARCHAR(124),
    idpadre BIGINT(20),
    medeshabilitado TIMESTAMP,
    PRIMARY KEY (idmenu)
);

-- Tabla Rol
CREATE TABLE rol (
    idrol BIGINT(20) NOT NULL,
    rodescripcion VARCHAR(50),
    PRIMARY KEY (idrol)
);

-- Tabla Menu Rol
CREATE TABLE menurol (
    idmenu BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idmenu, idrol),
    FOREIGN KEY (idmenu) REFERENCES menu(idmenu),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
);

-- Tabla Usuario

CREATE TABLE usuario (
    idusuario BIGINT(20) NOT NULL,
    usnombre VARCHAR(50),
    uspass INT(11),
    usmail VARCHAR(50),
    usdeshabilitado TIMESTAMP,
    PRIMARY KEY (idusuario)
);

-- Tabla Usuario Rol
CREATE TABLE usuariorol (
    idusuario BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idusuario, idrol),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
);

-- Tabla Compra
CREATE TABLE compra (
    idcompra BIGINT(20) NOT NULL,
    cofecha TIMESTAMP,
    idusuario BIGINT(20),
    PRIMARY KEY (idcompra),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
);

-- Tabla Producto
CREATE TABLE producto (
    idproducto BIGINT(20) NOT NULL,
    pronombre INT(11),
    prodetalle VARCHAR(512),
    procantstock INT(11),
    PRIMARY KEY (idproducto)
);

-- Tabla Compra Item
CREATE TABLE compraitem (
    idcompraitem BIGINT(20) UNSIGNED NOT NULL,
    idproducto BIGINT(20),
    idcompra BIGINT(20),
    cicantidad INT(11),
    PRIMARY KEY (idcompraitem),
    FOREIGN KEY (idproducto) REFERENCES producto(idproducto),
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra)
);

-- Tabla Estado Tipo
CREATE TABLE compraestadotipo (
    idcompraestadotipo INT(11) NOT NULL,
    cetdescripcion VARCHAR(50),
    cetdetalle VARCHAR(256),
    PRIMARY KEY (idcompraestadotipo)
);

-- Tabla Compra Estado
CREATE TABLE compraestado (
    idcompraestado BIGINT(20) UNSIGNED NOT NULL,
    idcompra BIGINT(20),
    idcompraestadotipo INT(11),
    cefechainit TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cefechafin TIMESTAMP NULL,
    PRIMARY KEY (idcompraestado),
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra),
    FOREIGN KEY (idcompraestadotipo) REFERENCES compraestadotipo(idcompraestadotipo)
);
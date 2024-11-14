
-- ¿vamos a usar otra base de datos?
CREATE DATABASE bdcarritocompras;

USE bdcarritocompras;

-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------
-- Tabla Menu
CREATE TABLE menu (
    idmenu BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    menombre VARCHAR(50) NOT NULL,
    medescripcion VARCHAR(124),
    idpadre BIGINT(20),
    medeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------

-- Tabla Rol
CREATE TABLE rol (
    idrol BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rodescripcion VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------

-- Tabla Menu Rol
CREATE TABLE menurol (
    idmenu BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idmenu, idrol),
    FOREIGN KEY (idmenu) REFERENCES menu(idmenu),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------

-- Tabla Usuario

CREATE TABLE usuario (
    idusuario BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usnombre VARCHAR(50),
    uspass VARCHAR(50),
    usmail VARCHAR(50),
    usdeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------
-- Tabla Usuario Rol
CREATE TABLE usuariorol (
    idusuario BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idusuario, idrol),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- ------------------
-- --------------------------------------------------------

-- Tabla Compra
CREATE TABLE compra (
    idcompra BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cofecha TIMESTAMP,
    idusuario BIGINT(20),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Tabla Producto
CREATE TABLE producto (
    idproducto BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pronombre VARCHAR(50),
    prodetalle VARCHAR(512),
    proprecio INT(9),
    procantstock INT(11),
    proimagen VARCHAR(50),
    usdeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Tabla Compra Item
CREATE TABLE compraitem (
    idcompraitem BIGINT(20) UNSIGNED  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idproducto BIGINT(20),
    idcompra BIGINT(20),
    cicantidad INT(11),
    FOREIGN KEY (idproducto) REFERENCES producto(idproducto),
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Tabla Estado Tipo
CREATE TABLE compraestadotipo (
    idcompraestadotipo INT(11)  NOT NULL PRIMARY KEY,
    cetdescripcion VARCHAR(50),
    cetdetalle VARCHAR(256)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Tabla Compra Estado
CREATE TABLE compraestado (
    idcompraestado BIGINT(20) UNSIGNED  NOT NULL PRIMARY KEY,
    idcompra BIGINT(20),
    idcompraestadotipo INT(11),
    cefechainit TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cefechafin TIMESTAMP NULL,
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra),
    FOREIGN KEY (idcompraestadotipo) REFERENCES compraestadotipo(idcompraestadotipo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla menu
--
INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES
    (1, 'Productos', 'Paginas/02_productos.php', null, null),
    (2, null, 'Login/paginaSegura.php', null, null),
    (3, null, 'Login/paginaSegura.php', null, null);
--
-- Volcado de datos para la tabla rol
--
INSERT INTO rol (idrol, rodescripcion) VALUES 
    (1, 'superadmin'),
    (2, 'admin'),
    (3, 'deposito'),
    (4, 'cliente');
    
--
-- Volcado de datos para la tabla menurol
--
INSERT INTO menurol (idmenu, idrol) VALUES 
    (1, 1),
    (2, 1),
    (3, 1),
    (1, 2),
    (2, 2),
    (3, 2),
    (1, 3),
    (2, 3),
    (3, 3),
    (1, 4),
    (2, 4),
    (3, 4);  

--
-- Volcado de datos para la tabla usuario
-- 
INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES
    (1, 'Jose', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', null);

--
-- Volcado de datos para la tabla usuario
-- 
INSERT INTO usuariorol (idusuario, idrol) VALUES
    (1, 1);

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');
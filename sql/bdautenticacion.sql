-- --------------------------------------------------------
--
-- Base de datos: `bdautenticacion`
--
CREATE DATABASE bdautenticacion;
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuario`
--
CREATE TABLE usuario (
    idusuario bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usnombre varchar(50),
    uspass varchar(50),
    usmail varchar(50),
    usdeshabilitado timestamp
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario (idusuario, usnombre, uspass, usmail) VALUES 
    (1, 'Jose', '', 'jose@jose.com', null),
    (2, 'Mari', '', 'mari@jose.com', null),
    (3, 'Ana', '', 'ana@jose.com', null),
    (4, 'Juana', '', 'juana@jose.com', null);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `rol`
--
CREATE TABLE rol (
    idrol bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roldescripcion varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO rol (idrol, roldescripcion) VALUES 
    (1, 'admin'),
    (2, 'user1'),
    (3, 'user2'),
    (4, 'user3');
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuariorol`
--
CREATE TABLE usuariorol (
    idusuario bigint(20),
    idrol bigint(20), 
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)ON UPDATE cascade ON DELETE RESTRICT,
    FOREIGN KEY (idrol) REFERENCES rol(idrol)ON UPDATE cascade ON DELETE RESTRICT,
    PRIMARY KEY (idusuario, idrol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuariorol (idusuario, idrol) VALUES 
    (1, 1),
    (2, 2),
    (3, 2),
    (3, 4),
    (4, 3);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `menu`
--
CREATE TABLE menu (
    idmenu bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    menunombre varchar(50),
    menuurl varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO menu (idmenu, menunombre, menuurl) VALUES 
    (1, 'Lista Usuarios', '../Usuarios/index.php'),
    (2, 'Lista Roles', '../Rol/index.php'),
    (3, 'Lista Usuarios', '../Usuarios/index.php');
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `menurol`
--
CREATE TABLE menurol (
    idmenu bigint(20),
    idrol bigint(20), 
    FOREIGN KEY (idmenu) REFERENCES menu(idmenu)ON UPDATE cascade ON DELETE RESTRICT,
    FOREIGN KEY (idrol) REFERENCES rol(idrol)ON UPDATE cascade ON DELETE RESTRICT,
    PRIMARY KEY (idmenu, idrol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO menurol (idmenu, idrol) VALUES 
    (1, 1),
    (2, 1),
    (3, 1),
    (1, 2),
    (1, 3);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Volcado de tabla para la tabla 
--
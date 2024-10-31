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

INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES 
    (1, 'Jose', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', 'null'),
    (2, 'Mari', 'e10adc3949ba59abbe56e057f20f883e', 'mari@jose.com', 'null'),
    (3, 'Ana', 'e10adc3949ba59abbe56e057f20f883e', 'ana@jose.com', 'null'),
    (4, 'Juana', 'e10adc3949ba59abbe56e057f20f883e', 'juana@jose.com', 'null');
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
    (2, 'cuchillo'),
    (3, 'tenedor'),
    (4, 'cuchara');
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
    (1, 'Lista Usuarios', 'Usuarios/index.php'),
    (2, 'Lista Roles', 'Rol/index.php'),
    (3, 'Lista Menu', 'Menu/index.php');
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
    (1, 2),
    (1, 3),
    (2, 4);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Volcado de tabla para la tabla 
--
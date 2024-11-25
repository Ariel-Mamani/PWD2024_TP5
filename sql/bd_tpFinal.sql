CREATE DATABASE bdcarritocompras;

USE bdcarritocompras;


CREATE TABLE menu (
    idmenu BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    menombre VARCHAR(50) NOT NULL,
    medescripcion VARCHAR(124),
    idpadre BIGINT(20),
    medeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE rol (
    idrol BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rodescripcion VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE menurol (
    idmenu BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idmenu, idrol),
    FOREIGN KEY (idmenu) REFERENCES menu(idmenu),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE usuario (
    idusuario BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usnombre VARCHAR(50),
    uspass VARCHAR(50),
    usmail VARCHAR(50),
    usdeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE usuariorol (
    idusuario BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idusuario, idrol),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE compra (
    idcompra BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cofecha TIMESTAMP,
    idusuario BIGINT(20),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE producto (
    idproducto BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pronombre VARCHAR(50),
    prodetalle VARCHAR(512),
    proprecio INT(9),
    procantstock INT(11),
    proimagen VARCHAR(50),
    prodeshabilitado TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE compraitem (
    idcompraitem BIGINT(20) UNSIGNED  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idproducto BIGINT(20),
    idcompra BIGINT(20),
    cicantidad INT(11),
    FOREIGN KEY (idproducto) REFERENCES producto(idproducto),
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE compraestadotipo (
    idcompraestadotipo INT(11)  NOT NULL PRIMARY KEY,
    cetdescripcion VARCHAR(50),
    cetdetalle VARCHAR(256)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE compraestado (
    idcompraestado BIGINT(20) UNSIGNED  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idcompra BIGINT(20),
    idcompraestadotipo INT(11),
    cefechainit TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cefechafin TIMESTAMP NULL,
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra),
    FOREIGN KEY (idcompraestadotipo) REFERENCES compraestadotipo(idcompraestadotipo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELETE FROM menu;
INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES  
    (10, 'Usuarios', '', null, null),
    (20, 'Productos', '', null, null),
    (30, 'Compras', '', null, null),
    (40, 'Graficos', '', null, null),
    (50, 'Ventas', '', null, null),
    (60, 'Nosotros', '', null, null),
        
    (21, 'Productos', 'Producto/Productos_lista.php', 20, null),
    (22, '', 'Producto/ProductoNuevo.php', 20, null),
    (23, '', 'Producto/ProductosAccion.php', 20, null),
    (24, '', 'Producto/accion/eliminar_Producto.php', 20, null),
    (25, '', 'Producto/accion/listar_Productos.php', 20, null),
    
    (31, 'Compras', 'Compras/compras_ingresadas.php', 30, null),
    (32, 'Compras', 'Compras/compras_i.php', 30, null),

    (41, 'Graficos', 'Graficos/mostrar_grafico.php', 40, null),
    (42, '', 'Graficos/productos_vendidos_graf_de_barras.php', 40, null),
    (43, '', 'Graficos/grafico.png', 40, null),
    
    (51, 'Insumos', 'Paginas/02_productos.php', 50, null),
    (62, 'Informacion Util', 'Paginas/informacion_util.php', 60, null),
    (63, 'Sobre Nosotros', 'Paginas/sobre_nosotros.php', 60, null),
    (64, 'Fotos', 'Paginas/fotos.php', 60, null),
    (65, 'Contacto', 'Paginas/contacto.php', 60, null),

    (71, '', 'Carrito/carrito.php', 30, null),
    (72, '', 'Carrito/accion/eliminarCarrito.php', 30, null),
    (73, '', 'Carrito/accion/decrementarProducto.php', 30, null),
    (74, '', 'Carrito/accion/incrementarCarrito.php', 30, null),
    (75, '', 'Carrito/carrito_list.php', 30, null),
    (76, '', 'Carrito/accion/eliminarProducto.php', 30, null),
    (77, '', 'Carrito/accion/agregarCarrito.php', 30, null),
    (78, '', 'Carrito/accion/finalizarCarrito.php', 30, null),
    (79, '', 'Carrito/pago.php', 30, null),
    (80, '', 'Login/procesar_registro.php', 30, null),
    (81, '', 'Login/registro.php', 30, null),
    (82, '', 'Login/verificarLogin.php', 30, null),
    (83, '', 'Login/paginaSegura.php', 30, null),
    (100, '', 'Login/paginaNo.php', 30, null);


INSERT INTO rol (idrol, rodescripcion) VALUES 
    (1, 'superadmin'),
    (2, 'admin'),
    (3, 'deposito'),
    (4, 'cliente');


DELETE FROM menurol;
INSERT INTO menurol (idmenu, idrol) VALUES 
    (10, 1), (20, 1), (30, 1), (40, 1), (50, 1), 
    (21, 1), (22, 1), (23, 1), (24, 1), (25, 1), (31, 1), (32, 1), (41, 1), (42, 1), (43, 1), (51, 1),
    (71, 1), (72, 1), (73, 1), (74, 1), (75, 1), (76, 1), (77, 1), (78, 1),    
    (100, 1), (100, 2), (100, 3), (100, 4),
    (20, 2), (30, 2), (40, 2), (21, 2), (22, 2), (23, 2), (24, 2), (25, 2), (31, 2), (32, 2), (41, 2), (42, 2), (43, 2), 
    (20, 3), (30, 3), (21, 3), (22, 3), (23, 3), (24, 3), (25, 3), (31, 3), (32, 3), 
    (50, 4), (51, 4), (62, 4), (63, 4), (64, 4), (65, 4), (71, 4), (72, 4), (73, 4), (74, 4), (75, 4), (76, 4), (77, 4), (78, 4), (79, 4),
    (80, 1), (80, 2), (80, 3), (80, 4), (81, 1), (81, 2), (81, 3), (81, 4), (82, 1), (82, 2), (82, 3), (82, 4), (83, 1), (83, 2), (83, 3), (83, 4);    


INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES
    (1, 'superadmin', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', null),
    (2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', null),
    (3, 'depo', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', null),
    (4, 'cliente', 'e10adc3949ba59abbe56e057f20f883e', 'jose@jose.com', null);


INSERT INTO usuariorol (idusuario, idrol) VALUES
    (1, 1), (3, 3), (2, 2), (4, 4);


INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'ingresada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'cancelada', 'el cliente puede cancelar su compra en curso o un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado = 1 '),
(4, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado = 2 '),
(5, 'recibida', 'cuando el usuario administrador confirma la llegada a destino de una compra en estado = 4 ');


INSERT INTO producto (idproducto, pronombre, prodetalle, proprecio, procantstock, proimagen, prodeshabilitado) VALUES 
    (1, 'Acondicionador Garnier', 'Higiene personal', 2000, 20, 'acondicionador', NULL),
    (2, 'Shampoo Garnier', 'Higiene personal', 3000, 50, 'shampoo', NULL),
    (3, 'Tijera', 'Aseo', 4000, 10, 'tijera', NULL),
    (4, 'Cera Barba', 'Higiene personal', 2500, 15, 'cera', NULL);
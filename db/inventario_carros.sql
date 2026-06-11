-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2026 a las 01:00:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_carros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carros`
--

CREATE TABLE `carros` (
  `idcarro` int(11) NOT NULL,
  `vin` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `kilometraje` int(11) DEFAULT 0,
  `tipocombustible` enum('Gasolina','Diesel','Hibrido','Electrico','GLP','Gas Natural') DEFAULT NULL,
  `transmision` enum('Manual','Automatica','CVT','Semiautomatica') DEFAULT NULL,
  `tipocarroceria` enum('Sedan','Hatchback','SUV','Pickup','Coupe','Convertible','Van','Otro') DEFAULT NULL,
  `preciocompra` decimal(10,2) DEFAULT NULL,
  `precioventa` decimal(10,2) DEFAULT NULL,
  `gastosextra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fechaingreso` date DEFAULT NULL,
  `estado` enum('Disponible','Reservado','Vendido','Mantenimiento') DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carros`
--

INSERT INTO `carros` (`idcarro`, `vin`, `marca`, `modelo`, `anio`, `color`, `placa`, `kilometraje`, `tipocombustible`, `transmision`, `tipocarroceria`, `preciocompra`, `precioventa`, `gastosextra`, `fechaingreso`, `estado`, `observaciones`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, '1234214', 'Toyota', 'Corolla', 2011, 'rojo', 'HAZ2021', 12000, 'Diesel', 'Manual', 'Hatchback', 100000.00, 200000.00, 0.00, '2026-06-01', 'Disponible', 'No tiene defectos', '2026-06-07 21:37:24', '2026-06-11 22:31:34'),
(2, '3214214214', 'jsdflksajfd', 'jslkdfjs', 2000, 'jsadfljsalkfd', 'jsalkjsadlkf', 200, '', '', NULL, 299.00, 3000.00, 0.00, '2026-06-01', 'Vendido', 'sadff', '2026-06-07 21:37:24', '2026-06-07 21:37:24'),
(3, '939452345', 'jsaflkjsaf', 'sajdflkjsaf', 1999, 'ajslkfjsaf', 'ajsdkfajsdf', 9959325, 'Gasolina', 'Automatica', 'Sedan', 2999.00, 4000.00, 0.00, '2000-12-12', 'Disponible', '', '2026-06-08 15:09:13', '2026-06-08 15:09:13'),
(4, '93945124', 'jsaflkjsaf', 'sajdflkjsaf', 1999, 'ajslkfjsaf', 'ajsdkfajsdf', 9959325, 'Gasolina', 'Automatica', 'Sedan', 2999.00, 4000.00, 0.00, '2000-12-12', 'Mantenimiento', 'jsalkfjsflkjsafd', '2026-06-08 15:09:43', '2026-06-11 21:51:38'),
(5, '124921943212', 'jsalkfjsaf', 'jdsalkf', 2000, 'jaslkfjsa', 'jsaflsajf', 2000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 2000.00, 0.00, '2000-12-12', 'Disponible', 'sajdflksjf', '2026-06-08 15:28:56', '2026-06-08 15:28:56'),
(7, '124921943212123', 'jsalkfjsaf', 'jdsalkf', 2000, 'jaslkfjsa', 'jsaflsajf', 2000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 2000.00, 0.00, '2000-12-12', 'Disponible', '', '2026-06-08 15:29:44', '2026-06-08 15:29:44'),
(9, '1249219432', 'jsalkfjsaf', 'jdsalkf', 2000, 'jaslkfjsa', 'jsaflsajf', 2000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 2000.00, 0.00, '2000-12-12', 'Disponible', '', '2026-06-08 15:30:22', '2026-06-08 15:30:22'),
(10, '124921943', 'jflksaf', 'jsadlkfjsafda', 2000, 'jsalkfjsf', 'jaslkfdj', 2000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 2000.00, 0.00, '2000-12-12', 'Disponible', 'jcalksdfjaf', '2026-06-11 15:00:29', '2026-06-11 15:00:29'),
(11, '1000', 'jsadlkfjsa', 'jdsalkfjsadf', 1000, 'dsjflkdsj', 'jaslkdfjfds', 1000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 1550.00, 0.00, '1000-12-12', 'Disponible', 'samdsjflk', '2026-06-11 15:09:17', '2026-06-11 15:09:17'),
(12, '10000', 'jsadlkfjsa', 'jdsalkfjsadf', 1000, 'dsjflkdsj', 'jaslkdfjfds', 1000, 'Gasolina', 'Automatica', 'Sedan', 1000.00, 1550.00, 0.00, '1000-12-12', 'Disponible', '', '2026-06-11 15:16:49', '2026-06-11 21:51:45'),
(14, '124921943290', 'Hyundai', 'Elantra', 2014, 'Gris', 'ZSA2021', 1000, 'Hibrido', 'CVT', 'Sedan', 120000.00, 250000.00, 200.00, '2022-02-03', 'Mantenimiento', '', '2026-06-11 21:37:06', '2026-06-11 21:52:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `tipocliente` enum('Natural','Juridica') NOT NULL,
  `rtn` varchar(14) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `correoelectronico` varchar(150) DEFAULT NULL,
  `direccion` text NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `tipocliente`, `rtn`, `nombre`, `telefono`, `correoelectronico`, `direccion`, `fecharegistro`, `estado`) VALUES
(1, 'Natural', '01012006040529', 'Ismael Mauricio Castillo Castro', '99758196', 'imcastillocastro@gmail.com', 'Col Raul Pineda', '2026-06-08 17:43:01', 'Activo'),
(2, 'Juridica', '2021145323451', 'LARECOTURH', '99554422', 'admin@larecoturh.org', 'Col Buenos Aire', '2026-06-11 21:40:14', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `rtn` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `sitio_web` varchar(150) DEFAULT NULL,
  `logotipo` varchar(255) DEFAULT NULL,
  `estado` enum('Activa','Inactiva') DEFAULT 'Activa',
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre`, `razon_social`, `rtn`, `direccion`, `telefono`, `correo`, `sitio_web`, `logotipo`, `estado`, `fecha_registro`, `fecha_actualizacion`) VALUES
(1, 'LARECOTURH', 'LAPROCOTURH', '0101200504032', 'Col X', '99776655', 'imcast@gmail.com', 'youtube.com', '1780763858.png', 'Inactiva', '2026-06-05 06:00:00', '2026-06-06 06:00:00'),
(2, 'CEUTEC', 'Centro Universitario Tecnologico', '164332421419', 'Col Mall1', '998899001', 'ceutec@gmail.com1', 'ceutec.com', '1780763847.png', 'Activa', '2026-06-05 06:00:00', '2026-06-06 06:00:00'),
(3, 'Comida', 'Comida R de LC', '010122352', 'dsajflkdsajf', '34534532', 'sajdlksaf@gmail.com', 'jsflksfs.com', '1780779032.jpg', 'Activa', '2026-06-05 06:00:00', '2026-06-06 06:00:00'),
(4, 'Nueva', 'Nueva', '32942143', 'Col Fz', '99004422', 'jfsakf@gmail.com', 'jdflkasfd.com', '1780779022.png', 'Inactiva', '2026-06-05 06:00:00', '2026-06-06 06:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idfactura` int(11) NOT NULL,
  `numerofactura` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `impuestoporcentaje` enum('0%','15%','18%') DEFAULT NULL,
  `impuestos` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `metodopago` enum('Efectivo','Tarjeta','Transferencia') NOT NULL,
  `estado` enum('Pendiente','Pagada','Anulada') DEFAULT 'Pendiente',
  `idcarro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idfactura`, `numerofactura`, `fecha`, `idcliente`, `idusuario`, `subtotal`, `descuento`, `impuestoporcentaje`, `impuestos`, `total`, `metodopago`, `estado`, `idcarro`) VALUES
(1, 'F-001', '2026-06-09 00:12:55', 1, 4, 200.00, 2.00, '15%', 200.00, 800.00, 'Efectivo', 'Pendiente', 1),
(7, 'F-001', '2026-06-11 00:00:00', 1, 4, 0.00, 0.00, '', 0.00, 0.00, 'Efectivo', 'Pendiente', 2),
(8, 'F-007', '2026-06-11 00:00:00', 1, 4, 0.00, 0.00, '0%', 0.00, 0.00, 'Efectivo', 'Pagada', 9),
(9, 'F-009', '2026-06-11 00:00:00', 1, 4, 200000.00, 0.00, '', 30000.00, 230000.00, 'Efectivo', 'Pendiente', 3),
(10, 'F-0010', '2026-06-11 00:00:00', 1, 4, 200000.00, 0.00, '15%', 30000.00, 230000.00, 'Efectivo', 'Anulada', 1),
(13, 'F-0011', '2026-06-11 00:00:00', 1, 4, 200000.00, 0.00, '15%', 30000.00, 230000.00, 'Efectivo', 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_carro`
--

CREATE TABLE `fotos_carro` (
  `idfoto` int(11) NOT NULL,
  `idcarro` int(11) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos_carro`
--

INSERT INTO `fotos_carro` (`idfoto`, `idcarro`, `ruta`) VALUES
(1, 9, '1780932623_0.png'),
(2, 9, '1780932623_1.png'),
(3, 9, '1780932623_2.png'),
(4, 11, '1781190557_0.png'),
(5, 11, '1781190557_1.png'),
(6, 11, '1781190557_2.png'),
(9, 12, '1781191163_0.png'),
(10, 14, '1781213826_0.png'),
(11, 14, '1781213826_1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'registro_cliente'),
(2, 'editar_cliente'),
(3, 'anular'),
(4, 'control_usuario'),
(5, 'detalle_usuario'),
(6, 'crear_usuario'),
(7, 'editar_usuario'),
(8, 'anular_usuario'),
(9, 'escritorio'),
(10, 'crear_empresa'),
(11, 'editar_empresa'),
(12, 'anular_empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `nombre`) VALUES
(1, 'ver_dashboard'),
(2, 'ver_inventario'),
(3, 'crear_inventario'),
(4, 'editar_inventario'),
(5, 'cambiar_estado_inventario'),
(6, 'ver_fotografias'),
(7, 'ver_clientes'),
(8, 'crear_clientes'),
(9, 'editar_clientes'),
(10, 'cambiar_estado_clientes'),
(11, 'ver_facturas'),
(12, 'crear_facturas'),
(13, 'editar_facturas'),
(14, 'cambiar_estado_facturas'),
(15, 'ver_usuarios'),
(16, 'crear_usuarios'),
(17, 'editar_usuarios'),
(18, 'cambiar_estado_usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `identidad` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `tipo` enum('Empresa','Personal') NOT NULL,
  `estado_civil` enum('Soltero(a)','Casado(a)','Viudo(a)','Otros') DEFAULT NULL,
  `trabaja` enum('Si','No') DEFAULT 'No',
  `empresa` varchar(150) DEFAULT NULL,
  `vehiculo_propio` enum('Si','No') DEFAULT 'No',
  `cargo` varchar(100) DEFAULT NULL,
  `estado_actual` enum('Activo','Bloqueado') DEFAULT 'Activo',
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `identidad`, `nombre`, `apellido`, `telefono`, `correo`, `direccion`, `fecha_inicial`, `fecha_nacimiento`, `tipo`, `estado_civil`, `trabaja`, `empresa`, `vehiculo_propio`, `cargo`, `estado_actual`, `observaciones`, `fecha_registro`) VALUES
(1, '0101200604052', 'Ismael', 'Castillo', '99758196', 'isma@gmail.com', '', '2026-05-01', '2026-05-22', 'Empresa', 'Casado(a)', 'No', 'CEUTEC', 'Si', 'Tutor', 'Bloqueado', 'Nada', '2026-05-28 00:56:46'),
(2, '01012005040432', 'Carlos', 'Antunez', '99778855', 'isma@gmail.com', 'jlkdsjfslkfdj', '2026-05-06', '2026-05-05', 'Personal', 'Viudo(a)', 'Si', 'jlkdjfslkfjds', 'Si', 'lkjslkfsjdaflkj', 'Activo', 'lkjlkjlk', '2026-05-28 01:11:05'),
(3, '01012005040435', 'jflkjsalkfjdsaf', 'sfdsafsaf', '99770022', 'carlos@fda.comasfjlk', 'jlkjlkj', '2026-05-01', '2026-05-03', 'Personal', 'Casado(a)', 'No', 'ljjlkjlk', 'Si', 'jlkjlkj', 'Activo', 'jjj', '2026-05-28 01:11:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `login`, `clave`, `cargo`, `imagen`, `condicion`) VALUES
(1, 'Ismael', 'sdjfskfjasdlk', 'jlkjlkfajsA1f', 'jsfdlkjdsaf', '', 0),
(4, 'hola', 'hola', 'hola', 'Administrador', '1780926751.png', 1),
(5, 'admin', 'admin', 'admin', 'admin', '', 0),
(12, 'TODO1', 'TODO1', 'TODO1...', 'ADMIN1', '1780669900.png', 1),
(13, 'Ismaeljj', 'jose', 'jsdlkfsajflkA1', 'safdsafdsafa', '1780934573.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario`, `idpermiso`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(12, 1),
(12, 2),
(12, 3),
(12, 6),
(12, 7),
(12, 8),
(12, 9),
(13, 1),
(13, 2),
(13, 5),
(13, 9),
(13, 11),
(13, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`idcarro`),
  ADD UNIQUE KEY `vin` (`vin`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `rtn` (`rtn`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `rtn` (`rtn`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `fk_facturas_carro` (`idcarro`);

--
-- Indices de la tabla `fotos_carro`
--
ALTER TABLE `fotos_carro`
  ADD PRIMARY KEY (`idfoto`),
  ADD KEY `carro_id` (`idcarro`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identidad` (`identidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario`,`idpermiso`),
  ADD KEY `fk_permiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carros`
--
ALTER TABLE `carros`
  MODIFY `idcarro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `fotos_carro`
--
ALTER TABLE `fotos_carro`
  MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `fk_facturas_carro` FOREIGN KEY (`idcarro`) REFERENCES `carros` (`idcarro`);

--
-- Filtros para la tabla `fotos_carro`
--
ALTER TABLE `fotos_carro`
  ADD CONSTRAINT `fotos_carro_ibfk_1` FOREIGN KEY (`idcarro`) REFERENCES `carros` (`idcarro`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

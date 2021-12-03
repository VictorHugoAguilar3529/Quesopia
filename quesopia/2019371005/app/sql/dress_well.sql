-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 08-08-2020 a las 05:27:36
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dress_well`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_adm` char(20) NOT NULL,
  `n1_adm` varchar(45) DEFAULT NULL,
  `n2_adm` varchar(15) DEFAULT NULL,
  `ap_adm` varchar(15) DEFAULT NULL,
  `am_adm` varchar(15) DEFAULT NULL,
  `email_adm` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_adm`, `n1_adm`, `n2_adm`, `ap_adm`, `am_adm`, `email_adm`) VALUES
('A_0001', 'Victor', 'Hugo', 'Aguilar', 'Aguila', 'aguilaraguilavictorh@gmail.com'),
('A_0002', 'Wendy', 'Samay', 'Ortiz', 'Gallegos', '2019371045@uteq.edu.mx'),
('A_0003', 'Gerardo', NULL, 'Gallegos', 'Espinoza', 'ghosthpsHprod@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cte` char(20) NOT NULL,
  `n1_cte` varchar(15) DEFAULT NULL,
  `n2_cte` varchar(15) DEFAULT NULL,
  `ap_cte` varchar(15) DEFAULT NULL,
  `am_cte` varchar(15) DEFAULT NULL,
  `tel_cte` double DEFAULT NULL,
  `email_cte` varchar(45) DEFAULT NULL,
  `rfc_cte` char(13) DEFAULT NULL,
  `ne_cte` int(5) DEFAULT NULL,
  `ni_cte` int(5) DEFAULT NULL,
  `cp_cte` int(7) DEFAULT NULL,
  `calle_cte` varchar(45) DEFAULT NULL,
  `id_mpio` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_cte`),
  KEY `id_mpio` (`id_mpio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cte`, `n1_cte`, `n2_cte`, `ap_cte`, `am_cte`, `tel_cte`, `email_cte`, `rfc_cte`, `ne_cte`, `ni_cte`, `cp_cte`, `calle_cte`, `id_mpio`) VALUES
('C_0001', 'Christian', NULL, 'Sandin', 'Rosas', 4421299829, 'Sandin1234@gmail.com', 'CSR155', 216, NULL, 76140, 'nogal', 'Qro_01'),
('C_0002', 'Andrea', NULL, 'Suarez', 'Mendoza', 4423808805, 'Andreaesmala@gmail.com', 'ANSUME0027018', 705, NULL, 76148, 'Parlamento', 'Qro_01'),
('C_0003', 'Brenda', 'Marisol', 'hernandez', 'Juarez', 4421079567, 'Marisol1854@gmail.com', 'BRMAHE44585', 43, NULL, 76148, 'villa señor', 'Qro_01'),
('C_0004', 'Victor', 'Emanuel', 'Arauz', 'Ortiz', 4426569064, 'Ema1854@gmail.com', 'VIEMAROR455', 28, NULL, 76143, 'villas de santiago', 'Qro_01'),
('C_0005', 'Jonathan', NULL, 'Lozada', 'Guerrero', 4424695054, 'Pynky_1854@gmail.com', 'JOLOGU2507', 65, NULL, 76145, 'Don Manuel', 'Qro_01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_venta`
--

DROP TABLE IF EXISTS `det_venta`;
CREATE TABLE IF NOT EXISTS `det_venta` (
  `id_inv` int(11) DEFAULT NULL,
  `id_ven` int(11) DEFAULT NULL,
  `id_pago` int(20) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  KEY `id_inv` (`id_inv`),
  KEY `id_ven` (`id_ven`),
  KEY `id_pago` (`id_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `det_venta`
--

INSERT INTO `det_venta` (`id_inv`, `id_ven`, `id_pago`, `cantidad`) VALUES
(5, 1, 1, 3),
(3, 1, 1, 2),
(15, 2, 2, 3),
(18, 2, 2, 3),
(16, 2, 2, 3),
(11, 2, 2, 1),
(22, 3, 3, 2),
(28, 4, 4, 4),
(26, 4, 4, 3),
(19, 5, 5, 3);

--
-- Disparadores `det_venta`
--
DROP TRIGGER IF EXISTS `monto`;
DELIMITER $$
CREATE TRIGGER `monto` AFTER INSERT ON `det_venta` FOR EACH ROW begin
declare mont float(10,2);
select sum(prec_prod*cantidad) into mont 
from producto, pago, det_venta,inventario,venta,cliente
where inventario.id_inv=det_venta.id_inv 
AND inventario.id_prod=producto.id_prod 
AND venta.id_ven=det_venta.id_ven 
AND venta.id_pago=pago.id_pago 
AND cliente.id_cte=venta.id_cte
AND venta.id_ven=new.id_ven;
update pago SET pago.monto=mont
where pago.id_pago=new.id_pago;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_edo` char(20) NOT NULL,
  `nom_edo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_edo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_edo`, `nom_edo`) VALUES
('es_01', 'Aguascalientes'),
('es_02', 'Baja California'),
('es_03', 'Baja California Sur'),
('es_04', 'Campeche'),
('es_05', 'Coahuila'),
('es_06', 'Colima'),
('es_07', 'Chiapas'),
('es_08', 'Chihuahua'),
('es_09', 'Distrito Federal'),
('es_10', 'Durango'),
('es_11', 'Gunajuato'),
('es_12', 'Guerrero'),
('es_13', 'Hidalgo'),
('es_14', 'Jaliso'),
('es_15', 'México'),
('es_16', 'Michoacan'),
('es_17', 'Morelos'),
('es_18', 'Nayarit'),
('es_19', 'Nuevo Leon'),
('es_20', 'Oaxaca'),
('es_21', 'Publica'),
('es_22', 'Querétaro'),
('es_23', 'Quintana Roo'),
('es_24', 'San Luis Potosí'),
('es_25', 'Sinaloa'),
('es_26', 'Sonora'),
('es_27', 'Tabasco'),
('es_28', 'Tamaulipas'),
('es_29', 'Tlaxcala'),
('es_30', 'Veracruz'),
('es_31', 'Yucatán'),
('es_32', 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `folio_fac` int(11) NOT NULL,
  `fec_fac` date DEFAULT NULL,
  `id_ven` int(11) DEFAULT NULL,
  PRIMARY KEY (`folio_fac`),
  KEY `id_ven` (`id_ven`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`folio_fac`, `fec_fac`, `id_ven`) VALUES
(1, '2020-01-02', 1),
(2, '2020-02-01', 2),
(3, '2020-02-04', 3),
(4, '2020-10-07', 4),
(5, '2020-08-02', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inv` int(11) NOT NULL,
  `id_prod` char(30) DEFAULT NULL,
  `num_prod` int(11) DEFAULT NULL,
  `stock_inv` int(11) DEFAULT NULL,
  `status_inv` int(11) DEFAULT NULL,
  `id_src` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_inv`),
  KEY `id_prod` (`id_prod`,`num_prod`),
  KEY `id_src` (`id_src`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inv`, `id_prod`, `num_prod`, `stock_inv`, `status_inv`, `id_src`) VALUES
(1, 'P_01', 22, 100, 1, 'S_01'),
(2, 'P_02', 25, 265, 1, 'S_01'),
(3, 'P_03', 22, 27, 1, 'S_01'),
(4, 'P_04', 25, 128, 1, 'S_01'),
(5, 'P_05', 26, 152, 1, 'S_01'),
(6, 'P_06', 29, 125, 1, 'S_01'),
(7, 'P_07', 26, 223, 1, 'S_01'),
(8, 'P_08', 23, 498, 1, 'S_01'),
(9, 'P_09', 24, 255, 1, 'S_01'),
(10, 'P_10', 26, 125, 1, 'S_01'),
(11, 'P_01', 22, 128, 1, 'S_02'),
(12, 'P_02', 25, 52, 1, 'S_02'),
(13, 'P_03', 22, 15, 1, 'S_02'),
(14, 'P_04', 25, 152, 1, 'S_02'),
(15, 'P_05', 26, 145, 1, 'S_02'),
(16, 'P_06', 29, 1255, 1, 'S_02'),
(17, 'P_07', 26, 115, 1, 'S_02'),
(18, 'P_08', 23, 5422, 1, 'S_02'),
(19, 'P_09', 24, 452, 1, 'S_02'),
(20, 'P_10', 26, 512, 1, 'S_02'),
(21, 'P_01', 22, 4521, 1, 'S_03'),
(22, 'P_02', 25, 15, 1, 'S_03'),
(23, 'P_03', 22, 144, 1, 'S_03'),
(24, 'P_04', 25, 788, 1, 'S_03'),
(25, 'P_05', 26, 65, 1, 'S_03'),
(26, 'P_06', 29, 155, 1, 'S_03'),
(27, 'P_07', 26, 158, 1, 'S_03'),
(28, 'P_08', 23, 125, 1, 'S_03'),
(29, 'P_09', 24, 1234, 1, 'S_03'),
(30, 'P_10', 26, 122, 1, 'S_03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id_mrc` int(11) NOT NULL,
  `nom_mrc` char(45) DEFAULT NULL,
  PRIMARY KEY (`id_mrc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_mrc`, `nom_mrc`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Vans'),
(4, 'Puma'),
(5, 'Reebook');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

DROP TABLE IF EXISTS `modelo`;
CREATE TABLE IF NOT EXISTS `modelo` (
  `id_mod` int(11) NOT NULL,
  `nom_mod` char(45) DEFAULT NULL,
  `id_mrc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mod`),
  KEY `id_mrc` (`id_mrc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_mod`, `nom_mod`, `id_mrc`) VALUES
(1, 'Air Max 200 Negro Mujer', 1),
(2, 'Grand Court Blanco Hombre', 2),
(3, 'Ward Negro Hombre', 3),
(4, 'Emergence Negro Hombre', 4),
(5, 'Princess Blanco Mujer', 5),
(6, 'Revolution 5', 1),
(7, 'Kaptir', 2),
(8, 'Cerus Rw Grises para Hombre', 3),
(9, 'X-Ray color azul/Blanco Hombre', 4),
(10, 'Royal Charm Negros liga', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id_mpio` char(10) NOT NULL,
  `nom_mpio` varchar(45) DEFAULT NULL,
  `id_edo` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_mpio`),
  KEY `id_edo` (`id_edo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_mpio`, `nom_mpio`, `id_edo`) VALUES
('Qro_01', ' Querétaro', 'es_22'),
('Qro_02', 'Amealco de Bonfil', 'es_22'),
('Qro_03', 'Arroyo Seco', 'es_22'),
('Qro_04', 'Cadereyta de Montes', 'es_22'),
('Qro_05', 'Colón', 'es_22'),
('Qro_06', 'Corregidora', 'es_22'),
('Qro_07', 'El Marqués', 'es_22'),
('Qro_08', 'Ezequiel Montes', 'es_22'),
('Qro_09', 'Huimilpan', 'es_22'),
('Qro_10', 'Jalpan de Serra', 'es_22'),
('Qro_11', 'Landa de Matamoros', 'es_22'),
('Qro_12', 'Pedro Escobedo', 'es_22'),
('Qro_13', 'Peñamiller', 'es_22'),
('Qro_14', 'Pinal de Amoles', 'es_22'),
('Qro_15', 'San Joaquín', 'es_22'),
('Qro_16', 'San Juan del Río', 'es_22'),
('Qro_17', 'Tequisquiapan', 'es_22'),
('Qro_18', 'Tolimán', 'es_22'),
('Agc_01', 'Aguascalientes', 'es_01'),
('Agc_02', 'Asientos', 'es_01'),
('Agc_03', 'Calvillo', 'es_01'),
('Agc_04', 'Cosío', 'es_01'),
('Agc_05', 'Jesús María', 'es_01'),
('Agc_06', 'Pabellón de Arteaga', 'es_01'),
('Agc_07', 'Rincón de Romos', 'es_01'),
('Agc_08', 'San José de Gracia', 'es_01'),
('Agc_09', 'Tepezalá', 'es_01'),
('Agc_10', 'El Llano', 'es_01'),
('Agc_11', 'San Francisco de los Romo', 'es_01'),
('BC_01', 'Ensenada', 'es_02'),
('BC_02', 'Mexicali', 'es_02'),
('BC_03', 'Tecate', 'es_02'),
('BC_04', 'Tijuana', 'es_02'),
('BC_05', 'Playas de Rosarito', 'es_02'),
('BC_06', 'San Quintín', 'es_02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE IF NOT EXISTS `pago` (
  `id_pago` int(20) NOT NULL,
  `tip_pago` varchar(20) DEFAULT NULL,
  `fec_pago` date DEFAULT NULL,
  `monto` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `tip_pago`, `fec_pago`, `monto`) VALUES
(1, 'Paypal', '2020-01-02', 6998.50),
(2, 'Paypal', '2020-02-01', 14637.64),
(3, 'Paypal', '2020-02-04', 3000.00),
(4, 'Paypal', '2020-10-07', 11043.20),
(5, 'Paypal', '2020-08-02', 4344.45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_prod` char(30) NOT NULL,
  `num_prod` int(10) NOT NULL,
  `id_mod` int(11) DEFAULT NULL,
  `id_mrc` int(11) DEFAULT NULL,
  `nom_prod` char(45) DEFAULT NULL,
  `desc_prod` char(100) DEFAULT NULL,
  `cos_prod` float(8,2) DEFAULT NULL,
  `prec_prod` float(8,2) DEFAULT NULL,
  `img_prod` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_prod`,`num_prod`),
  KEY `id_mod` (`id_mod`),
  KEY `id_mrc` (`id_mrc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `num_prod`, `id_mod`, `id_mrc`, `nom_prod`, `desc_prod`, `cos_prod`, `prec_prod`, `img_prod`) VALUES
('P_01', 22, 1, 1, 'Air Max 200 marca Nike', 'Tenis marca Nike color negro para Mujer', 800.50, 1300.00, 'https://http2.mlstatic.com/tenis-nike-air-max-200-mujer-moda-casual-fila-falcon-270-90-D_NQ_NP_711208-MLM40823929408_022020-F.jpg'),
('P_02', 25, 2, 2, 'Grand Court marca Adidas', 'Tenis marca Adidas color blanco para Hombre', 900.50, 1500.00, 'https://resources.claroshop.com/medios-plazavip/s2/10687/850117/5c98086de31f7-62bb86b5-51e0-43e7-83e6-edee1c7d766b-1600x1600.jpg'),
('P_03', 22, 3, 3, 'Ward Negro marca Vans', 'Tenis marca Vans color negro para Hombre', 700.00, 1400.00, 'https://http2.mlstatic.com/tenis-vans-ward-color-negro-para-hombre-pr-8079672-D_NQ_NP_673970-MLM31230892752_062019-F.jpg'),
('P_04', 25, 4, 4, 'Emergence marca Puma', 'Tenis marca Puma color negro para Hombre', 850.00, 1500.50, 'https://static.netshoes.com.mx/produtos/tenis-puma-emergence/16/003-6134-016/003-6134-016_zoom1.jpg?ims=544x'),
('P_05', 26, 5, 5, 'Princess marca Reebok', 'Tenis marca Reebok color blanco para Mujer', 750.00, 1399.50, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg'),
('P_06', 29, 6, 1, 'Revolution 5 nike', 'Suela de hule sintentico elastico y con velcro', 899.00, 1142.32, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg'),
('P_07', 26, 7, 2, 'Kaptir Adidas', 'Calzado cosido y pegado suela sintetica', 1102.56, 1525.00, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg'),
('P_08', 23, 8, 3, 'Tenis vans Cerus Rw Grises para hombre', 'Tenis para skate suela sintetica', 1262.15, 1904.06, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg'),
('P_09', 24, 9, 4, 'X-Ray color azul/Blanco Hombre', 'Suela sintetica cosido y pegado', 1136.69, 1448.15, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg'),
('P_10', 26, 10, 5, 'Royal charm negro liga', 'Piel sintetica suela de liga', 926.90, 1249.26, 'https://resources.claroshop.com/medios-plazavip/mkt/5dcc45fc11156_original-2-jpg.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `id_src` varchar(45) NOT NULL,
  `nom_src` varchar(45) DEFAULT NULL,
  `tel_src` char(20) DEFAULT NULL,
  `ne_src` int(5) DEFAULT NULL,
  `ni_src` int(5) DEFAULT NULL,
  `cp_src` int(7) DEFAULT NULL,
  `calle_src` varchar(45) DEFAULT NULL,
  `col_src` varchar(45) DEFAULT NULL,
  `id_mpio` char(20) DEFAULT NULL,
  `id_adm` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_src`),
  KEY `id_mpio` (`id_mpio`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_src`, `nom_src`, `tel_src`, `ne_src`, `ni_src`, `cp_src`, `calle_src`, `col_src`, `id_mpio`, `id_adm`) VALUES
('S_01', 'Sucursal Aguascalientes', '4492346627', 23, 2, 20710, 'Calle Julio', 'Colonia Azul', 'Agc_02', 'A_0001'),
('S_02', 'Sucursal Queretaro', '4424348730', 8, 1, 76650, 'Calle Enero', 'Colonia La laguna', 'Qro_08', 'A_0002'),
('S_03', 'Sucursal Baja California', '6864348722', 17, 3, 21000, 'Calle Marzo', 'Colonia Fuentes', 'BC_02', 'A_0003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_us` int(10) NOT NULL,
  `tipo_us` varchar(30) DEFAULT NULL,
  `id_adm` char(20) DEFAULT NULL,
  `id_cte` char(20) DEFAULT NULL,
  `pass_us` blob,
  PRIMARY KEY (`id_us`),
  KEY `id_adm` (`id_adm`),
  KEY `id_cte` (`id_cte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_us`, `tipo_us`, `id_adm`, `id_cte`, `pass_us`) VALUES
(1, 'administrador', 'A_0001', NULL, 0x313233),
(2, 'administrador', 'A_0002', NULL, 0x313233),
(3, 'administrador', 'A_0003', NULL, 0x313233),
(4, 'cliente', NULL, 'c_0001', 0x313233),
(5, 'cliente', NULL, 'c_0002', 0x313233),
(6, 'cliente', NULL, 'c_0003', 0x313233),
(7, 'cliente', NULL, 'c_0004', 0x313233),
(8, 'cliente', NULL, 'c_0005', 0x313233);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `id_ven` int(11) NOT NULL,
  `fec_ven` date DEFAULT NULL,
  `id_pago` int(20) DEFAULT NULL,
  `id_cte` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_ven`),
  KEY `id_pago` (`id_pago`),
  KEY `id_cte` (`id_cte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_ven`, `fec_ven`, `id_pago`, `id_cte`) VALUES
(1, '2020-01-02', 1, 'C_0002'),
(2, '2020-02-01', 2, 'C_0004'),
(3, '2020-02-04', 3, 'C_0001'),
(4, '2020-10-07', 4, 'C_0002'),
(5, '2020-08-02', 5, 'C_0003');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

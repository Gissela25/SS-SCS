-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2023 at 08:15 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ss-scs`
--

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `generar_codigo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `generar_codigo` () RETURNS VARCHAR(6) CHARSET utf8 COLLATE utf8_unicode_ci BEGIN
  DECLARE codigo VARCHAR(6);
  SET codigo = CONCAT('U', LPAD(FLOOR(RAND() * 100000), 5, '0'));
  WHILE EXISTS(SELECT 1 FROM tabla WHERE codigo = codigo) DO
    SET codigo = CONCAT('U', LPAD(FLOOR(RAND() * 100000), 5, '0'));
  END WHILE;
  RETURN codigo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `Id_Area` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Area`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`Id_Area`, `Nombre`, `Id_Estado`) VALUES
('A12343', 'Serologia', 1),
('A12345', 'Tamizaje', 1),
('A27215', 'Celulares', 1),
('A48672', 'Jefatura', 1),
('A59165', 'Sangria', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Codigo` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NombreA` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Presentacion` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Departamento` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Area` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Articulo`),
  UNIQUE KEY `Nombre` (`NombreA`),
  KEY `Id_Presentacion` (`Id_Presentacion`),
  KEY `Id_Departamento` (`Id_Departamento`),
  KEY `Id_Area` (`Id_Area`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`Id_Articulo`, `Codigo`, `NombreA`, `Id_Presentacion`, `Id_Departamento`, `Id_Area`, `Id_Estado`) VALUES
('I17444664310128', '20212129', 'Agua Mineral', 'P123', 'D32551', 'A12343', 1),
('I33172199242160', '202226023', 'Agua Deshidratada', 'P123', 'D96937', 'A59165', 1),
('I48081567842105', '20212125', 'Gasas', 'P123', 'D44522', 'A12343', 1),
('I58544007596640', '20129091', 'PCR', 'P123', 'D44522', 'A12343', 1),
('I58872765406360', '20128999', 'Kit de tamizaje', 'P123', 'D44522', 'A12345', 1),
('I83045535656790', '202226056', 'Mascarilla', 'P123', 'D96937', 'A59165', 1),
('I89489943973588', '20129094', 'Prueba de Sifilis', 'P123', 'D44522', 'A12343', 1),
('I99745938237056', '20212127', 'Jeringas', 'P123', 'D44522', 'A12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `correlativos`
--

DROP TABLE IF EXISTS `correlativos`;
CREATE TABLE IF NOT EXISTS `correlativos` (
  `Id_Correlativo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Usuario` char(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Correlativo`),
  KEY `correlativos_ibfk_1` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `correlativos`
--

INSERT INTO `correlativos` (`Id_Correlativo`, `Id_Usuario`) VALUES
('202305271146', 'U00001'),
('202305272270', 'U00001'),
('202305276780', 'U00001'),
('202305278247', 'U00001'),
('202305279328', 'U00001'),
('202305271582', 'U00005'),
('202305271843', 'U00005'),
('202305272076', 'U00005'),
('202305273344', 'U00005'),
('202305274265', 'U00005'),
('202305274302', 'U00005'),
('202305275970', 'U00005'),
('202305276413', 'U00005'),
('202305276614', 'U00005'),
('202305276945', 'U00005'),
('202305277276', 'U00005'),
('202305277555', 'U00005'),
('202305277799', 'U00005'),
('202305278344', 'U00005'),
('202305278770', 'U00005'),
('2305274366', 'U00005'),
('2305276167', 'U00005'),
('2305278315', 'U00005'),
('C13080614701803', 'U00005'),
('C13468968651569', 'U00005'),
('C14593576747086', 'U00005'),
('C18460840983884', 'U00005'),
('C20279423835536', 'U00005'),
('C21154254463434', 'U00005'),
('C26030649354845', 'U00005'),
('C26704507025914', 'U00005'),
('C32259560581178', 'U00005'),
('C33794839814733', 'U00005'),
('C40988094803670', 'U00005'),
('C45262959834893', 'U00005'),
('C45560858706462', 'U00005'),
('C46127290674832', 'U00005'),
('C47302632661204', 'U00005'),
('C48045038019342', 'U00005'),
('C48288958278537', 'U00005'),
('C52377747428241', 'U00005'),
('C59784243779358', 'U00005'),
('C61726074887060', 'U00005'),
('C64081378727175', 'U00005'),
('C64453052373294', 'U00005'),
('C65258068617313', 'U00005'),
('C67721598925531', 'U00005'),
('C70946268851372', 'U00005'),
('C73075489944345', 'U00005'),
('C77989877777040', 'U00005'),
('C79403376664314', 'U00005'),
('C83868221395246', 'U00005'),
('C84292254216967', 'U00005'),
('C86948846408555', 'U00005'),
('C87261418159830', 'U00005'),
('C90385251058411', 'U00005'),
('C95182200816605', 'U00005'),
('C96613247592074', 'U00005'),
('C97539601338373', 'U00005'),
('C98031260156260', 'U00005'),
('C98173509275333', 'U00005'),
('C99087588134956', 'U00005'),
('C99630092549409', 'U00005');

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `Id_Departamento` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `NombreD` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Departamento`),
  UNIQUE KEY `Nombre` (`NombreD`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`Id_Departamento`, `NombreD`, `Id_Estado`) VALUES
('D32551', 'Crecitin', 2),
('D44522', 'Ambu', 1),
('D96937', 'Gerencia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `Id_Estado` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`Id_Estado`, `Estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `estados_movimiento`
--

DROP TABLE IF EXISTS `estados_movimiento`;
CREATE TABLE IF NOT EXISTS `estados_movimiento` (
  `Id_EstadoMov` int(11) NOT NULL AUTO_INCREMENT,
  `Estado_Movimiento` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_EstadoMov`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estados_movimiento`
--

INSERT INTO `estados_movimiento` (`Id_EstadoMov`, `Estado_Movimiento`) VALUES
(1, 'PENDIENTE'),
(2, 'COMPLETADO');

-- --------------------------------------------------------

--
-- Table structure for table `existencias`
--

DROP TABLE IF EXISTS `existencias`;
CREATE TABLE IF NOT EXISTS `existencias` (
  `Id_Existencia` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `NoComprobante` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Saldo` int(11) NOT NULL DEFAULT '0',
  `SaldoInicial` int(11) DEFAULT NULL,
  `F_LastUpdate` date NOT NULL,
  `EsSaldoInicial` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Existencia`),
  KEY `existencias_ibfk_1` (`Id_Articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `existencias`
--

INSERT INTO `existencias` (`Id_Existencia`, `Id_Articulo`, `NoComprobante`, `Saldo`, `SaldoInicial`, `F_LastUpdate`, `EsSaldoInicial`) VALUES
('E26724557571726', 'I89489943973588', '', 0, NULL, '2023-05-26', 1),
('E35578389916098', 'I58544007596640', '26202306', 15, 40, '2023-05-27', 1),
('E43321048868076', 'I99745938237056', '', 0, 25, '2023-05-24', 1),
('E57328323996558', 'I58872765406360', '26202308', 20, 5, '2023-05-27', 1),
('E62304667623815', 'I33172199242160', '26202308', 60, 60, '2023-05-27', 1),
('E81797379711633', 'I17444664310128', '26202311', 5, 5, '2023-05-27', 1),
('E87038057115618', 'I83045535656790', '26202311', 5, 5, '2023-05-27', 1),
('E95265838413285', 'I48081567842105', '26202305', 0, 5, '2023-05-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `Id_Correlativo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Existencia` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Entrada` int(11) NOT NULL DEFAULT '0',
  `Salida` int(11) NOT NULL DEFAULT '0',
  `Correctivo` int(11) DEFAULT '0',
  `SaldoResultante` int(11) NOT NULL,
  `F_Movimiento` date NOT NULL,
  KEY `movimientos_ibfk_1` (`Id_Correlativo`),
  KEY `movimientos_ibfk_2` (`Id_Articulo`),
  KEY `movimientos_ibfk_3` (`Id_Existencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movimientos_temp`
--

DROP TABLE IF EXISTS `movimientos_temp`;
CREATE TABLE IF NOT EXISTS `movimientos_temp` (
  `Id_Session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Usuario` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Existencia` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_EstadoMov` int(11) NOT NULL DEFAULT '1',
  KEY `movimientos_temp_ibfk_1` (`Id_EstadoMov`),
  KEY `movimientos_temp_ibfk_2` (`Id_Articulo`),
  KEY `movimientos_temp_ibfk_3` (`Id_Usuario`),
  KEY `movimientos_temp_ibfk_5` (`Id_Existencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
CREATE TABLE IF NOT EXISTS `presentaciones` (
  `Id_Presentacion` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `NombreP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Presentacion`),
  UNIQUE KEY `Presentacion` (`NombreP`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `presentaciones`
--

INSERT INTO `presentaciones` (`Id_Presentacion`, `NombreP`, `Id_Estado`) VALUES
('P123', 'Unidad', 1),
('P234', '250 ml', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `Id_Tipo` int(11) NOT NULL,
  `Tipo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`Id_Tipo`, `Tipo`) VALUES
(0, 'Admin'),
(1, 'Empleado');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_Usuario` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `Clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo_Usuario` int(11) NOT NULL DEFAULT '1',
  `Id_Estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Usuario`),
  KEY `Id_Estado` (`Id_Estado`),
  KEY `Tipo_Usuario` (`Tipo_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Tipo_Usuario`, `Id_Estado`) VALUES
('U00001', 'Jony', 'Morales', 'jony25lopezml@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U00002', 'Gissela', 'Serrano', 'gissela25serrano@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U00003', 'Susan', 'Selaya', 'susan23selaya@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U00005', 'John', 'Doe', 'johndoe@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 1),
('U31988', 'Kelly', 'Wakasa', 'wakasi@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`Id_Estado`) REFERENCES `estados` (`Id_Estado`);

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`Id_Presentacion`) REFERENCES `presentaciones` (`Id_Presentacion`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`Id_Departamento`) REFERENCES `departamentos` (`Id_Departamento`),
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`Id_Area`) REFERENCES `areas` (`Id_Area`),
  ADD CONSTRAINT `articulos_ibfk_4` FOREIGN KEY (`Id_Estado`) REFERENCES `estados` (`Id_Estado`);

--
-- Constraints for table `correlativos`
--
ALTER TABLE `correlativos`
  ADD CONSTRAINT `correlativos_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`);

--
-- Constraints for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`Id_Estado`) REFERENCES `estados` (`Id_Estado`);

--
-- Constraints for table `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_1` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`);

--
-- Constraints for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`Id_Correlativo`) REFERENCES `correlativos` (`Id_Correlativo`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`),
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`Id_Existencia`) REFERENCES `existencias` (`Id_Existencia`);

--
-- Constraints for table `movimientos_temp`
--
ALTER TABLE `movimientos_temp`
  ADD CONSTRAINT `movimientos_temp_ibfk_1` FOREIGN KEY (`Id_EstadoMov`) REFERENCES `estados_movimiento` (`Id_EstadoMov`),
  ADD CONSTRAINT `movimientos_temp_ibfk_2` FOREIGN KEY (`Id_Articulo`) REFERENCES `articulos` (`Id_Articulo`),
  ADD CONSTRAINT `movimientos_temp_ibfk_3` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`),
  ADD CONSTRAINT `movimientos_temp_ibfk_5` FOREIGN KEY (`Id_Existencia`) REFERENCES `existencias` (`Id_Existencia`);

--
-- Constraints for table `presentaciones`
--
ALTER TABLE `presentaciones`
  ADD CONSTRAINT `presentaciones_ibfk_1` FOREIGN KEY (`Id_Estado`) REFERENCES `estados` (`Id_Estado`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Id_Estado`) REFERENCES `estados` (`Id_Estado`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Tipo_Usuario`) REFERENCES `tipos_usuario` (`Id_Tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

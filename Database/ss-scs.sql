-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2023 at 12:57 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `Id_Area` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Area`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`Id_Area`, `Nombre`, `Id_Estado`) VALUES
('A12343', 'Serologia', 1),
('A12345', 'Tamizaje', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `NombreA` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Presentacion` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Departamento` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Area` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Articulo`),
  UNIQUE KEY `Nombre` (`NombreA`),
  KEY `Id_Presentacion` (`Id_Presentacion`),
  KEY `Id_Departamento` (`Id_Departamento`),
  KEY `Id_Area` (`Id_Area`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `Id_Departamento` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `NombreD` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Departamento`),
  UNIQUE KEY `Nombre` (`NombreD`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`Id_Departamento`, `NombreD`, `Id_Estado`) VALUES
('D32551', 'Crecitin', 1),
('D44522', 'Ambu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `Id_Estado` int(1) NOT NULL AUTO_INCREMENT,
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
  `Id_EstadoMov` int(1) NOT NULL AUTO_INCREMENT,
  `Estado_Movimiento` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_EstadoMov`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `Saldo` int(8) NOT NULL DEFAULT '0',
  `F_LastUpdate` datetime NOT NULL,
  PRIMARY KEY (`Id_Existencia`),
  KEY `existencias_ibfk_1` (`Id_Articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `Id_Correlativo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Articulo` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Existencia` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Entrada` int(8) NOT NULL,
  `Salida` int(8) NOT NULL,
  `F_Movimiento` datetime NOT NULL,
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
  `Cantidad` int(8) NOT NULL,
  `Id_EstadoMov` int(1) NOT NULL,
  KEY `movimientos_temp_ibfk_1` (`Id_EstadoMov`),
  KEY `movimientos_temp_ibfk_2` (`Id_Articulo`),
  KEY `movimientos_temp_ibfk_3` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
CREATE TABLE IF NOT EXISTS `presentaciones` (
  `Id_Presentacion` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `NombreP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Presentacion`),
  UNIQUE KEY `Presentacion` (`NombreP`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `presentaciones`
--

INSERT INTO `presentaciones` (`Id_Presentacion`, `NombreP`, `Id_Estado`) VALUES
('P123', 'Unidad', 1),
('P234', '250 ml', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `Id_Tipo` int(1) NOT NULL,
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
  `Tipo_Usuario` int(1) NOT NULL DEFAULT '1',
  `Id_Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Usuario`),
  KEY `Id_Estado` (`Id_Estado`),
  KEY `Tipo_Usuario` (`Tipo_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Tipo_Usuario`, `Id_Estado`) VALUES
('U00001', 'Jony Edenilson', 'Morales', 'jony25lopezml@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U00002', 'Gissela', 'Serrano', 'gissela25serrano@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U00003', 'Susan', 'Selaya', 'susan23selaya@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 1),
('U31988', 'Kelly', 'Wakasa', 'wakasi@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 2);

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
  ADD CONSTRAINT `movimientos_temp_ibfk_3` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`);

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

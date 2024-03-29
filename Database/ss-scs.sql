-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2023 at 07:09 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

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
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetProductEntrySummary`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductEntrySummary` (IN `initialDate` DATE, IN `finalDate` DATE)   BEGIN
    SELECT 
        articulos.NombreA,
        SUM(movimientos.Entrada) AS CantidadTotal,
        SUM(movimientos.Entrada) / (SELECT SUM(Entrada) FROM movimientos WHERE F_Movimiento BETWEEN initialDate AND finalDate AND Entrada > 0) * 100 AS Porcentaje
    FROM movimientos 
    JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo
    WHERE F_Movimiento BETWEEN initialDate AND finalDate AND Entrada > 0
    GROUP BY articulos.NombreA;
END$$

DROP PROCEDURE IF EXISTS `GetProductOutputSummary`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductOutputSummary` (IN `initialDate` DATE, IN `finalDate` DATE)   BEGIN
    SELECT 
        articulos.NombreA,
        SUM(movimientos.Salida) AS CantidadTotal,
        SUM(movimientos.Salida) / (SELECT SUM(Salida) FROM movimientos WHERE F_Movimiento BETWEEN initialDate AND finalDate AND Salida > 0) * 100 AS Porcentaje
    FROM movimientos 
    JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo
    WHERE F_Movimiento BETWEEN initialDate AND finalDate AND Salida > 0
    GROUP BY articulos.NombreA;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `generar_codigo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `generar_codigo` () RETURNS VARCHAR(6) CHARSET utf8mb3 COLLATE utf8mb3_unicode_ci  BEGIN
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
  `Id_Area` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Area`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `Id_Articulo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Codigo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `NombreA` varchar(65) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Presentacion` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Departamento` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Area` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Articulo`),
  KEY `Id_Presentacion` (`Id_Presentacion`),
  KEY `Id_Departamento` (`Id_Departamento`),
  KEY `Id_Area` (`Id_Area`),
  KEY `Id_Estado` (`Id_Estado`),
  KEY `Nombre` (`NombreA`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`Id_Articulo`, `Codigo`, `NombreA`, `Id_Presentacion`, `Id_Departamento`, `Id_Area`, `Id_Estado`) VALUES
('I10626524267147', '123456789', 'Soda', 'P123', 'D75300', 'A12343', 1),
('I17444664310128', '20212129', 'Agua Mineral', 'P123', 'D32551', 'A12343', 1),
('I33172199242160', '202226023', 'Agua Deshidratada', 'P123', 'D96937', 'A59165', 1),
('I44617663365564', '45464547', 'panadol', 'P123', 'D96937', 'A12343', 1),
('I45995451110446', '20222699', 'Acetaminofen', 'P123', 'D44522', 'A12343', 1),
('I48081567842105', '20212125', 'Gasas', 'P123', 'D44522', 'A12343', 1),
('I50202109235693', '202309223499', 'panadol', 'P123', 'D44522', 'A12343', 1),
('I58544007596640', '20129091', 'PCR', 'P123', 'D44522', 'A12343', 1),
('I58872765406360', '20128999', 'Kit de tamizaje', 'P123', 'D44522', 'A12345', 1),
('I72916666533693', '2022269832342', 'Acetaminofen', 'P123', 'D96937', 'A12343', 1),
('I83045535656790', '202226056', 'Mascarilla', 'P123', 'D96937', 'A59165', 1),
('I89489943973588', '20129094', 'Prueba de Sifilis', 'P123', 'D44522', 'A12343', 1),
('I95770845223092', '87979857', 'Mascarillas', 'P123', 'D44522', 'A12343', 1),
('I99580613387904', '12131213', 'panadol', 'P123', 'D75300', 'A12343', 1),
('I99745938237056', '20212127', 'Jeringas', 'P123', 'D44522', 'A12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `correlativos`
--

DROP TABLE IF EXISTS `correlativos`;
CREATE TABLE IF NOT EXISTS `correlativos` (
  `Id_Correlativo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Usuario` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Correlativo`),
  KEY `correlativos_ibfk_1` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `correlativos`
--

INSERT INTO `correlativos` (`Id_Correlativo`, `Id_Usuario`) VALUES
('202306071826', 'GS2367'),
('202306075523', 'GS2367'),
('202306076119', 'GS2367'),
('202305301432', 'JD0001'),
('202305304143', 'JD0001'),
('202305308191', 'JD0001'),
('202305309597', 'JD0001'),
('202305309951', 'JD0001'),
('202306073922', 'JD0001'),
('202306076916', 'JD0001'),
('202306077860', 'JD0001'),
('202310181490', 'JD0001'),
('202310182718', 'JD0001'),
('202310182887', 'JD0001'),
('202310183130', 'JD0001'),
('202310183920', 'JD0001'),
('202310184040', 'JD0001'),
('202310188472', 'JD0001'),
('202310188506', 'JD0001'),
('202311273716', 'JD0001'),
('202311277474', 'JD0001'),
('202311286331', 'JD0001'),
('202311287816', 'JD0001'),
('202311288267', 'JD0001');

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `Id_Departamento` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `NombreD` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Departamento`),
  UNIQUE KEY `Nombre` (`NombreD`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`Id_Departamento`, `NombreD`, `Id_Estado`) VALUES
('D32551', 'Almacen', 1),
('D44522', 'Ambulancias', 1),
('D75300', 'Sangrias', 1),
('D96937', 'Gerencia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `Id_Estado` int NOT NULL AUTO_INCREMENT,
  `Estado` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `Id_EstadoMov` int NOT NULL AUTO_INCREMENT,
  `Estado_Movimiento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_EstadoMov`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `Id_Existencia` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Articulo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `NoComprobante` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Saldo` int NOT NULL DEFAULT '0',
  `SaldoInicial` int DEFAULT NULL,
  `F_LastUpdate` date NOT NULL,
  `EsSaldoInicial` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Existencia`),
  KEY `existencias_ibfk_1` (`Id_Articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `existencias`
--

INSERT INTO `existencias` (`Id_Existencia`, `Id_Articulo`, `NoComprobante`, `Saldo`, `SaldoInicial`, `F_LastUpdate`, `EsSaldoInicial`) VALUES
('E25099010389098', 'I50202109235693', NULL, 0, NULL, '2023-10-18', 1),
('E26724557571726', 'I89489943973588', '26202308', 60, 60, '2023-11-28', 0),
('E33290568337510', 'I45995451110446', NULL, 0, NULL, '2023-06-02', 1),
('E35578389916098', 'I58544007596640', '2620239923', 50, 20, '2023-11-28', 0),
('E36742947971538', 'I95770845223092', '23456789', 40, 45, '2023-06-07', 0),
('E43321048868076', 'I99745938237056', '', 0, 25, '2023-05-24', 1),
('E43763801248919', 'I99580613387904', '2620231145', 20, 8, '2023-11-27', 0),
('E57328323996558', 'I58872765406360', '26202308', 20, 5, '2023-05-27', 1),
('E62304667623815', 'I33172199242160', '26202308', 60, 60, '2023-05-27', 1),
('E69447216263976', 'I72916666533693', NULL, 0, NULL, '2023-10-18', 1),
('E70638510411623', 'I10626524267147', NULL, 0, NULL, '2023-06-07', 1),
('E73522602520834', 'I44617663365564', NULL, 0, NULL, '2023-10-18', 1),
('E81797379711633', 'I17444664310128', '26202311', 5, 5, '2023-05-27', 1),
('E87038057115618', 'I83045535656790', '26202311', 5, 5, '2023-05-27', 1),
('E95265838413285', 'I48081567842105', '26202305', 30, 35, '2023-05-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `Id_Correlativo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Articulo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Existencia` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Entrada` int NOT NULL DEFAULT '0',
  `Salida` int NOT NULL DEFAULT '0',
  `Correctivo` int DEFAULT '0',
  `SaldoResultante` int NOT NULL,
  `F_Movimiento` date NOT NULL,
  KEY `movimientos_ibfk_1` (`Id_Correlativo`),
  KEY `movimientos_ibfk_2` (`Id_Articulo`),
  KEY `movimientos_ibfk_3` (`Id_Existencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `movimientos`
--

INSERT INTO `movimientos` (`Id_Correlativo`, `Id_Articulo`, `Id_Existencia`, `Entrada`, `Salida`, `Correctivo`, `SaldoResultante`, `F_Movimiento`) VALUES
('202305301432', 'I58544007596640', 'E35578389916098', 20, 0, 0, 20, '2023-05-30'),
('202305304143', 'I58544007596640', 'E35578389916098', 0, 0, 5, 20, '2023-05-30'),
('202305309951', 'I89489943973588', 'E26724557571726', 60, 0, 0, 60, '2023-05-30'),
('202305309597', 'I48081567842105', 'E95265838413285', 35, 0, 0, 35, '2023-05-30'),
('202305308191', 'I58544007596640', 'E35578389916098', 0, 8, 0, 12, '2023-05-30'),
('202305308191', 'I48081567842105', 'E95265838413285', 0, 5, 0, 30, '2023-05-30'),
('202306077860', 'I58544007596640', 'E35578389916098', 56, 0, 0, 68, '2023-06-07'),
('202306073922', 'I58544007596640', 'E35578389916098', 0, 0, 1, 69, '2023-06-07'),
('202306076916', 'I89489943973588', 'E26724557571726', 0, 2, 0, 58, '2023-06-07'),
('202306076119', 'I58544007596640', 'E35578389916098', 0, 9, 0, 60, '2023-06-07'),
('202306071826', 'I95770845223092', 'E36742947971538', 45, 0, 0, 45, '2023-06-07'),
('202306075523', 'I95770845223092', 'E36742947971538', 0, 5, 0, 40, '2023-06-07'),
('202306075523', 'I58544007596640', 'E35578389916098', 0, 10, 0, 50, '2023-06-07'),
('202310182887', 'I99580613387904', 'E43763801248919', 8, 0, 0, 8, '2023-10-18'),
('202310183130', 'I99580613387904', 'E43763801248919', 9, 0, 0, 17, '2023-10-18'),
('202310188506', 'I99580613387904', 'E43763801248919', 0, 9, 0, 8, '2023-10-18'),
('202310184040', 'I58544007596640', 'E35578389916098', 0, 1, 0, 49, '2023-10-18'),
('202310184040', 'I99580613387904', 'E43763801248919', 0, 2, 0, 6, '2023-10-18'),
('202310181490', 'I99580613387904', 'E43763801248919', 0, 4, 0, 2, '2023-10-18'),
('202310188472', 'I99580613387904', 'E43763801248919', 5, 0, 0, 7, '2023-10-18'),
('202310182718', 'I99580613387904', 'E43763801248919', 6, 0, 0, 13, '2023-10-18'),
('202310183920', 'I58544007596640', 'E35578389916098', 0, 4, 0, 45, '2023-10-18'),
('202310183920', 'I89489943973588', 'E26724557571726', 0, 3, 0, 55, '2023-10-18'),
('202311273716', 'I99580613387904', 'E43763801248919', 0, 0, 2, 15, '2023-11-27'),
('202311277474', 'I99580613387904', 'E43763801248919', 5, 0, 0, 20, '2023-11-27'),
('202311286331', 'I58544007596640', 'E35578389916098', 5, 0, 0, 50, '2023-11-28'),
('202311288267', 'I89489943973588', 'E26724557571726', 8, 0, 0, 63, '2023-11-28'),
('202311287816', 'I89489943973588', 'E26724557571726', 0, 3, 0, 60, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `movimientos_temp`
--

DROP TABLE IF EXISTS `movimientos_temp`;
CREATE TABLE IF NOT EXISTS `movimientos_temp` (
  `Id_Session` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Articulo` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Usuario` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Existencia` char(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Cantidad` int NOT NULL,
  `Id_EstadoMov` int NOT NULL DEFAULT '1',
  KEY `movimientos_temp_ibfk_1` (`Id_EstadoMov`),
  KEY `movimientos_temp_ibfk_2` (`Id_Articulo`),
  KEY `movimientos_temp_ibfk_3` (`Id_Usuario`),
  KEY `movimientos_temp_ibfk_5` (`Id_Existencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
CREATE TABLE IF NOT EXISTS `presentaciones` (
  `Id_Presentacion` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `NombreP` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Presentacion`),
  UNIQUE KEY `Presentacion` (`NombreP`),
  KEY `Id_Estado` (`Id_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `presentaciones`
--

INSERT INTO `presentaciones` (`Id_Presentacion`, `NombreP`, `Id_Estado`) VALUES
('P123', 'Unidad', 1),
('P234', '250 ml', 1),
('P794', '569ml', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `Id_Tipo` int NOT NULL,
  `Tipo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`Id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `Id_Usuario` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Apellido` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Correo` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Clave` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Tipo_Usuario` int NOT NULL DEFAULT '1',
  `Id_Area` char(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Id_Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Usuario`),
  KEY `Id_Estado` (`Id_Estado`),
  KEY `Tipo_Usuario` (`Tipo_Usuario`),
  KEY `usuarios_ibfk_3` (`Id_Area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Tipo_Usuario`, `Id_Area`, `Id_Estado`) VALUES
('CM2329', 'Carlos', 'Lopez', 'carlosm@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 'A48672', 2),
('GS2367', 'Gissela', 'Serrano', 'gissela25serrano@gmail.com', 'e24df920078c3dd4e7e8d2442f00e5c9ab2a231bb3918d65cc50906e49ecaef4', 1, 'A12343', 1),
('JD0001', 'John', 'Doe', 'johndoe@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 'A12343', 1),
('JM2366', 'Jony', 'Morales', 'jony25@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 'A48672', 1),
('SM2317', 'Santiago', 'Melendez', 'santiago@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 'A27215', 1);

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
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Tipo_Usuario`) REFERENCES `tipos_usuario` (`Id_Tipo`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`Id_Area`) REFERENCES `areas` (`Id_Area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

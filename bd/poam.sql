-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para poam
CREATE DATABASE IF NOT EXISTS `poam` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `poam`;

-- Volcando estructura para procedimiento poam.agregarCatalogo
DELIMITER //
CREATE PROCEDURE `agregarCatalogo`(
	IN codigo		VARCHAR(24),
    IN nombre		VARCHAR(100),
    IN descripcion	TEXT,
    IN categoria 	VARCHAR(32) )
BEGIN
	DECLARE id INT DEFAULT 0;
    DECLARE idCat INT DEFAULT (SELECT COUNT(idCatalgo) FROM catalogo);
    IF (idCat <= 0) THEN SET id := 1;
    ELSE SET id := idCat + 1;
    END IF;
	INSERT INTO catalogo VALUES(id, codigo, nombre, descripcion, categoria);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarCobertura
DELIMITER //
CREATE PROCEDURE `agregarCobertura`(
	IN subreceptor		INT,
    IN departamento		INT,
    IN municipio 		INT,
    IN porcentaje		FLOAT )
BEGIN
	DECLARE id INT DEFAULT 0;
    DECLARE idCob INT DEFAULT (SELECT COUNT(idCobertura) FROM cobertura);
    IF (idCob <= 0) THEN SET id := 1;
    ELSE SET id := idCob + 1;
    END IF;
	INSERT INTO cobertura VALUES(id, subreceptor, departamento, municipio, porcentaje);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPoa
DELIMITER //
CREATE PROCEDURE `agregarPoa`(
	IN usuario		INT,
	IN mes			INT,
	IN departamento INT,
	IN municipio	INT,
	IN nuevo		FLOAT,
	IN recurrente	FLOAT,
	IN subreceptor	INT,
    IN observacion	TEXT,
    IN semestre		INT,
	IN cnatural 	FLOAT,
	IN csabor		FLOAT,
    IN cfemenino	FLOAT,
	IN lubricante	FLOAT,
	IN pruebaVIH	FLOAT,
	IN autoPrueba	FLOAT,
	IN reactivoE	FLOAT,
	IN sifilis		FLOAT )
BEGIN
	DECLARE IdPoa INT DEFAULT 0;
    DECLARE IdInsumo INT DEFAULT 0;
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPoa) FROM poa);
	DECLARE idI INT DEFAULT (SELECT COUNT(idInsumo) FROM insumo);
	IF(idP <= 0) THEN SET IdPoa := 1;
	ELSE SET IdPoa := idP + 1;
    END IF;
	INSERT INTO poa VALUES(IdPoa,usuario,year(now()),mes,departamento,municipio,nuevo,recurrente,subreceptor,observacion,semestre,1);
	IF(idI <=0) THEN SET IdInsumo := 1;
	ELSE SET IdInsumo := idI + 1;
    END IF;
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfemenino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPom
DELIMITER //
CREATE PROCEDURE `agregarPom`(
	IN usuario		INT,
	IN departamento	INT,
	IN municipio	INT,
	IN nuevo		FLOAT,
	IN recurrente	FLOAT,
    IN observacion	TEXT,
	IN cnatural 	FLOAT,
	IN csabor		FLOAT,
    IN cfeminino	FLOAT,
	IN lubricante	FLOAT,
	IN pruebaVIH	FLOAT,
	IN autoPrueba	FLOAT,
	IN reactivoE	FLOAT,
	IN sifilis		FLOAT )
BEGIN
	DECLARE IdPoa INT DEFAULT 0;
    DECLARE IdInsumo INT DEFAULT 0;
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPoa) FROM poa);
	DECLARE idI INT DEFAULT (SELECT COUNT(idInsumo) FROM insumo);
	IF(idP <= 0) THEN SET IdPoa := 1;
	ELSE SET IdPoa := idP + 1;
    END IF;
	INSERT INTO poa VALUES(IdPoa,usuario,anio,mes,departamento,municipio,nuevo,recurrente,subreceptor,observacion);
	IF(idI <=0) THEN SET IdInsumo := 1;
	ELSE SET IdInsumo := idI + 1;
    END IF;
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfeminino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPromotor
DELIMITER //
CREATE PROCEDURE `agregarPromotor`(
	IN documento	BOOLEAN,
	IN numero		VARCHAR(16),
	IN nombre 		VARCHAR(32),
	IN apellido		VARCHAR(32),
	IN direccion	VARCHAR(64),
	IN telefono		VARCHAR(12),
	IN email		VARCHAR(64),
    IN codigo		VARCHAR(24),
	IN subreceptor	INT )
BEGIN
    DECLARE IdPersona INT DEFAULT 0;
	DECLARE IdPromotor INT DEFAULT 0;
	DECLARE idPer INT DEFAULT	(SELECT COUNT(idPersona) FROM persona);
	DECLARE idPro INT DEFAULT (SELECT COUNT(idPromotor) FROM promotor);
	IF(idPer <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idPer + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona,documento,numero,nombre,apellido,direccion,telefono,email);
	IF(idPro <=0) THEN SET IdPromotor := 1;
	ELSE SET IdPromotor := idPro + 1;
    END IF;
	INSERT INTO promotor VALUES(IdPromotor,codigo,IdPersona,subreceptor,1);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarSubreceptor
DELIMITER //
CREATE PROCEDURE `agregarSubreceptor`(
	IN codigo 		VARCHAR(24),
    IN nombre 		VARCHAR(100),
    IN ecnatural 	INT,
    IN ecsabor 		INT,
    IN ecfemenino	INT,
    IN elubricante	INT,
    IN ppvih 		FLOAT,
    IN ppautoprueba	FLOAT )
BEGIN
	DECLARE id INT DEFAULT 0;
	DECLARE idSub INT DEFAULT (SELECT COUNT(idSubreceptor) FROM subreceptor);
	IF(idSub <= 0) THEN SET id := 1;
	ELSE  SET id := idSub + 1;
	END IF;
	INSERT INTO subreceptor VALUES(id,codigo,nombre,ecnatural,ecsabor,ecfemenino,elubricante,ppvih,ppautoprueba);
	END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarUsuario
DELIMITER //
CREATE PROCEDURE `agregarUsuario`(
	IN documento 	BOOLEAN,
	IN numero		VARCHAR(16),
	IN nombre 		VARCHAR(50),
	IN apellido		VARCHAR(50),
	IN direccion	VARCHAR(100),
	IN telefono		VARCHAR(12),
	IN email		VARCHAR(100),
    IN rol			INT,
	IN subreceptor	INT
    )
BEGIN
	DECLARE IdPersona INT DEFAULT 0;
    DECLARE IdUsuario INT DEFAULT 0;
	DECLARE idP INT DEFAULT (SELECT COUNT(idPersona) FROM persona);
	DECLARE idU INT DEFAULT (SELECT COUNT(idUsuario) FROM usuario);
	IF(idP <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idP + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona,documento,numero,nombre,apellido,direccion,telefono,email);
	IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
	INSERT INTO usuario VALUES(IdUsuario,IdPersona,rol,lower(concat(left(nombre,1),left(apellido,1),year(now()),IdPersona)),SHA('Usuario01'),subreceptor,1);
END//
DELIMITER ;

-- Volcando estructura para tabla poam.catalogo
CREATE TABLE IF NOT EXISTS `catalogo` (
  `idCatalogo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `categoria` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCatalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.catalogo: ~388 rows (aproximadamente)
/*!40000 ALTER TABLE `catalogo` DISABLE KEYS */;
INSERT INTO `catalogo` (`idCatalogo`, `codigo`, `nombre`, `descripcion`, `categoria`) VALUES
	(1, '1', 'Guatemala', ' ', 'departamento'),
	(2, '2', 'El Progreso', ' ', 'departamento'),
	(3, '3', 'Sacatepéquez', ' ', 'departamento'),
	(4, '4', 'Chimaltenango', ' ', 'departamento'),
	(5, '5', 'Escuintla', ' ', 'departamento'),
	(6, '6', 'Santa Rosa', ' ', 'departamento'),
	(7, '7', 'Sololá', ' ', 'departamento'),
	(8, '8', 'Totonicapán', ' ', 'departamento'),
	(9, '9', 'Quetzaltenango', ' ', 'departamento'),
	(10, '10', 'Suchitepéquez', ' ', 'departamento'),
	(11, '11', 'Retalhuleu', ' ', 'departamento'),
	(12, '12', 'San Marcos', ' ', 'departamento'),
	(13, '13', 'Huehuetenango', ' ', 'departamento'),
	(14, '14', 'Quiché', ' ', 'departamento'),
	(15, '15', 'Baja Verapaz', ' ', 'departamento'),
	(16, '16', 'Alta Verapaz', ' ', 'departamento'),
	(17, '17', 'Petén', ' ', 'departamento'),
	(18, '18', 'Izabal', ' ', 'departamento'),
	(19, '19', 'Zacapa', ' ', 'departamento'),
	(20, '20', 'Chiquimula', ' ', 'departamento'),
	(21, '21', 'Jalapa', ' ', 'departamento'),
	(22, '22', 'Jutiapa', ' ', 'departamento'),
	(23, '502', 'Guatemala', ' ', 'pais'),
	(24, '504', 'Honduras', ' ', 'pais'),
	(25, '505', 'Nicaragua', ' ', 'pais'),
	(26, '507', 'Panamá', ' ', 'pais'),
	(27, '503', 'El Salvador', ' ', 'pais'),
	(28, '555', 'Mexico', ' ', 'pais'),
	(29, '101', 'Guatemala', '1', 'municipio'),
	(30, '102', 'Santa Catarina Pinula', '1', 'municipio'),
	(31, '103', 'San José Pinula', '1', 'municipio'),
	(32, '104', 'San José del Golfo', '1', 'municipio'),
	(33, '105', 'Palencia', '1', 'municipio'),
	(34, '106', 'Chinautla', '1', 'municipio'),
	(35, '107', 'San Pedro Ayampuc', '1', 'municipio'),
	(36, '108', 'Mixco', '1', 'municipio'),
	(37, '109', 'San Pedro Sacatepéquez', '1', 'municipio'),
	(38, '110', 'San Juan Sacatepéquez', '1', 'municipio'),
	(39, '111', 'San Raymundo', '1', 'municipio'),
	(40, '112', 'Chuarrancho', '1', 'municipio'),
	(41, '113', 'Fraijanes', '1', 'municipio'),
	(42, '114', 'Amatitlán', '1', 'municipio'),
	(43, '115', 'Villa Nueva', '1', 'municipio'),
	(44, '116', 'Villa Canales', '1', 'municipio'),
	(45, '117', 'Petapa', '1', 'municipio'),
	(46, '201', 'Guastatoya', '2', 'municipio'),
	(47, '202', 'Morazán', '2', 'municipio'),
	(48, '203', 'San Agustín Acasaguastlán', '2', 'municipio'),
	(49, '204', 'San Cristóbal Acasaguastlán', '2', 'municipio'),
	(50, '205', 'El Jícaro', '2', 'municipio'),
	(51, '206', 'Sansare', '2', 'municipio'),
	(52, '207', 'Sanarate', '2', 'municipio'),
	(53, '208', 'San Antonio la Paz', '2', 'municipio'),
	(54, '301', 'Antigua Guatemala', '3', 'municipio'),
	(55, '302', 'Jocotenango', '3', 'municipio'),
	(56, '303', 'Pastores', '3', 'municipio'),
	(57, '304', 'Sumpango', '3', 'municipio'),
	(58, '305', 'Santo Domingo Xenacoj', '3', 'municipio'),
	(59, '306', 'Santiago Sacatepéquez', '3', 'municipio'),
	(60, '307', 'San Bartolomé Milpas Altas', '3', 'municipio'),
	(61, '308', 'San Lucas Sacatepéquez', '3', 'municipio'),
	(62, '309', 'Santa Lucía Milpas Altas', '3', 'municipio'),
	(63, '310', 'Magdalena Milpas Altas', '3', 'municipio'),
	(64, '311', 'Santa María de Jesús', '3', 'municipio'),
	(65, '312', 'Ciudad Vieja', '3', 'municipio'),
	(66, '313', 'San Miguel Dueñas', '3', 'municipio'),
	(67, '314', 'Alotenango', '3', 'municipio'),
	(68, '315', 'San Antonio Aguas Calientes', '3', 'municipio'),
	(69, '316', 'Santa Catarina Barahona', '3', 'municipio'),
	(70, '401', 'Chimaltenango', '4', 'municipio'),
	(71, '402', 'San José Poaquil', '4', 'municipio'),
	(72, '403', 'San Martín Jilotepeque', '4', 'municipio'),
	(73, '404', 'Comalapa', '4', 'municipio'),
	(74, '405', 'Santa Apolonia', '4', 'municipio'),
	(75, '406', 'Tecpán Guatemala', '4', 'municipio'),
	(76, '407', 'Patzún', '4', 'municipio'),
	(77, '408', 'Pochuta', '4', 'municipio'),
	(78, '409', 'Patzicía', '4', 'municipio'),
	(79, '410', 'Santa Cruz Balanyá', '4', 'municipio'),
	(80, '411', 'Acatenango', '4', 'municipio'),
	(81, '412', 'Yepocapa', '4', 'municipio'),
	(82, '413', 'San Andrés Itzapa', '4', 'municipio'),
	(83, '414', 'Parramos', '4', 'municipio'),
	(84, '415', 'Zaragoza', '4', 'municipio'),
	(85, '416', 'El Tejar', '4', 'municipio'),
	(86, '501', 'Escuintla', '5', 'municipio'),
	(87, '502', 'Santa Lucía Cotzumalguapa', '5', 'municipio'),
	(88, '503', 'La Democracia', '5', 'municipio'),
	(89, '504', 'Siquinalá', '5', 'municipio'),
	(90, '505', 'Masagua', '5', 'municipio'),
	(91, '506', 'Tiquisate', '5', 'municipio'),
	(92, '507', 'La Gomera', '5', 'municipio'),
	(93, '508', 'Guanagazapa', '5', 'municipio'),
	(94, '509', 'San José', '5', 'municipio'),
	(95, '510', 'Iztapa', '5', 'municipio'),
	(96, '511', 'Palín', '5', 'municipio'),
	(97, '512', 'San Vicente Pacaya', '5', 'municipio'),
	(98, '513', 'Nueva Concepción', '5', 'municipio'),
	(99, '601', 'Cuilapa', '6', 'municipio'),
	(100, '602', 'Barberena', '6', 'municipio'),
	(101, '603', 'Santa Rosa de Lima', '6', 'municipio'),
	(102, '604', 'Casillas', '6', 'municipio'),
	(103, '605', 'San Rafael las Flores', '6', 'municipio'),
	(104, '606', 'Oratorio', '6', 'municipio'),
	(105, '607', 'San Juan Tecuaco', '6', 'municipio'),
	(106, '608', 'Chiquimulilla', '6', 'municipio'),
	(107, '609', 'Taxisco', '6', 'municipio'),
	(108, '610', 'Santa María Ixhuatán', '6', 'municipio'),
	(109, '611', 'Guazacapán', '6', 'municipio'),
	(110, '612', 'Santa Cruz Naranjo', '6', 'municipio'),
	(111, '613', 'Pueblo Nuevo Viñas', '6', 'municipio'),
	(112, '614', 'Nueva Santa Rosa', '6', 'municipio'),
	(113, '701', 'Sololá', '7', 'municipio'),
	(114, '702', 'San José Chacayá', '7', 'municipio'),
	(115, '703', 'Santa María Visitación', '7', 'municipio'),
	(116, '704', 'Santa Lucía Utatlán', '7', 'municipio'),
	(117, '705', 'Nahualá', '7', 'municipio'),
	(118, '706', 'Santa Catarina Ixtahuacán', '7', 'municipio'),
	(119, '707', 'Santa Clara la Laguna', '7', 'municipio'),
	(120, '708', 'Concepción', '7', 'municipio'),
	(121, '709', 'San Andrés Semetabaj', '7', 'municipio'),
	(122, '710', 'Panajachel', '7', 'municipio'),
	(123, '711', 'Santa Catarina Palopó', '7', 'municipio'),
	(124, '712', 'San Antonio Palopó', '7', 'municipio'),
	(125, '713', 'San Lucas Tolimán', '7', 'municipio'),
	(126, '714', 'Santa Cruz la Laguna', '7', 'municipio'),
	(127, '715', 'San Pablo la Laguna', '7', 'municipio'),
	(128, '716', 'San Marcos la Laguna', '7', 'municipio'),
	(129, '717', 'San Juan la Laguna', '7', 'municipio'),
	(130, '718', 'San Pedro la Laguna', '7', 'municipio'),
	(131, '719', 'Santiago Atitlán', '7', 'municipio'),
	(132, '801', 'Totonicapán', '8', 'municipio'),
	(133, '802', 'San Cristóbal Totonicapán', '8', 'municipio'),
	(134, '803', 'San Francisco el Alto', '8', 'municipio'),
	(135, '804', 'San Andrés Xecul', '8', 'municipio'),
	(136, '805', 'Momostenango', '8', 'municipio'),
	(137, '806', 'Santa María Chiquimula', '8', 'municipio'),
	(138, '807', 'Santa Lucía la Reforma', '8', 'municipio'),
	(139, '808', 'San Bartolo', '8', 'municipio'),
	(140, '901', 'Quetzaltenango', '9', 'municipio'),
	(141, '902', 'Salcajá', '9', 'municipio'),
	(142, '903', 'Olintepeque', '9', 'municipio'),
	(143, '904', 'San Carlos Sija', '9', 'municipio'),
	(144, '905', 'Sibilia', '9', 'municipio'),
	(145, '906', 'Cabricán', '9', 'municipio'),
	(146, '907', 'Cajolá', '9', 'municipio'),
	(147, '908', 'San Miguel Siguilá', '9', 'municipio'),
	(148, '909', 'Ostuncalco', '9', 'municipio'),
	(149, '910', 'San Mateo', '9', 'municipio'),
	(150, '911', 'Concepción Chiquirichapa', '9', 'municipio'),
	(151, '912', 'San Martín Sacatepéquez', '9', 'municipio'),
	(152, '913', 'Almolonga', '9', 'municipio'),
	(153, '914', 'Cantel', '9', 'municipio'),
	(154, '915', 'Huitán', '9', 'municipio'),
	(155, '916', 'Zunil', '9', 'municipio'),
	(156, '917', 'Colomba', '9', 'municipio'),
	(157, '918', 'San Francisco la Unión', '9', 'municipio'),
	(158, '919', 'El Palmar', '9', 'municipio'),
	(159, '920', 'Coatepeque', '9', 'municipio'),
	(160, '921', 'Génova', '9', 'municipio'),
	(161, '922', 'Flores Costa Cuca', '9', 'municipio'),
	(162, '923', 'La Esperanza', '9', 'municipio'),
	(163, '924', 'Palestina de los Altos', '9', 'municipio'),
	(164, '1001', 'Mazatenango', '10', 'municipio'),
	(165, '1002', 'Cuyotenango', '10', 'municipio'),
	(166, '1003', 'San Francisco Zapotitlán', '10', 'municipio'),
	(167, '1004', 'San Bernardino', '10', 'municipio'),
	(168, '1005', 'San José el Idolo', '10', 'municipio'),
	(169, '1006', 'Santo Domingo Suchitepéquez', '10', 'municipio'),
	(170, '1007', 'San Lorenzo', '10', 'municipio'),
	(171, '1008', 'Samayac', '10', 'municipio'),
	(172, '1009', 'San Pablo Jocopilas', '10', 'municipio'),
	(173, '1010', 'San Antonio Suchitepéquez', '10', 'municipio'),
	(174, '1011', 'San Miguel Panán', '10', 'municipio'),
	(175, '1012', 'San Gabriel', '10', 'municipio'),
	(176, '1013', 'Chicacao', '10', 'municipio'),
	(177, '1014', 'Patulul', '10', 'municipio'),
	(178, '1015', 'Santa Bárbara', '10', 'municipio'),
	(179, '1016', 'San Juan Bautista', '10', 'municipio'),
	(180, '1017', 'Santo Tomás la Unión', '10', 'municipio'),
	(181, '1018', 'Zunilito', '10', 'municipio'),
	(182, '1019', 'Pueblo Nuevo', '10', 'municipio'),
	(183, '1020', 'Río Bravo', '10', 'municipio'),
	(184, '1021', 'San José La Máquina', '10', 'municipio'),
	(185, '1101', 'Retalhuleu', '11', 'municipio'),
	(186, '1102', 'San Sebastián', '11', 'municipio'),
	(187, '1103', 'Santa Cruz Muluá', '11', 'municipio'),
	(188, '1104', 'San Martín Zapotitlán', '11', 'municipio'),
	(189, '1105', 'San Felipe', '11', 'municipio'),
	(190, '1106', 'San Andrés Villa Seca', '11', 'municipio'),
	(191, '1107', 'Champerico', '11', 'municipio'),
	(192, '1108', 'Nuevo San Carlos', '11', 'municipio'),
	(193, '1109', 'El Asintal', '11', 'municipio'),
	(194, '1201', 'San Marcos', '12', 'municipio'),
	(195, '1202', 'San Pedro Sacatepéquez', '12', 'municipio'),
	(196, '1203', 'San Antonio Sacatepéquez', '12', 'municipio'),
	(197, '1204', 'Comitancillo', '12', 'municipio'),
	(198, '1205', 'San Miguel Ixtahuacán', '12', 'municipio'),
	(199, '1206', 'Concepción Tutuapa', '12', 'municipio'),
	(200, '1207', 'Tacaná', '12', 'municipio'),
	(201, '1208', 'Sibinal', '12', 'municipio'),
	(202, '1209', 'Tajumulco', '12', 'municipio'),
	(203, '1210', 'Tejutla', '12', 'municipio'),
	(204, '1211', 'San Rafael Pié de la Cuesta', '12', 'municipio'),
	(205, '1212', 'Nuevo Progreso', '12', 'municipio'),
	(206, '1213', 'El Tumbador', '12', 'municipio'),
	(207, '1214', 'El Rodeo', '12', 'municipio'),
	(208, '1215', 'Malacatán', '12', 'municipio'),
	(209, '1216', 'Catarina', '12', 'municipio'),
	(210, '1217', 'Ayutla', '12', 'municipio'),
	(211, '1218', 'Ocós', '12', 'municipio'),
	(212, '1219', 'San Pablo', '12', 'municipio'),
	(213, '1220', 'El Quetzal', '12', 'municipio'),
	(214, '1221', 'La Reforma', '12', 'municipio'),
	(215, '1222', 'Pajapita', '12', 'municipio'),
	(216, '1223', 'Ixchiguán', '12', 'municipio'),
	(217, '1224', 'San José Ojetenán', '12', 'municipio'),
	(218, '1225', 'San Cristóbal Cucho', '12', 'municipio'),
	(219, '1226', 'Sipacapa', '12', 'municipio'),
	(220, '1227', 'Esquipulas Palo Gordo', '12', 'municipio'),
	(221, '1228', 'Río Blanco', '12', 'municipio'),
	(222, '1229', 'San Lorenzo', '12', 'municipio'),
	(223, '1230', 'La Blanca', '12', 'municipio'),
	(224, '1301', 'Huehuetenango', '13', 'municipio'),
	(225, '1302', 'Chiantla', '13', 'municipio'),
	(226, '1303', 'Malacatancito', '13', 'municipio'),
	(227, '1304', 'Cuilco', '13', 'municipio'),
	(228, '1305', 'Nentón', '13', 'municipio'),
	(229, '1306', 'San Pedro Necta', '13', 'municipio'),
	(230, '1307', 'Jacaltenango', '13', 'municipio'),
	(231, '1308', 'Soloma', '13', 'municipio'),
	(232, '1309', 'Ixtahuacán', '13', 'municipio'),
	(233, '1310', 'Santa Bárbara', '13', 'municipio'),
	(234, '1311', 'La Libertad', '13', 'municipio'),
	(235, '1312', 'La Democracia', '13', 'municipio'),
	(236, '1313', 'San Miguel Acatán', '13', 'municipio'),
	(237, '1314', 'San Rafael la Independencia', '13', 'municipio'),
	(238, '1315', 'Todos Santos Cuchumatán', '13', 'municipio'),
	(239, '1316', 'San Juan Atitán', '13', 'municipio'),
	(240, '1317', 'Santa Eulalia', '13', 'municipio'),
	(241, '1318', 'San Mateo Ixtatán', '13', 'municipio'),
	(242, '1319', 'Colotenango', '13', 'municipio'),
	(243, '1320', 'San Sebastián Huehuetenango', '13', 'municipio'),
	(244, '1321', 'Tectitán', '13', 'municipio'),
	(245, '1322', 'Concepción Huista', '13', 'municipio'),
	(246, '1323', 'San Juan Ixcoy', '13', 'municipio'),
	(247, '1324', 'San Antonio Huista', '13', 'municipio'),
	(248, '1325', 'San Sebastián Coatán', '13', 'municipio'),
	(249, '1326', 'Barillas', '13', 'municipio'),
	(250, '1327', 'Aguacatán', '13', 'municipio'),
	(251, '1328', 'San Rafael Petzal', '13', 'municipio'),
	(252, '1329', 'San Gaspar Ixchil', '13', 'municipio'),
	(253, '1330', 'Santiago Chimaltenango', '13', 'municipio'),
	(254, '1331', 'Santa Ana Huista', '13', 'municipio'),
	(255, '1332', 'Unión Cantinil', '13', 'municipio'),
	(256, '1401', 'Santa Cruz del Quiché', '14', 'municipio'),
	(257, '1402', 'Chiché', '14', 'municipio'),
	(258, '1403', 'Chinique', '14', 'municipio'),
	(259, '1404', 'Zacualpa', '14', 'municipio'),
	(260, '1405', 'Chajul', '14', 'municipio'),
	(261, '1406', 'Chichicastenango', '14', 'municipio'),
	(262, '1407', 'Patzité', '14', 'municipio'),
	(263, '1408', 'San Antonio Ilotenango', '14', 'municipio'),
	(264, '1409', 'San Pedro Jocopilas', '14', 'municipio'),
	(265, '1410', 'Cunén', '14', 'municipio'),
	(266, '1411', 'San Juan Cotzal', '14', 'municipio'),
	(267, '1412', 'Joyabaj', '14', 'municipio'),
	(268, '1413', 'Nebaj', '14', 'municipio'),
	(269, '1414', 'San Andrés Sajcabajá', '14', 'municipio'),
	(270, '1415', 'Uspantán', '14', 'municipio'),
	(271, '1416', 'Sacapulas', '14', 'municipio'),
	(272, '1417', 'San Bartolomé Jocotenango', '14', 'municipio'),
	(273, '1418', 'Canillá', '14', 'municipio'),
	(274, '1419', 'Chicamán', '14', 'municipio'),
	(275, '1420', 'Ixcán', '14', 'municipio'),
	(276, '1421', 'Pachalum', '14', 'municipio'),
	(277, '1501', 'Salamá', '15', 'municipio'),
	(278, '1502', 'San Miguel Chicaj', '15', 'municipio'),
	(279, '1503', 'Rabinal', '15', 'municipio'),
	(280, '1504', 'Cubulco', '15', 'municipio'),
	(281, '1505', 'Granados', '15', 'municipio'),
	(282, '1506', 'El Chol', '15', 'municipio'),
	(283, '1507', 'San Jerónimo', '15', 'municipio'),
	(284, '1508', 'Purulhá', '15', 'municipio'),
	(285, '1601', 'Cobán', '16', 'municipio'),
	(286, '1602', 'Santa Cruz Verapaz', '16', 'municipio'),
	(287, '1603', 'San Cristóbal Verapaz', '16', 'municipio'),
	(288, '1604', 'Tactic', '16', 'municipio'),
	(289, '1605', 'Tamahú', '16', 'municipio'),
	(290, '1606', 'Tucurú', '16', 'municipio'),
	(291, '1607', 'Panzós', '16', 'municipio'),
	(292, '1608', 'Senahú', '16', 'municipio'),
	(293, '1609', 'San Pedro Carchá', '16', 'municipio'),
	(294, '1610', 'San Juan Chamelco', '16', 'municipio'),
	(295, '1611', 'Lanquín', '16', 'municipio'),
	(296, '1612', 'Cahabón', '16', 'municipio'),
	(297, '1613', 'Chisec', '16', 'municipio'),
	(298, '1614', 'Chahal', '16', 'municipio'),
	(299, '1615', 'Fray Bartolomé de las Casas', '16', 'municipio'),
	(300, '1616', 'Santa Catalina la Tinta', '16', 'municipio'),
	(301, '1617', 'Raxruhá', '16', 'municipio'),
	(302, '1701', 'Flores', '17', 'municipio'),
	(303, '1702', 'San José', '17', 'municipio'),
	(304, '1703', 'San Benito', '17', 'municipio'),
	(305, '1704', 'San Andrés', '17', 'municipio'),
	(306, '1705', 'La Libertad', '17', 'municipio'),
	(307, '1706', 'San Francisco', '17', 'municipio'),
	(308, '1707', 'Santa Ana', '17', 'municipio'),
	(309, '1708', 'Dolores', '17', 'municipio'),
	(310, '1709', 'San Luis', '17', 'municipio'),
	(311, '1710', 'Sayaxché', '17', 'municipio'),
	(312, '1711', 'Melchor de Mencos', '17', 'municipio'),
	(313, '1712', 'Poptún', '17', 'municipio'),
	(314, '1713', 'Las Cruces', '17', 'municipio'),
	(315, '1714', 'El Chal', '17', 'municipio'),
	(316, '1801', 'Puerto Barrios', '18', 'municipio'),
	(317, '1802', 'Livingston', '18', 'municipio'),
	(318, '1803', 'El Estor', '18', 'municipio'),
	(319, '1804', 'Morales', '18', 'municipio'),
	(320, '1805', 'Los Amates', '18', 'municipio'),
	(321, '1901', 'Zacapa', '19', 'municipio'),
	(322, '1902', 'Estanzuela', '19', 'municipio'),
	(323, '1903', 'Río Hondo', '19', 'municipio'),
	(324, '1904', 'Gualán', '19', 'municipio'),
	(325, '1905', 'Teculután', '19', 'municipio'),
	(326, '1906', 'Usumatlán', '19', 'municipio'),
	(327, '1907', 'Cabañas', '19', 'municipio'),
	(328, '1908', 'San Diego', '19', 'municipio'),
	(329, '1909', 'La Unión', '19', 'municipio'),
	(330, '1910', 'Huité', '19', 'municipio'),
	(331, '1911', 'San Jorge', '19', 'municipio'),
	(332, '2001', 'Chiquimula', '20', 'municipio'),
	(333, '2002', 'San José La Arada', '20', 'municipio'),
	(334, '2003', 'San Juan Ermita', '20', 'municipio'),
	(335, '2004', 'Jocotán', '20', 'municipio'),
	(336, '2005', 'Camotán', '20', 'municipio'),
	(337, '2006', 'Olopa', '20', 'municipio'),
	(338, '2007', 'Esquipulas', '20', 'municipio'),
	(339, '2008', 'Concepción Las Minas', '20', 'municipio'),
	(340, '2009', 'Quetzaltepeque', '20', 'municipio'),
	(341, '2010', 'San Jacinto', '20', 'municipio'),
	(342, '2011', 'Ipala', '20', 'municipio'),
	(343, '2101', 'Jalapa', '21', 'municipio'),
	(344, '2102', 'San Pedro Pinula', '21', 'municipio'),
	(345, '2103', 'San Luis Jilotepeque', '21', 'municipio'),
	(346, '2104', 'San Manuel Chaparrón', '21', 'municipio'),
	(347, '2105', 'San Carlos Alzatate', '21', 'municipio'),
	(348, '2106', 'Monjas', '21', 'municipio'),
	(349, '2107', 'Mataquescuintla', '21', 'municipio'),
	(350, '2201', 'Jutiapa', '22', 'municipio'),
	(351, '2202', 'El Progreso', '22', 'municipio'),
	(352, '2203', 'Santa Catarina Mita', '22', 'municipio'),
	(353, '2204', 'Agua Blanca', '22', 'municipio'),
	(354, '2205', 'Asunción Mita', '22', 'municipio'),
	(355, '2206', 'Yupiltepeque', '22', 'municipio'),
	(356, '2207', 'Atescatempa', '22', 'municipio'),
	(357, '2208', 'Jerez', '22', 'municipio'),
	(358, '2209', 'El Adelanto', '22', 'municipio'),
	(359, '2210', 'Zapotitlán', '22', 'municipio'),
	(360, '2211', 'Comapa', '22', 'municipio'),
	(361, '2212', 'Jalpatagua', '22', 'municipio'),
	(362, '2213', 'Conguaco', '22', 'municipio'),
	(363, '2214', 'Moyuta', '22', 'municipio'),
	(364, '2215', 'Pasaco', '22', 'municipio'),
	(365, '2216', 'San José Acatempa', '22', 'municipio'),
	(366, '2217', 'Quesada', '22', 'municipio'),
	(367, 'SUB001', 'INCAP', ' ', 'subreceptor'),
	(368, 'SUB002', 'subreceptor 01', ' ', 'subreceptor'),
	(369, 'SUB003', 'subreceptor 02', ' ', 'subreceptor'),
	(370, 'SUB004', 'subreceptor 03', ' ', 'subreceptor'),
	(371, 'SUB005', 'subreceptor 04', ' ', 'subreceptor'),
	(372, 'R001', 'Administrador', ' ', 'rol'),
	(373, 'R002', 'Coordinador', ' ', 'rol'),
	(374, 'R003', 'Supervisor', ' ', 'rol'),
	(375, 'R004', 'Promotor', ' ', 'rol'),
	(376, 'R005', 'Invitado', ' ', 'rol'),
	(377, 'M01', 'Enero', '1', 'mes'),
	(378, 'M02', 'Febrero', '1', 'mes'),
	(379, 'M03', 'Marzo', '1', 'mes'),
	(380, 'M04', 'Abril', '1', 'mes'),
	(381, 'M05', 'Mayo', '1', 'mes'),
	(382, 'M06', 'Junio', '1', 'mes'),
	(383, 'M07', 'Julio', '2', 'mes'),
	(384, 'M08', 'Agosto', '2', 'mes'),
	(385, 'M09', 'Septiembre', '2', 'mes'),
	(386, 'M10', 'Octubre', '2', 'mes'),
	(387, 'M11', 'Noviembre', '2', 'mes'),
	(388, 'M12', 'Diciembre', '2', 'mes');
/*!40000 ALTER TABLE `catalogo` ENABLE KEYS */;

-- Volcando estructura para tabla poam.cobertura
CREATE TABLE IF NOT EXISTS `cobertura` (
  `idCobertura` int(11) NOT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `departamento` int(11) NOT NULL,
  `municipio` int(11) NOT NULL,
  `porcentaje` float DEFAULT NULL,
  PRIMARY KEY (`idCobertura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.cobertura: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cobertura` DISABLE KEYS */;
INSERT INTO `cobertura` (`idCobertura`, `subreceptor_id`, `departamento`, `municipio`, `porcentaje`) VALUES
	(1, 1, 3, 54, 0.03),
	(2, 1, 12, 210, 0.03),
	(3, 1, 10, 176, 0.02),
	(4, 2, 9, 140, 0.03),
	(5, 2, 11, 192, 0.03),
	(6, 2, 5, 86, 0.02),
	(7, 3, 5, 86, 0);
/*!40000 ALTER TABLE `cobertura` ENABLE KEYS */;

-- Volcando estructura para tabla poam.insumo
CREATE TABLE IF NOT EXISTS `insumo` (
  `idInsumo` int(11) NOT NULL,
  `poa_id` int(11) NOT NULL,
  `cnatural` float DEFAULT NULL,
  `csabor` float DEFAULT NULL,
  `cfemenino` float DEFAULT NULL,
  `lubricante` float DEFAULT NULL,
  `pruebaVIH` float DEFAULT NULL,
  `autoPrueba` float DEFAULT NULL,
  `reactivoE` float DEFAULT NULL,
  `sifilis` float DEFAULT NULL,
  PRIMARY KEY (`idInsumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.insumo: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `insumo` DISABLE KEYS */;
INSERT INTO `insumo` (`idInsumo`, `poa_id`, `cnatural`, `csabor`, `cfemenino`, `lubricante`, `pruebaVIH`, `autoPrueba`, `reactivoE`, `sifilis`) VALUES
	(1, 1, 3315.2, 0, 0, 3315.2, 51.8, 17.2666, 2.072, 69.0666),
	(2, 2, 266646, 0, 0, 266646, 4166.34, 1388.78, 166.654, 5555.12),
	(3, 3, 266661, 0, 0, 266661, 4166.58, 1388.86, 166.663, 5555.44),
	(4, 4, 8016, 0, 0, 8016, 125.25, 41.75, 5.01, 167),
	(5, 5, 59819800, 0, 0, 59819800, 934684, 311561, 24924.9, 1246240),
	(6, 6, 6000, 0, 0, 6000, 93.75, 31.25, 3.75, 125),
	(7, 7, 66507.2, 0, 0, 66507.2, 1039.18, 346.392, 27.7113, 1385.57),
	(8, 8, 1890, 315, 157.5, 31.5, 0, 23.625, 0, 31.5);
/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;

-- Volcando estructura para procedimiento poam.listarDepartamento
DELIMITER //
CREATE PROCEDURE `listarDepartamento`(
	IN sub		VARCHAR(32))
BEGIN
SELECT t2.idCatalogo as id, t2.nombre as departamento FROM cobertura t1
    LEFT JOIN catalogo t2 ON t2.idCatalogo = t1.departamento
    LEFT JOIN catalogo t3 ON t3.idCatalogo = t1.municipio
    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id 
    WHERE t1.subreceptor_id = sub GROUP BY t1.departamento;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.listarMunicipio
DELIMITER //
CREATE PROCEDURE `listarMunicipio`(
	IN sub		VARCHAR(32),
    IN dep		VARCHAR(32))
BEGIN
SELECT t3.idCatalogo as id, t3.nombre as municipio FROM cobertura t1
    LEFT JOIN catalogo t2 ON t2.idCatalogo = t1.departamento
    LEFT JOIN catalogo t3 ON t3.idCatalogo = t1.municipio
    LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id 
	WHERE t2.idCatalogo = dep AND t1.subreceptor_id = sub;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.login
DELIMITER //
CREATE PROCEDURE `login`(
	IN users		VARCHAR(32),
    IN contra		VARCHAR(32))
BEGIN
	SELECT * FROM usuario WHERE usuario = users AND pass = SHA(contra) AND estado = 1;
END//
DELIMITER ;

-- Volcando estructura para tabla poam.permiso
CREATE TABLE IF NOT EXISTS `permiso` (
  `idPermiso` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `editar` tinyint(4) DEFAULT '0',
  `agregar` tinyint(4) DEFAULT '0',
  `usuario` tinyint(4) DEFAULT '0',
  `poa` tinyint(4) DEFAULT '0',
  `pom` tinyint(4) DEFAULT '0',
  `subreceptor` tinyint(4) DEFAULT '0',
  `promotor` tinyint(4) DEFAULT '0',
  `catalogo` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.permiso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;

-- Volcando estructura para tabla poam.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL,
  `documento` tinyint(4) DEFAULT NULL,
  `numero` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.persona: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`idPersona`, `documento`, `numero`, `nombre`, `apellido`, `direccion`, `telefono`, `email`) VALUES
	(1, 1, '1234123451234', 'Faustino', 'Lopez Ramos', '37 Calle B 19-16 zona 12, Ciudad de Guatemala', '12345678', 'faustinolopezramos@gmail.com');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla poam.poa
CREATE TABLE IF NOT EXISTS `poa` (
  `idPoa` int(11) NOT NULL,
  `Usuario_id` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `mes` int(11) NOT NULL,
  `departamento` int(11) NOT NULL,
  `municipio` int(11) NOT NULL,
  `nuevo` float DEFAULT NULL,
  `recurrente` float DEFAULT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `semestre` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.poa: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `poa` DISABLE KEYS */;
INSERT INTO `poa` (`idPoa`, `Usuario_id`, `anio`, `mes`, `departamento`, `municipio`, `nuevo`, `recurrente`, `subreceptor_id`, `observacion`, `semestre`, `estado`) VALUES
	(1, 1, 2021, 383, 3, 54, 49.3333, 19.7333, 1, 'Sin observaciones', 2, 1),
	(2, 1, 2021, 377, 3, 54, 1234.12, 4321, 1, 'Sin observaciones', 1, 1),
	(3, 1, 2021, 377, 12, 210, 1234.32, 4321.12, 1, '', 1, 1),
	(4, 1, 2021, 385, 3, 54, 78, 89, 1, '', 2, 1),
	(5, 1, 2021, 377, 10, 176, 789456, 456789, 1, '', 1, 1),
	(6, 1, 2021, 384, 9, 140, 100, 25, 2, '', 2, 1),
	(7, 1, 2021, 383, 5, 86, 989.667, 395.9, 2, '', 2, 1),
	(8, 1, 2021, 383, 5, 86, 22.5, 9, 3, '', 2, 1);
/*!40000 ALTER TABLE `poa` ENABLE KEYS */;

-- Volcando estructura para tabla poam.pom
CREATE TABLE IF NOT EXISTS `pom` (
  `idPom` int(11) NOT NULL,
  `poa_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `lugar` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promotor_id` int(11) NOT NULL,
  `supervisado` tinyint(4) DEFAULT NULL,
  `supervisor` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pNuevo` float DEFAULT NULL,
  `pRecurrente` float DEFAULT NULL,
  `cnatural` float DEFAULT NULL,
  `csabor` float DEFAULT NULL,
  `cfeminino` float DEFAULT NULL,
  `lubricante` float DEFAULT NULL,
  `pruebaVIH` float DEFAULT NULL,
  `autoprueba` float DEFAULT NULL,
  `reactivo` float DEFAULT NULL,
  `sifilis` float DEFAULT NULL,
  PRIMARY KEY (`idPom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.pom: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pom` DISABLE KEYS */;
/*!40000 ALTER TABLE `pom` ENABLE KEYS */;

-- Volcando estructura para tabla poam.promotor
CREATE TABLE IF NOT EXISTS `promotor` (
  `idPromotor` int(11) NOT NULL,
  `codigo` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPromotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.promotor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `promotor` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotor` ENABLE KEYS */;

-- Volcando estructura para procedimiento poam.semestre
DELIMITER //
CREATE PROCEDURE `semestre`(
	IN subreceptor	INT,
    IN semestre		INT)
BEGIN
	SELECT DISTINCT t1.idPoa, t5.nombre as mes, t4.nombre as municipio, t1.nuevo, t1.recurrente, (t1.nuevo + t1.recurrente) AS total, 
    t1.observacion, t2.cnatural, t2.csabor, t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoPrueba, t2.reactivoE, t2.sifilis FROM poa t1 
	LEFT JOIN insumo t2 ON t2.poa_id = t1.idPoa
	LEFT JOIN catalogo t3 ON t3.idCatalogo = t1.departamento
	LEFT JOIN catalogo t4 ON t4.idCatalogo = t1.municipio 
	LEFT JOIN catalogo t5 ON t5.idCatalogo = t1.mes
	WHERE t1.subreceptor_id = subreceptor AND t1.anio = YEAR(NOW()) AND t1.semestre = semestre AND estado = 1;
END//
DELIMITER ;

-- Volcando estructura para tabla poam.subreceptor
CREATE TABLE IF NOT EXISTS `subreceptor` (
  `idSubreceptor` int(11) NOT NULL,
  `codigo` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enatural` int(11) DEFAULT NULL,
  `esabor` int(11) DEFAULT NULL,
  `efemenino` int(11) DEFAULT NULL,
  `elubricante` int(11) DEFAULT NULL,
  `ppvih` float DEFAULT NULL,
  `pautoprueba` float DEFAULT NULL,
  PRIMARY KEY (`idSubreceptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.subreceptor: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `subreceptor` DISABLE KEYS */;
INSERT INTO `subreceptor` (`idSubreceptor`, `codigo`, `nombre`, `enatural`, `esabor`, `efemenino`, `elubricante`, `ppvih`, `pautoprueba`) VALUES
	(1, 'INCAP', 'Instituto de Nutricion de Centro America y Panama', 48, 0, 0, 48, 0.75, 0.25),
	(2, 'HSH2', 'APEVIHS IDEI', 48, 0, 0, 48, 0.75, 0.25),
	(3, 'MTS05', 'OMES', 60, 10, 5, 1, 0, 0.75);
/*!40000 ALTER TABLE `subreceptor` ENABLE KEYS */;

-- Volcando estructura para tabla poam.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `usuario` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` longtext COLLATE utf8_unicode_ci,
  `subreceptor_id` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `persona_id`, `rol`, `usuario`, `pass`, `subreceptor_id`, `estado`) VALUES
	(1, 1, 372, 'fl20211', '014f43501bd9cc573256be4caf14026d65a4b39c', 1, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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
	INSERT INTO catalogo VALUES(codigo, nombre, descripcion, categoria);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarCobertura
DELIMITER //
CREATE PROCEDURE `agregarCobertura`(
	IN subreceptor	INT,
    IN departamento	VARCHAR(24),
    IN municipio 	VARCHAR(24),
	IN region		INT,
    IN nuevo		FLOAT,
    IN recurrente	FLOAT,
	IN porcentaje	FLOAT)
BEGIN
	DECLARE id INT DEFAULT 0;
    DECLARE idCob INT DEFAULT (SELECT COUNT(idCobertura) FROM cobertura);
    IF (idCob <= 0) THEN SET id := 1;
    ELSE SET id := idCob + 1;
    END IF;
	INSERT INTO cobertura VALUES(id, subreceptor, departamento, municipio, region, nuevo, recurrente, porcentaje);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPoa
DELIMITER //
CREATE PROCEDURE `agregarPoa`(
	IN usuario		INT,
	IN mes			VARCHAR(24),
	IN departamento VARCHAR(24),
	IN municipio	VARCHAR(24),
	IN nuevo		FLOAT,
	IN recurrente	FLOAT,
	IN subreceptor	INT,
    IN observacion	TEXT,
    IN periodo		INT,
	IN cnatural 	FLOAT,
	IN csabor		FLOAT,
    IN cfemenino	FLOAT,
	IN lubricante	FLOAT,
	IN pruebaVIH	FLOAT,
	IN autoPrueba	FLOAT,
	IN reactivoE	FLOAT,
	IN sifilis		FLOAT )
BEGIN
	INSERT INTO poa VALUES(IdPoa,usuario,year(now()),mes,departamento,municipio,nuevo,recurrente,subreceptor,observacion,periodo,1);
    
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfemenino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPom
DELIMITER //
CREATE PROCEDURE `agregarPom`(
	IN poa			INT,
    IN estado		VARCHAR(16),
    IN usuario		INT,
    IN descripcion	TEXT,
    IN periodo		INT,
	IN mes			VARCHAR(16),
	IN municipio	VARCHAR(16),
    IN fecha		DATE,
    IN inicio		TIME,
    IN fin 			TIME,
    IN lugar		TEXT,
    IN promotor		INT,
	IN nuevo		FLOAT,
	IN recurrente	FLOAT,
	IN cnatural 	FLOAT,
	IN csabor		FLOAT,
    IN cfeminino	FLOAT,
	IN lubricante	FLOAT,
	IN pruebaVIH	FLOAT,
	IN autoPrueba	FLOAT,
	IN reactivoE	FLOAT,
	IN sifilis		FLOAT,
    IN observacion	TEXT)
BEGIN
	DECLARE id INT DEFAULT 0;
    DECLARE idE INT DEFAULT 0;
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPom) FROM pom);
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
	IF(idP <=0) THEN SET id := 1;
	ELSE SET id := idP + 1;
    END IF;
	INSERT INTO pom VALUES(id,periodo,mes,municipio,fecha,inicio,fin,lugar,promotor,nuevo,recurrente,cnatural,csabor,cfeminino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis,observacion);
	IF(idEs <=0) THEN SET idE := 1;
	ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, poa, id, estado, usuario, NOW(), descripcion);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPromotor
DELIMITER //
CREATE PROCEDURE `agregarPromotor`(
	IN documento	BOOLEAN,
	IN numero		VARCHAR(16),
	IN pnombre 		VARCHAR(32),
    IN snombre 		VARCHAR(32),
	IN papellido	VARCHAR(32),
    IN sapellido	VARCHAR(32),
	IN direccion	VARCHAR(100),
	IN telefono		VARCHAR(16),
	IN email		VARCHAR(100),
    IN codigo		VARCHAR(32),
	IN cobertura	INT,
    IN usuario		VARCHAR(32),
    IN rol			VARCHAR(16)
    )
BEGIN
    DECLARE IdPersona INT DEFAULT 0;
	DECLARE IdPromotor INT DEFAULT 0;
    DECLARE IdUsuario INT DEFAULT 0;
	DECLARE idPer INT DEFAULT	(SELECT COUNT(idPersona) FROM persona);
	DECLARE idPro INT DEFAULT (SELECT COUNT(idPromotor) FROM promotor);
	DECLARE idU INT DEFAULT (SELECT COUNT(idUsuario) FROM usuario);
    DECLARE subreceptor INT DEFAULT (SELECT subreceptor_id FROM cobertura WHERE idCobertura= cobertura);
	IF(idPer <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idPer + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona, documento, numero, concat(pnombre,' ',snombre), concat(papellido,' ',sapellido), direccion, telefono, email);
	IF(idPro <=0) THEN SET IdPromotor := 1;
	ELSE SET IdPromotor := idPro + 1;
    END IF;
	INSERT INTO promotor VALUES(IdPromotor, codigo, IdPersona, cobertura, 1);
    IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
    INSERT INTO usuario VALUES(IdUsuario, IdPersona, rol, usuario, SHA('Usuario01'), subreceptor, 1);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarResumen
DELIMITER //
CREATE PROCEDURE `agregarResumen`(
	IN cobertura	INT,
    IN periodo		INT,
    IN meses	 	INT,
    IN nuevo		FLOAT,
    IN recurrente	FLOAT )
BEGIN
	DECLARE id INT DEFAULT 0;
    DECLARE idRe INT DEFAULT (SELECT COUNT(idResumen) FROM resumen);
    IF (idRe <= 0) THEN SET id := 1;
    ELSE SET id := idRe + 1;
    END IF;
	INSERT INTO resumen VALUES(id, cobertura, periodo, meses, nuevo, recurrente, 1);
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarSubreceptor
DELIMITER //
CREATE PROCEDURE `agregarSubreceptor`(
	IN codigo 		VARCHAR(24),
    IN nombre 		VARCHAR(100),
    IN cnatural 	INT,
    IN csabor 		INT,
    IN cfemenino	INT,
    IN lubricante	INT,
    IN pruebavih 	FLOAT,
    IN autoprueba	FLOAT )
BEGIN
	DECLARE id INT DEFAULT 0;
	DECLARE idSub INT DEFAULT (SELECT COUNT(idSubreceptor) FROM subreceptor);
	IF(idSub <= 0) THEN SET id := 1;
	ELSE  SET id := idSub + 1;
	END IF;
	INSERT INTO subreceptor VALUES(id, codigo, nombre, cnatural, csabor, cfemenino, lubricante, pruebavih, autoprueba);
	END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarUsuario
DELIMITER //
CREATE PROCEDURE `agregarUsuario`(
	IN documento 	BOOLEAN,
	IN numero		VARCHAR(16),
	IN pnombre 		VARCHAR(32),
    IN snombre		VARCHAR(32),
	IN papellido	VARCHAR(32),
    IN sapellido	VARCHAR(32),
	IN direccion	VARCHAR(100),
	IN telefono		VARCHAR(16),
	IN email		VARCHAR(100),
    IN rol			VARCHAR(24),
    IN sub			INT,
    IN editar		BOOLEAN,
	IN agregar		BOOLEAN,
    IN usuario		BOOLEAN,
    IN poa 			BOOLEAN,
    IN pom 			BOOLEAN,
    IN subreceptor	BOOLEAN,
    IN promotor		BOOLEAN,
    IN catalogo		BOOLEAN,
    IN resumen 		BOOLEAN,
    IN cobertura	BOOLEAN
    )
BEGIN
	DECLARE IdPersona INT DEFAULT 0;
    DECLARE IdUsuario INT DEFAULT 0;
    DECLARE ID INT DEFAULT 0;
	DECLARE idP INT DEFAULT (SELECT COUNT(idPersona) FROM persona);
	DECLARE idU INT DEFAULT (SELECT COUNT(idUsuario) FROM usuario);
    DECLARE idPer INT DEFAULT (SELECT COUNT(idPermiso) FROM permiso);
	IF(idP <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idP + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona, documento, numero, CONCAT(pnombre,' ',snombre), CONCAT(papellido,' ',sapellido), direccion, telefono, email);
	IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
	INSERT INTO usuario VALUES(IdUsuario, IdPersona, rol, lower(concat(left(pnombre,1),papellido,left(sapellido,1))), SHA('Usuario01'), sub, 1);
    IF(idPer <= 0) THEN SET ID :=1;
    ELSE SET ID = id + 1;
    END IF;
    INSERT INTO permiso VALUES(ID, IdUsuario, editar, agregar, usuario, poa, pom, subreceptor, promotor, catalogo, resumen, cobertura);
END//
DELIMITER ;

-- Volcando estructura para tabla poam.catalogo
CREATE TABLE IF NOT EXISTS `catalogo` (
  `codigo` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `categoria` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.catalogo: ~411 rows (aproximadamente)
/*!40000 ALTER TABLE `catalogo` DISABLE KEYS */;
INSERT INTO `catalogo` (`codigo`, `nombre`, `descripcion`, `categoria`) VALUES
	('1', 'Guatemala', ' ', 'departamento'),
	('10', 'Suchitepéquez', ' ', 'departamento'),
	('1001', 'Mazatenango', '10', 'municipio'),
	('1002', 'Cuyotenango', '10', 'municipio'),
	('1003', 'San Francisco Zapotitlán', '10', 'municipio'),
	('1004', 'San Bernardino', '10', 'municipio'),
	('1005', 'San José el Idolo', '10', 'municipio'),
	('1006', 'Santo Domingo Suchitepéquez', '10', 'municipio'),
	('1007', 'San Lorenzo', '10', 'municipio'),
	('1008', 'Samayac', '10', 'municipio'),
	('1009', 'San Pablo Jocopilas', '10', 'municipio'),
	('101', 'Guatemala', '1', 'municipio'),
	('1010', 'San Antonio Suchitepéquez', '10', 'municipio'),
	('1011', 'San Miguel Panán', '10', 'municipio'),
	('1012', 'San Gabriel', '10', 'municipio'),
	('1013', 'Chicacao', '10', 'municipio'),
	('1014', 'Patulul', '10', 'municipio'),
	('1015', 'Santa Bárbara', '10', 'municipio'),
	('1016', 'San Juan Bautista', '10', 'municipio'),
	('1017', 'Santo Tomás la Unión', '10', 'municipio'),
	('1018', 'Zunilito', '10', 'municipio'),
	('1019', 'Pueblo Nuevo', '10', 'municipio'),
	('102', 'Santa Catarina Pinula', '1', 'municipio'),
	('1020', 'Río Bravo', '10', 'municipio'),
	('1021', 'San José La Máquina', '10', 'municipio'),
	('103', 'San José Pinula', '1', 'municipio'),
	('104', 'San José del Golfo', '1', 'municipio'),
	('105', 'Palencia', '1', 'municipio'),
	('106', 'Chinautla', '1', 'municipio'),
	('107', 'San Pedro Ayampuc', '1', 'municipio'),
	('108', 'Mixco', '1', 'municipio'),
	('109', 'San Pedro Sacatepéquez', '1', 'municipio'),
	('11', 'Retalhuleu', ' ', 'departamento'),
	('110', 'San Juan Sacatepéquez', '1', 'municipio'),
	('1101', 'Retalhuleu', '11', 'municipio'),
	('1102', 'San Sebastián', '11', 'municipio'),
	('1103', 'Santa Cruz Muluá', '11', 'municipio'),
	('1104', 'San Martín Zapotitlán', '11', 'municipio'),
	('1105', 'San Felipe', '11', 'municipio'),
	('1106', 'San Andrés Villa Seca', '11', 'municipio'),
	('1107', 'Champerico', '11', 'municipio'),
	('1108', 'Nuevo San Carlos', '11', 'municipio'),
	('1109', 'El Asintal', '11', 'municipio'),
	('111', 'San Raymundo', '1', 'municipio'),
	('112', 'Chuarrancho', '1', 'municipio'),
	('113', 'Fraijanes', '1', 'municipio'),
	('114', 'Amatitlán', '1', 'municipio'),
	('115', 'Villa Nueva', '1', 'municipio'),
	('116', 'Villa Canales', '1', 'municipio'),
	('117', 'Petapa', '1', 'municipio'),
	('12', 'San Marcos', ' ', 'departamento'),
	('1201', 'San Marcos', '12', 'municipio'),
	('1202', 'San Pedro Sacatepéquez', '12', 'municipio'),
	('1203', 'San Antonio Sacatepéquez', '12', 'municipio'),
	('1204', 'Comitancillo', '12', 'municipio'),
	('1205', 'San Miguel Ixtahuacán', '12', 'municipio'),
	('1206', 'Concepción Tutuapa', '12', 'municipio'),
	('1207', 'Tacaná', '12', 'municipio'),
	('1208', 'Sibinal', '12', 'municipio'),
	('1209', 'Tajumulco', '12', 'municipio'),
	('1210', 'Tejutla', '12', 'municipio'),
	('1211', 'San Rafael Pié de la Cuesta', '12', 'municipio'),
	('1212', 'Nuevo Progreso', '12', 'municipio'),
	('1213', 'El Tumbador', '12', 'municipio'),
	('1214', 'El Rodeo', '12', 'municipio'),
	('1215', 'Malacatán', '12', 'municipio'),
	('1216', 'Catarina', '12', 'municipio'),
	('1217', 'Ayutla', '12', 'municipio'),
	('1218', 'Ocós', '12', 'municipio'),
	('1219', 'San Pablo', '12', 'municipio'),
	('1220', 'El Quetzal', '12', 'municipio'),
	('1221', 'La Reforma', '12', 'municipio'),
	('1222', 'Pajapita', '12', 'municipio'),
	('1223', 'Ixchiguán', '12', 'municipio'),
	('1224', 'San José Ojetenán', '12', 'municipio'),
	('1225', 'San Cristóbal Cucho', '12', 'municipio'),
	('1226', 'Sipacapa', '12', 'municipio'),
	('1227', 'Esquipulas Palo Gordo', '12', 'municipio'),
	('1228', 'Río Blanco', '12', 'municipio'),
	('1229', 'San Lorenzo', '12', 'municipio'),
	('1230', 'La Blanca', '12', 'municipio'),
	('13', 'Huehuetenango', ' ', 'departamento'),
	('1301', 'Huehuetenango', '13', 'municipio'),
	('1302', 'Chiantla', '13', 'municipio'),
	('1303', 'Malacatancito', '13', 'municipio'),
	('1304', 'Cuilco', '13', 'municipio'),
	('1305', 'Nentón', '13', 'municipio'),
	('1306', 'San Pedro Necta', '13', 'municipio'),
	('1307', 'Jacaltenango', '13', 'municipio'),
	('1308', 'Soloma', '13', 'municipio'),
	('1309', 'Ixtahuacán', '13', 'municipio'),
	('1310', 'Santa Bárbara', '13', 'municipio'),
	('1311', 'La Libertad', '13', 'municipio'),
	('1312', 'La Democracia', '13', 'municipio'),
	('1313', 'San Miguel Acatán', '13', 'municipio'),
	('1314', 'San Rafael la Independencia', '13', 'municipio'),
	('1315', 'Todos Santos Cuchumatán', '13', 'municipio'),
	('1316', 'San Juan Atitán', '13', 'municipio'),
	('1317', 'Santa Eulalia', '13', 'municipio'),
	('1318', 'San Mateo Ixtatán', '13', 'municipio'),
	('1319', 'Colotenango', '13', 'municipio'),
	('1320', 'San Sebastián Huehuetenango', '13', 'municipio'),
	('1321', 'Tectitán', '13', 'municipio'),
	('1322', 'Concepción Huista', '13', 'municipio'),
	('1323', 'San Juan Ixcoy', '13', 'municipio'),
	('1324', 'San Antonio Huista', '13', 'municipio'),
	('1325', 'San Sebastián Coatán', '13', 'municipio'),
	('1326', 'Barillas', '13', 'municipio'),
	('1327', 'Aguacatán', '13', 'municipio'),
	('1328', 'San Rafael Petzal', '13', 'municipio'),
	('1329', 'San Gaspar Ixchil', '13', 'municipio'),
	('1330', 'Santiago Chimaltenango', '13', 'municipio'),
	('1331', 'Santa Ana Huista', '13', 'municipio'),
	('1332', 'Unión Cantinil', '13', 'municipio'),
	('14', 'Quiché', ' ', 'departamento'),
	('1401', 'Santa Cruz del Quiché', '14', 'municipio'),
	('1402', 'Chiché', '14', 'municipio'),
	('1403', 'Chinique', '14', 'municipio'),
	('1404', 'Zacualpa', '14', 'municipio'),
	('1405', 'Chajul', '14', 'municipio'),
	('1406', 'Chichicastenango', '14', 'municipio'),
	('1407', 'Patzité', '14', 'municipio'),
	('1408', 'San Antonio Ilotenango', '14', 'municipio'),
	('1409', 'San Pedro Jocopilas', '14', 'municipio'),
	('1410', 'Cunén', '14', 'municipio'),
	('1411', 'San Juan Cotzal', '14', 'municipio'),
	('1412', 'Joyabaj', '14', 'municipio'),
	('1413', 'Nebaj', '14', 'municipio'),
	('1414', 'San Andrés Sajcabajá', '14', 'municipio'),
	('1415', 'Uspantán', '14', 'municipio'),
	('1416', 'Sacapulas', '14', 'municipio'),
	('1417', 'San Bartolomé Jocotenango', '14', 'municipio'),
	('1418', 'Canillá', '14', 'municipio'),
	('1419', 'Chicamán', '14', 'municipio'),
	('1420', 'Ixcán', '14', 'municipio'),
	('1421', 'Pachalum', '14', 'municipio'),
	('15', 'Baja Verapaz', ' ', 'departamento'),
	('1501', 'Salamá', '15', 'municipio'),
	('1502', 'San Miguel Chicaj', '15', 'municipio'),
	('1503', 'Rabinal', '15', 'municipio'),
	('1504', 'Cubulco', '15', 'municipio'),
	('1505', 'Granados', '15', 'municipio'),
	('1506', 'El Chol', '15', 'municipio'),
	('1507', 'San Jerónimo', '15', 'municipio'),
	('1508', 'Purulhá', '15', 'municipio'),
	('16', 'Alta Verapaz', ' ', 'departamento'),
	('1601', 'Cobán', '16', 'municipio'),
	('1602', 'Santa Cruz Verapaz', '16', 'municipio'),
	('1603', 'San Cristóbal Verapaz', '16', 'municipio'),
	('1604', 'Tactic', '16', 'municipio'),
	('1605', 'Tamahú', '16', 'municipio'),
	('1606', 'Tucurú', '16', 'municipio'),
	('1607', 'Panzós', '16', 'municipio'),
	('1608', 'Senahú', '16', 'municipio'),
	('1609', 'San Pedro Carchá', '16', 'municipio'),
	('1610', 'San Juan Chamelco', '16', 'municipio'),
	('1611', 'Lanquín', '16', 'municipio'),
	('1612', 'Cahabón', '16', 'municipio'),
	('1613', 'Chisec', '16', 'municipio'),
	('1614', 'Chahal', '16', 'municipio'),
	('1615', 'Fray Bartolomé de las Casas', '16', 'municipio'),
	('1616', 'Santa Catalina la Tinta', '16', 'municipio'),
	('1617', 'Raxruhá', '16', 'municipio'),
	('17', 'Petén', ' ', 'departamento'),
	('1701', 'Flores', '17', 'municipio'),
	('1702', 'San José', '17', 'municipio'),
	('1703', 'San Benito', '17', 'municipio'),
	('1704', 'San Andrés', '17', 'municipio'),
	('1705', 'La Libertad', '17', 'municipio'),
	('1706', 'San Francisco', '17', 'municipio'),
	('1707', 'Santa Ana', '17', 'municipio'),
	('1708', 'Dolores', '17', 'municipio'),
	('1709', 'San Luis', '17', 'municipio'),
	('1710', 'Sayaxché', '17', 'municipio'),
	('1711', 'Melchor de Mencos', '17', 'municipio'),
	('1712', 'Poptún', '17', 'municipio'),
	('1713', 'Las Cruces', '17', 'municipio'),
	('1714', 'El Chal', '17', 'municipio'),
	('18', 'Izabal', ' ', 'departamento'),
	('1801', 'Puerto Barrios', '18', 'municipio'),
	('1802', 'Livingston', '18', 'municipio'),
	('1803', 'El Estor', '18', 'municipio'),
	('1804', 'Morales', '18', 'municipio'),
	('1805', 'Los Amates', '18', 'municipio'),
	('19', 'Zacapa', ' ', 'departamento'),
	('1901', 'Zacapa', '19', 'municipio'),
	('1902', 'Estanzuela', '19', 'municipio'),
	('1903', 'Río Hondo', '19', 'municipio'),
	('1904', 'Gualán', '19', 'municipio'),
	('1905', 'Teculután', '19', 'municipio'),
	('1906', 'Usumatlán', '19', 'municipio'),
	('1907', 'Cabañas', '19', 'municipio'),
	('1908', 'San Diego', '19', 'municipio'),
	('1909', 'La Unión', '19', 'municipio'),
	('1910', 'Huité', '19', 'municipio'),
	('1911', 'San Jorge', '19', 'municipio'),
	('2', 'El Progreso', ' ', 'departamento'),
	('20', 'Chiquimula', ' ', 'departamento'),
	('2001', 'Chiquimula', '20', 'municipio'),
	('2002', 'San José La Arada', '20', 'municipio'),
	('2003', 'San Juan Ermita', '20', 'municipio'),
	('2004', 'Jocotán', '20', 'municipio'),
	('2005', 'Camotán', '20', 'municipio'),
	('2006', 'Olopa', '20', 'municipio'),
	('2007', 'Esquipulas', '20', 'municipio'),
	('2008', 'Concepción Las Minas', '20', 'municipio'),
	('2009', 'Quetzaltepeque', '20', 'municipio'),
	('201', 'Guastatoya', '2', 'municipio'),
	('2010', 'San Jacinto', '20', 'municipio'),
	('2011', 'Ipala', '20', 'municipio'),
	('202', 'Morazán', '2', 'municipio'),
	('203', 'San Agustín Acasaguastlán', '2', 'municipio'),
	('204', 'San Cristóbal Acasaguastlán', '2', 'municipio'),
	('205', 'El Jícaro', '2', 'municipio'),
	('206', 'Sansare', '2', 'municipio'),
	('207', 'Sanarate', '2', 'municipio'),
	('208', 'San Antonio la Paz', '2', 'municipio'),
	('21', 'Jalapa', ' ', 'departamento'),
	('2101', 'Jalapa', '21', 'municipio'),
	('2102', 'San Pedro Pinula', '21', 'municipio'),
	('2103', 'San Luis Jilotepeque', '21', 'municipio'),
	('2104', 'San Manuel Chaparrón', '21', 'municipio'),
	('2105', 'San Carlos Alzatate', '21', 'municipio'),
	('2106', 'Monjas', '21', 'municipio'),
	('2107', 'Mataquescuintla', '21', 'municipio'),
	('22', 'Jutiapa', ' ', 'departamento'),
	('2201', 'Jutiapa', '22', 'municipio'),
	('2202', 'El Progreso', '22', 'municipio'),
	('2203', 'Santa Catarina Mita', '22', 'municipio'),
	('2204', 'Agua Blanca', '22', 'municipio'),
	('2205', 'Asunción Mita', '22', 'municipio'),
	('2206', 'Yupiltepeque', '22', 'municipio'),
	('2207', 'Atescatempa', '22', 'municipio'),
	('2208', 'Jerez', '22', 'municipio'),
	('2209', 'El Adelanto', '22', 'municipio'),
	('2210', 'Zapotitlán', '22', 'municipio'),
	('2211', 'Comapa', '22', 'municipio'),
	('2212', 'Jalpatagua', '22', 'municipio'),
	('2213', 'Conguaco', '22', 'municipio'),
	('2214', 'Moyuta', '22', 'municipio'),
	('2215', 'Pasaco', '22', 'municipio'),
	('2216', 'San José Acatempa', '22', 'municipio'),
	('2217', 'Quesada', '22', 'municipio'),
	('3', 'Sacatepéquez', ' ', 'departamento'),
	('301', 'Antigua Guatemala', '3', 'municipio'),
	('302', 'Jocotenango', '3', 'municipio'),
	('303', 'Pastores', '3', 'municipio'),
	('304', 'Sumpango', '3', 'municipio'),
	('305', 'Santo Domingo Xenacoj', '3', 'municipio'),
	('306', 'Santiago Sacatepéquez', '3', 'municipio'),
	('307', 'San Bartolomé Milpas Altas', '3', 'municipio'),
	('308', 'San Lucas Sacatepéquez', '3', 'municipio'),
	('309', 'Santa Lucía Milpas Altas', '3', 'municipio'),
	('310', 'Magdalena Milpas Altas', '3', 'municipio'),
	('311', 'Santa María de Jesús', '3', 'municipio'),
	('312', 'Ciudad Vieja', '3', 'municipio'),
	('313', 'San Miguel Dueñas', '3', 'municipio'),
	('314', 'Alotenango', '3', 'municipio'),
	('315', 'San Antonio Aguas Calientes', '3', 'municipio'),
	('316', 'Santa Catarina Barahona', '3', 'municipio'),
	('4', 'Chimaltenango', ' ', 'departamento'),
	('401', 'Chimaltenango', '4', 'municipio'),
	('402', 'San José Poaquil', '4', 'municipio'),
	('403', 'San Martín Jilotepeque', '4', 'municipio'),
	('404', 'Comalapa', '4', 'municipio'),
	('405', 'Santa Apolonia', '4', 'municipio'),
	('406', 'Tecpán Guatemala', '4', 'municipio'),
	('407', 'Patzún', '4', 'municipio'),
	('408', 'Pochuta', '4', 'municipio'),
	('409', 'Patzicía', '4', 'municipio'),
	('410', 'Santa Cruz Balanyá', '4', 'municipio'),
	('411', 'Acatenango', '4', 'municipio'),
	('412', 'Yepocapa', '4', 'municipio'),
	('413', 'San Andrés Itzapa', '4', 'municipio'),
	('414', 'Parramos', '4', 'municipio'),
	('415', 'Zaragoza', '4', 'municipio'),
	('416', 'El Tejar', '4', 'municipio'),
	('5', 'Escuintla', ' ', 'departamento'),
	('501', 'Escuintla', '5', 'municipio'),
	('502', 'Santa Lucía Cotzumalguapa', '5', 'municipio'),
	('503', 'La Democracia', '5', 'municipio'),
	('504', 'Siquinalá', '5', 'municipio'),
	('505', 'Masagua', '5', 'municipio'),
	('506', 'Tiquisate', '5', 'municipio'),
	('507', 'La Gomera', '5', 'municipio'),
	('508', 'Guanagazapa', '5', 'municipio'),
	('509', 'San José', '5', 'municipio'),
	('510', 'Iztapa', '5', 'municipio'),
	('511', 'Palín', '5', 'municipio'),
	('512', 'San Vicente Pacaya', '5', 'municipio'),
	('513', 'Nueva Concepción', '5', 'municipio'),
	('6', 'Santa Rosa', ' ', 'departamento'),
	('601', 'Cuilapa', '6', 'municipio'),
	('602', 'Barberena', '6', 'municipio'),
	('603', 'Santa Rosa de Lima', '6', 'municipio'),
	('604', 'Casillas', '6', 'municipio'),
	('605', 'San Rafael las Flores', '6', 'municipio'),
	('606', 'Oratorio', '6', 'municipio'),
	('607', 'San Juan Tecuaco', '6', 'municipio'),
	('608', 'Chiquimulilla', '6', 'municipio'),
	('609', 'Taxisco', '6', 'municipio'),
	('610', 'Santa María Ixhuatán', '6', 'municipio'),
	('611', 'Guazacapán', '6', 'municipio'),
	('612', 'Santa Cruz Naranjo', '6', 'municipio'),
	('613', 'Pueblo Nuevo Viñas', '6', 'municipio'),
	('614', 'Nueva Santa Rosa', '6', 'municipio'),
	('7', 'Sololá', ' ', 'departamento'),
	('701', 'Sololá', '7', 'municipio'),
	('702', 'San José Chacayá', '7', 'municipio'),
	('703', 'Santa María Visitación', '7', 'municipio'),
	('704', 'Santa Lucía Utatlán', '7', 'municipio'),
	('705', 'Nahualá', '7', 'municipio'),
	('706', 'Santa Catarina Ixtahuacán', '7', 'municipio'),
	('707', 'Santa Clara la Laguna', '7', 'municipio'),
	('708', 'Concepción', '7', 'municipio'),
	('709', 'San Andrés Semetabaj', '7', 'municipio'),
	('710', 'Panajachel', '7', 'municipio'),
	('711', 'Santa Catarina Palopó', '7', 'municipio'),
	('712', 'San Antonio Palopó', '7', 'municipio'),
	('713', 'San Lucas Tolimán', '7', 'municipio'),
	('714', 'Santa Cruz la Laguna', '7', 'municipio'),
	('715', 'San Pablo la Laguna', '7', 'municipio'),
	('716', 'San Marcos la Laguna', '7', 'municipio'),
	('717', 'San Juan la Laguna', '7', 'municipio'),
	('718', 'San Pedro la Laguna', '7', 'municipio'),
	('719', 'Santiago Atitlán', '7', 'municipio'),
	('8', 'Totonicapán', ' ', 'departamento'),
	('801', 'Totonicapán', '8', 'municipio'),
	('802', 'San Cristóbal Totonicapán', '8', 'municipio'),
	('803', 'San Francisco el Alto', '8', 'municipio'),
	('804', 'San Andrés Xecul', '8', 'municipio'),
	('805', 'Momostenango', '8', 'municipio'),
	('806', 'Santa María Chiquimula', '8', 'municipio'),
	('807', 'Santa Lucía la Reforma', '8', 'municipio'),
	('808', 'San Bartolo', '8', 'municipio'),
	('9', 'Quetzaltenango', ' ', 'departamento'),
	('901', 'Quetzaltenango', '9', 'municipio'),
	('902', 'Salcajá', '9', 'municipio'),
	('903', 'Olintepeque', '9', 'municipio'),
	('904', 'San Carlos Sija', '9', 'municipio'),
	('905', 'Sibilia', '9', 'municipio'),
	('906', 'Cabricán', '9', 'municipio'),
	('907', 'Cajolá', '9', 'municipio'),
	('908', 'San Miguel Siguilá', '9', 'municipio'),
	('909', 'Ostuncalco', '9', 'municipio'),
	('910', 'San Mateo', '9', 'municipio'),
	('911', 'Concepción Chiquirichapa', '9', 'municipio'),
	('912', 'San Martín Sacatepéquez', '9', 'municipio'),
	('913', 'Almolonga', '9', 'municipio'),
	('914', 'Cantel', '9', 'municipio'),
	('915', 'Huitán', '9', 'municipio'),
	('916', 'Zunil', '9', 'municipio'),
	('917', 'Colomba', '9', 'municipio'),
	('918', 'San Francisco la Unión', '9', 'municipio'),
	('919', 'El Palmar', '9', 'municipio'),
	('920', 'Coatepeque', '9', 'municipio'),
	('921', 'Génova', '9', 'municipio'),
	('922', 'Flores Costa Cuca', '9', 'municipio'),
	('923', 'La Esperanza', '9', 'municipio'),
	('924', 'Palestina de los Altos', '9', 'municipio'),
	('ES01', 'Creado', 'El POM a sido creado', 'estado'),
	('ES02', 'Revision', 'El POM esta revisado', 'estado'),
	('ES03', 'Autorizado', 'El POM ha sido autorizado con exito', 'estado'),
	('MP11', 'Enero', '1', 'mes'),
	('MP12', 'Febrero', '1', 'mes'),
	('MP13', 'Marzo', '1', 'mes'),
	('MP14', 'Abril', '1', 'mes'),
	('MP15', 'Mayo', '1', 'mes'),
	('MP16', 'Junio', '1', 'mes'),
	('MP21', 'Julio', '2', 'mes'),
	('MP22', 'Agosto', '2', 'mes'),
	('MP23', 'Septiembre', '2', 'mes'),
	('MP24', 'Octubre', '2', 'mes'),
	('MP25', 'Noviembre', '2', 'mes'),
	('MP26', 'Diciembre', '2', 'mes'),
	('MP31', 'Enero', '3', 'mes'),
	('MP32', 'Febrero', '3', 'mes'),
	('MP33', 'Marzo', '3', 'mes'),
	('MP34', 'Abril', '3', 'mes'),
	('MP35', 'Mayo', '3', 'mes'),
	('MP36', 'Junio', '3', 'mes'),
	('MP41', 'Julio', '4', 'mes'),
	('MP42', 'Agosto', '4', 'mes'),
	('MP43', 'Septiembre', '4', 'mes'),
	('MP44', 'Octubre', '4', 'mes'),
	('MP45', 'Noviembre', '4', 'mes'),
	('MP46', 'Diciembre', '4', 'mes'),
	('MP51', 'Enero', '5', 'mes'),
	('MP52', 'Febrero', '5', 'mes'),
	('MP53', 'Marzo', '5', 'mes'),
	('MP54', 'Abril', '5', 'mes'),
	('MP55', 'Mayo', '5', 'mes'),
	('MP56', 'Junio', '5', 'mes'),
	('MP61', 'Julio', '6', 'mes'),
	('MP62', 'Agosto', '6', 'mes'),
	('MP63', 'Septiembre', '6', 'mes'),
	('MP64', 'Octubre', '6', 'mes'),
	('MP65', 'Noviembre', '6', 'mes'),
	('MP66', 'Diciembre', '6', 'mes'),
	('R001', 'Administrador', ' ', 'rol'),
	('R002', 'Especilista Programatica', ' ', 'rol'),
	('R003', 'Enlace Programatica', ' ', 'rol'),
	('R004', 'Monitorea y Evaluacion de RP', ' ', 'rol'),
	('R005', 'Monitoreo y Evaluacion de SR', ' ', 'rol'),
	('R006', 'Supervisor', ' ', 'rol'),
	('R007', 'Promotor', ' ', 'rol'),
	('R008', 'Financiero', ' ', 'rol');
/*!40000 ALTER TABLE `catalogo` ENABLE KEYS */;

-- Volcando estructura para tabla poam.cobertura
CREATE TABLE IF NOT EXISTS `cobertura` (
  `idCobertura` int(11) NOT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `departamento` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `region` int(11) DEFAULT NULL,
  `nuevo` float DEFAULT NULL,
  `recurrente` float DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  PRIMARY KEY (`idCobertura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.cobertura: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cobertura` DISABLE KEYS */;
INSERT INTO `cobertura` (`idCobertura`, `subreceptor_id`, `departamento`, `municipio`, `region`, `nuevo`, `recurrente`, `porcentaje`) VALUES
	(1, 1, '1', '101', 1, 78, 56, 0.25);
/*!40000 ALTER TABLE `cobertura` ENABLE KEYS */;

-- Volcando estructura para procedimiento poam.editarCatalogo
DELIMITER //
CREATE PROCEDURE `editarCatalogo`(
	IN ecodigo		VARCHAR(24),
    IN enombre		VARCHAR(100),
    IN edescripcion	TEXT,
    IN ecategoria 	VARCHAR(32) )
BEGIN
	UPDATE  catalogo SET codigo = ecodigo, nombre = enombre, descripcion = edescripcion, categoria = ecategoria WHERE codigo = ecodigo;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarCobertura
DELIMITER //
CREATE PROCEDURE `editarCobertura`(
	IN id			INT,
	IN esubreceptor	INT,
    IN edepartamento VARCHAR(24),
    IN emunicipio 	VARCHAR(24),
	IN eregion		INT,
    IN enuevo		FLOAT,
    IN erecurrente	FLOAT,
	IN eporcentaje	FLOAT)
BEGIN
	UPDATE cobertura SET subreceptor_id=esubreceptor, departamento=edepartamento, municipio=emunicipio, region=eregion, nuevo=enuevo, recurrente=erecurrente, porcentaje=eporcentaje WHERE idCobertura = id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarInsumo
DELIMITER //
CREATE PROCEDURE `editarInsumo`(
	IN id			INT,
	IN ecnatural 	FLOAT,
	IN ecsabor		FLOAT,
    IN ecfemenino	FLOAT,
	IN elubricante	FLOAT,
	IN epruebaVIH	FLOAT,
	IN eautoPrueba	FLOAT,
	IN ereactivoE	FLOAT,
	IN esifilis		FLOAT )
BEGIN
	UPDATE poa SET cnatural=ecnatural, csabor=ecsabor, cfemenino=ecfemenino, lubricante=elubricante, pruebaVIH=epruebaVIH, autoPrueba=eautoPrueba, reactivoE=ereactivoE, sifilis=esifilis WHERE idInsumo=id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarPersona
DELIMITER //
CREATE PROCEDURE `editarPersona`(
	IN id			INT,
	IN edocumento 	BOOLEAN,
	IN enumero		VARCHAR(16),
	IN enombre 		VARCHAR(50),
	IN eapellido	VARCHAR(50),
	IN edireccion	VARCHAR(100),
	IN etelefono	VARCHAR(16),
	IN eemail		VARCHAR(100) )
BEGIN
	UPDATE persona SET documento=edocumento, numero=enumero, nombre=enombre, apellido=eapellido, direccion=edireccion, telefono=etelefono, email=eemail WHERE idPersona=id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarPoa
DELIMITER //
CREATE PROCEDURE `editarPoa`(
	IN id			INT,
	IN eusuario		INT,
	IN emes			VARCHAR(24),
	IN edepartamento VARCHAR(24),
	IN emunicipio	VARCHAR(24),
	IN enuevo		FLOAT,
	IN erecurrente	FLOAT,
	IN esubreceptor	INT,
    IN eobservacion	TEXT,
    IN eperiodo		INT)
BEGIN
	UPDATE poa SET mes=emes,departamento=edepartamento,municipio=emunicipio,nuevo=enuevo,recurrente=erecurrente,subreceptor=esubreceptor,observacion=eobservacion,periodo=eperiodo,estado=estado WHERE idPoa=id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarPom
DELIMITER //
CREATE PROCEDURE `editarPom`(
	IN id			INT,
    IN eperiodo		INT,
	IN emes			VARCHAR(16),
	IN emunicipio	VARCHAR(16),
    IN efecha		DATE,
    IN einicio		TIME,
    IN efin 		TIME,
    IN elugar		TEXT,
    IN epromotor	INT,
	IN enuevo		FLOAT,
	IN erecurrente	FLOAT,
	IN ecnatural 	FLOAT,
	IN ecsabor		FLOAT,
    IN ecfemenino	FLOAT,
	IN elubricante	FLOAT,
	IN epruebaVIH	FLOAT,
	IN eautoPrueba	FLOAT,
	IN ereactivo	FLOAT,
	IN esifilis		FLOAT,
    IN eobservacion	TEXT)
BEGIN
	UPDATE pom SET periodo=eperiodo, mes=emes, municipio=emunicipio, fecha=efecha, horaInicio=einicio, horaFin=efin, lugar=elugar, promotor_id=epromotor, nuevo=enuevo, recurrente=erecurrente, cnatural=ecnatural, 
    csabor=esabor, cfemenino=ecfemenino, lubricante=elubricante, pruebaVIH=epruebaVIH, autoPrueba=eautoPrueba, reactivo=ereactivo, sifilis=esifilis, observacion=eobservacion WHERE idPom =id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarPromotor
DELIMITER //
CREATE PROCEDURE `editarPromotor`(
	IN id			INT,
    IN ecodigo		VARCHAR(32),
	IN ecobertura	INT,
	IN eestado		BOOLEAN
    )
BEGIN
	UPDATE promotor SET codigo = ecodigo, cobertura_id=ecobertura, estado=eestado WHERE idPromotor = id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarResumen
DELIMITER //
CREATE PROCEDURE `editarResumen`(
	IN id			INT,
	IN ecobertura	INT,
    IN eperiodo		INT,
    IN emeses	 	INT,
    IN enuevo		FLOAT,
    IN erecurrente	FLOAT,
    IN eestado		BOOLEAN)
BEGIN
	UPDATE resumen SET cobertura_id=ecobertura, periodo=eperiodo, meses=emeses, nuevo=enuevo, recurrente=erecurrente, estado=eestado WHERE idResumen=id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarrResumen
DELIMITER //
CREATE PROCEDURE `editarrResumen`(
	IN id			INT,
	IN ecobertura	INT,
    IN eperiodo		INT,
    IN emeses	 	INT,
    IN enuevo		FLOAT,
    IN erecurrente	FLOAT,
    IN eestado		BOOLEAN)
BEGIN
	UPDATE resumen SET cobertura_id=ecobertura, periodo=eperiodo, meses=emeses, nuevo=enuevo, recurrente=erecurrente, estado=eestado WHERE idResumen=id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarSubreceptor
DELIMITER //
CREATE PROCEDURE `editarSubreceptor`(
	IN id			INT,
	IN ecodigo 		VARCHAR(24),
    IN enombre 		VARCHAR(100),
    IN ecnatural 	INT,
    IN ecsabor 		INT,
    IN ecfemenino	INT,
    IN lubricante	INT,
    IN epruebavih 	FLOAT,
    IN eautoprueba	FLOAT )
BEGIN
	UPDATE subreceptor SET codigo=ecodigo, nombre=enombre, enatural=ecnatural, esabor=ecsabor, efemenino=ecfemenino, elubricante=lubricante, ppvih=epruebavih, pautoprueba=eautoprueba WHERE idSubreceptor = id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.editarUsuario
DELIMITER //
CREATE PROCEDURE `editarUsuario`(
	IN id			INT,
    IN erol			VARCHAR(24),
    IN eusuario		VARCHAR(32),
    IN epass		VARCHAR(32),
	IN esubreceptor	INT,
    IN eestado		BOOLEAN
    )
BEGIN
	UPDATE usuario SET rol=erol, usuario=eusuario, pass=SHA(epass), subreceptor=esubreceptor, estado=eestado WHERE idUsuario = id;
END//
DELIMITER ;

-- Volcando estructura para tabla poam.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `idEstado` int(11) NOT NULL,
  `poa_id` int(11) NOT NULL,
  `pom_id` int(11) NOT NULL,
  `estado` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.estado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` (`idEstado`, `poa_id`, `pom_id`, `estado`, `usuario_id`, `fecha`, `descripcion`) VALUES
	(1, 1, 1, 'ES01', 1, '2021-08-03 11:15:11', 'El Plan Operativo Mensual ha sido creado con exito');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;

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

-- Volcando datos para la tabla poam.insumo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `insumo` DISABLE KEYS */;
INSERT INTO `insumo` (`idInsumo`, `poa_id`, `cnatural`, `csabor`, `cfemenino`, `lubricante`, `pruebaVIH`, `autoPrueba`, `reactivoE`, `sifilis`) VALUES
	(1, 1, 3908.33, 2791.66, 3350, 2791.66, 16.75, 5.5833, 5.5833, 22.3333);
/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;

-- Volcando estructura para procedimiento poam.login
DELIMITER //
CREATE PROCEDURE `login`(
	IN users		VARCHAR(32),
    IN contra		VARCHAR(32))
BEGIN
	SELECT * FROM usuario WHERE usuario = users AND pass = SHA(contra) AND estado = 1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.modificarCatalogo
DELIMITER //
CREATE PROCEDURE `modificarCatalogo`(
	IN codigo		VARCHAR(24),
    IN nombre		VARCHAR(100),
    IN descripcion	TEXT,
    IN categoria 	VARCHAR(32) )
BEGIN
	INSERT INTO catalogo VALUES(codigo, nombre, descripcion, categoria);
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
  `resumen` tinyint(4) DEFAULT NULL,
  `cobertura` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.permiso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`idPermiso`, `usuario_id`, `editar`, `agregar`, `usuario`, `poa`, `pom`, `subreceptor`, `promotor`, `catalogo`, `resumen`, `cobertura`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
	(2, 2, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0);
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

-- Volcando datos para la tabla poam.persona: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`idPersona`, `documento`, `numero`, `nombre`, `apellido`, `direccion`, `telefono`, `email`) VALUES
	(1, 1, '123498742589', 'Faustino ', 'Lopez Ramos', '37 Calle B 19-16 zona 12, ciudad de Guatemala', '77889911', 'correodeprueba@gmail.com'),
	(2, 1, '7894561231234', 'Fabiola ', 'Lorenzana Ramirez', '48 calle 19-6 zona 11, ciudad de Guatemala', '77889963', 'correodeprueba@gmail.com'),
	(3, 1, '7894561231234', 'Fabiola ', 'Lorenzana Ramirez', '48 calle 19-6 zona 11, ciudad de Guatemala', '77889963', 'correodeprueba@gmail.com');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla poam.poa
CREATE TABLE IF NOT EXISTS `poa` (
  `idPoa` int(11) NOT NULL,
  `Usuario_id` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `mes` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `nuevo` float DEFAULT NULL,
  `recurrente` float DEFAULT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `periodo` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.poa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `poa` DISABLE KEYS */;
INSERT INTO `poa` (`idPoa`, `Usuario_id`, `anio`, `mes`, `departamento`, `municipio`, `nuevo`, `recurrente`, `subreceptor_id`, `observacion`, `periodo`, `estado`) VALUES
	(1, 1, 2021, 'MP11', '1', '101', 13, 9.3333, 1, 'Lorem ipsum text dummy', 1, 1);
/*!40000 ALTER TABLE `poa` ENABLE KEYS */;

-- Volcando estructura para tabla poam.pom
CREATE TABLE IF NOT EXISTS `pom` (
  `idPom` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `mes` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipio` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `lugar` text COLLATE utf8_unicode_ci,
  `promotor_id` int(11) NOT NULL,
  `pNuevo` float DEFAULT NULL,
  `pRecurrente` float DEFAULT NULL,
  `cnatural` float DEFAULT NULL,
  `csabor` float DEFAULT NULL,
  `cfemenino` float DEFAULT NULL,
  `lubricante` float DEFAULT NULL,
  `pruebaVIH` float DEFAULT NULL,
  `autoprueba` float DEFAULT NULL,
  `reactivo` float DEFAULT NULL,
  `sifilis` float DEFAULT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idPom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.pom: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pom` DISABLE KEYS */;
INSERT INTO `pom` (`idPom`, `periodo`, `mes`, `municipio`, `fecha`, `horaInicio`, `horaFin`, `lugar`, `promotor_id`, `pNuevo`, `pRecurrente`, `cnatural`, `csabor`, `cfemenino`, `lubricante`, `pruebaVIH`, `autoprueba`, `reactivo`, `sifilis`, `observacion`) VALUES
	(1, 1, 'MP11', '101', '2021-08-04', '08:00:00', '12:00:00', 'Lorem ipsum dolor sit amet.', 1, 13, 9.3334, 3908.34, 2791.68, 3350.01, 2791.68, 16.7501, 5.5834, 5.5834, 22.3334, 'Lorem ipsum text dummy');
/*!40000 ALTER TABLE `pom` ENABLE KEYS */;

-- Volcando estructura para tabla poam.promotor
CREATE TABLE IF NOT EXISTS `promotor` (
  `idPromotor` int(11) NOT NULL,
  `codigo` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `cobertura_id` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPromotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.promotor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `promotor` DISABLE KEYS */;
INSERT INTO `promotor` (`idPromotor`, `codigo`, `persona_id`, `cobertura_id`, `estado`) VALUES
	(1, 'C001', 3, 1, 1);
/*!40000 ALTER TABLE `promotor` ENABLE KEYS */;

-- Volcando estructura para tabla poam.resumen
CREATE TABLE IF NOT EXISTS `resumen` (
  `idResumen` int(11) NOT NULL,
  `cobertura_id` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `meses` int(11) DEFAULT NULL,
  `nuevo` float DEFAULT NULL,
  `recurrente` float DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idResumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.resumen: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `resumen` DISABLE KEYS */;
INSERT INTO `resumen` (`idResumen`, `cobertura_id`, `periodo`, `meses`, `nuevo`, `recurrente`, `estado`) VALUES
	(1, 1, 1, 6, 13, 9.3333, 1);
/*!40000 ALTER TABLE `resumen` ENABLE KEYS */;

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

-- Volcando datos para la tabla poam.subreceptor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `subreceptor` DISABLE KEYS */;
INSERT INTO `subreceptor` (`idSubreceptor`, `codigo`, `nombre`, `enatural`, `esabor`, `efemenino`, `elubricante`, `ppvih`, `pautoprueba`) VALUES
	(1, 'INCAP', 'Instituto de Nutricion de Centro America y Panama', 175, 125, 150, 125, 0.75, 0.25);
/*!40000 ALTER TABLE `subreceptor` ENABLE KEYS */;

-- Volcando estructura para tabla poam.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `rol` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` longtext COLLATE utf8_unicode_ci,
  `subreceptor_id` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla poam.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `persona_id`, `rol`, `usuario`, `pass`, `subreceptor_id`, `estado`) VALUES
	(1, 1, 'R001', 'flopezr', '014f43501bd9cc573256be4caf14026d65a4b39c', 1, 1),
	(2, 2, 'R001', 'florenzanar', '014f43501bd9cc573256be4caf14026d65a4b39c', 1, 1),
	(3, 3, 'R007', 'florenzana', '014f43501bd9cc573256be4caf14026d65a4b39c', 1, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

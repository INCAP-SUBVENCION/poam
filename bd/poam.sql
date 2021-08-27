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
	DECLARE IdPoa INT DEFAULT 0;
    DECLARE IdInsumo INT DEFAULT 0;
    DECLARE idE INT DEFAULT 0;
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPoa) FROM poa);
	DECLARE idI INT DEFAULT (SELECT COUNT(idInsumo) FROM insumo);
	IF(idP <= 0) THEN SET IdPoa := 1;
	ELSE SET IdPoa := idP + 1;
    END IF;
	INSERT INTO poa VALUES(IdPoa, year(now()), mes, departamento, municipio, nuevo, recurrente, subreceptor, observacion, periodo, 'ES01');
	IF(idI <=0) THEN SET IdInsumo := 1;
	ELSE SET IdInsumo := idI + 1;
    END IF;
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfemenino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
    IF (idEs <= 0) THEN SET idE := 1;
    ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, usuario, idPoa, NULL, 'ES01', 'El Plan Operativo Anual se ha CREADO con exito', now());
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPom
DELIMITER //
CREATE PROCEDURE `agregarPom`(
	IN poa			INT,
    IN usuario		INT,
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
    IN observacion	TEXT,
    IN subreceptor	INT)
BEGIN
    DECLARE id INT DEFAULT 0;
    DECLARE idE INT DEFAULT 0;
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPom) FROM pom);
	IF(idP <=0) THEN SET id := 1;
	ELSE SET id := idP + 1;
    END IF;
	INSERT INTO pom VALUES(id,periodo,mes,municipio,fecha,inicio,fin,lugar,promotor,nuevo,recurrente,cnatural,csabor,cfeminino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis,observacion,poa,'ES01', subreceptor);
	IF (idEs <= 0) THEN SET idE := 1;
    ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, usuario, NULL, id, 'ES01', 'El Plan Operativo Mensual se ha CREADO con exito', now());
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.agregarPromotor
DELIMITER //
CREATE PROCEDURE `agregarPromotor`(
	IN subreceptor	INT,
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
    IN usuario		VARCHAR(32),
    IN rol			VARCHAR(16),
    IN dias			INT
    )
BEGIN
    DECLARE IdPersona INT DEFAULT 0;
	DECLARE IdPromotor INT DEFAULT 0;
    DECLARE IdUsuario INT DEFAULT 0;
	DECLARE idPer INT DEFAULT	(SELECT COUNT(idPersona) FROM persona);
	DECLARE idPro INT DEFAULT (SELECT COUNT(idPromotor) FROM promotor);
	DECLARE idU INT DEFAULT (SELECT COUNT(idUsuario) FROM usuario);
	IF(idPer <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idPer + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona, documento, numero, concat(pnombre,' ',snombre), concat(papellido,' ',sapellido), direccion, telefono, email);
	IF(idPro <=0) THEN SET IdPromotor := 1;
	ELSE SET IdPromotor := idPro + 1;
    END IF;
	INSERT INTO promotor VALUES(IdPromotor, codigo, IdPersona, dias, 1);
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
    IN sub			INT
    )
BEGIN
	DECLARE IdPersona INT DEFAULT 0;
    DECLARE IdUsuario INT DEFAULT 0;
	DECLARE idP INT DEFAULT (SELECT COUNT(idPersona) FROM persona);
	DECLARE idU INT DEFAULT (SELECT COUNT(idUsuario) FROM usuario);
	IF(idP <= 0) THEN SET IdPersona := 1;
	ELSE SET IdPersona := idP + 1;
    END IF;
	INSERT INTO persona VALUES(IdPersona, documento, numero, CONCAT(pnombre,' ',snombre), CONCAT(papellido,' ',sapellido), direccion, telefono, email);
	IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
	INSERT INTO usuario VALUES(IdUsuario, IdPersona, rol, lower(concat(left(pnombre,1),papellido,left(sapellido,1))), SHA('Usuario01'), sub, 1);
END//
DELIMITER ;

-- Volcando estructura para tabla poam.asignacion
CREATE TABLE IF NOT EXISTS `asignacion` (
  `idAsignacion` int(11) NOT NULL AUTO_INCREMENT,
  `promotor_id` int(11) NOT NULL,
  `cobertura_id` int(11) NOT NULL,
  PRIMARY KEY (`idAsignacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento poam.cambiarEstadoPoa
DELIMITER //
CREATE PROCEDURE `cambiarEstadoPoa`(
	IN usuario		INT,
    IN id_poa 		INT,
    IN estados		VARCHAR(24),
    IN descripcion	TEXT )
BEGIN
	DECLARE idE INT DEFAULT 0;
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
    IF (idEs <= 0) THEN SET idE := 1;
    ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, usuario, id_poa, NULL, estados, descripcion, now());
    UPDATE poa SET estado = estados WHERE idPoa = id_poa;
END//
DELIMITER ;

-- Volcando estructura para procedimiento poam.cambiarEstadoPom
DELIMITER //
CREATE PROCEDURE `cambiarEstadoPom`(
	IN usuario		INT,
    IN id_pom 		INT,
    IN estados		VARCHAR(24),
    IN descripcion	TEXT )
BEGIN
	DECLARE idE INT DEFAULT 0;
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
    IF (idEs <= 0) THEN SET idE := 1;
    ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, usuario, NULL, id_pom, estados, descripcion, now());
    UPDATE pom SET estado = estados WHERE idPom = id_pom;
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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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
  `usuario_id` int(11) NOT NULL,
  `poa_id` int(11) DEFAULT NULL,
  `pom_id` int(11) DEFAULT NULL,
  `estado` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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
  `poa` tinyint(4) DEFAULT NULL,
  `pom` tinyint(4) DEFAULT NULL,
  `rol_idRol` int(11) NOT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla poam.poa
CREATE TABLE IF NOT EXISTS `poa` (
  `idPoa` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `mes` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `nuevo` float DEFAULT NULL,
  `recurrente` float DEFAULT NULL,
  `subreceptor_id` int(11) NOT NULL,
  `observacion` text COLLATE utf8_unicode_ci,
  `periodo` int(11) DEFAULT NULL,
  `estado` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

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
  `poa_id` int(11) NOT NULL,
  `estado` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subreceptor_id` int(11) NOT NULL,
  PRIMARY KEY (`idPom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla poam.promotor
CREATE TABLE IF NOT EXISTS `promotor` (
  `idPromotor` int(11) NOT NULL,
  `codigo` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `dias` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPromotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

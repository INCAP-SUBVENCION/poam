-- Dumping structure for procedure poam.agregarCatalogo
DROP PROCEDURE IF EXISTS `agregarCatalogo`;
DELIMITER //
CREATE PROCEDURE `agregarCatalogo`(
	IN codigo		VARCHAR(16),
    IN nombre		VARCHAR(64),
    IN descripcion	TEXT,
    IN categoria 	VARCHAR(32) )
BEGIN
	INSERT INTO catalogo VALUES(codigo,nombre,descripcion,categoria);
END//
DELIMITER ;

-- Dumping structure for procedure poam.agregarPoa
DROP PROCEDURE IF EXISTS `agregarPoa`;
DELIMITER //
CREATE PROCEDURE `agregarPoa`(
	IN usuario		INT,
    IN anio			VARCHAR(4),
	IN mes			INT,
	IN departamento INT,
	IN municipio	INT,
	IN nuevo		INT,
	IN recurrente	INT,
	IN subreceptor	INT,
    IN observacion	TEXT,
	IN cnatural 	INT,
	IN csabor		INT,
    IN cfemenino	INT,
	IN lubricante	INT,
	IN pruebaVIH	INT,
	IN autoPrueba	INT,
	IN reactivoE	INT,
	IN sifilis		INT )
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
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfemenino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
END//
DELIMITER ;

-- Dumping structure for procedure poam.agregarPom
DROP PROCEDURE IF EXISTS `agregarPom`;
DELIMITER //
CREATE PROCEDURE `agregarPom`(
	IN usuario		INT,
	IN departamento	INT,
	IN municipio	INT,
	IN nuevo		INT,
	IN recurrente	INT,
    IN observacion	TEXT,
	IN cnatural 	INT,
	IN csabor		INT,
    IN cfeminino	INT,
	IN lubricante	INT,
	IN pruebaVIH	INT,
	IN autoPrueba	INT,
	IN reactivoE	INT,
	IN sifilis		INT )
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

-- Dumping structure for procedure poam.agregarPromotor
DROP PROCEDURE IF EXISTS `agregarPromotor`;
DELIMITER //
CREATE PROCEDURE `agregarPromotor`(
	IN documento	BOOLEAN,
	IN numero		VARCHAR(16),
	IN nombre 		VARCHAR(32),
	IN apellido		VARCHAR(32),
	IN direccion	VARCHAR(64),
	IN telefono		VARCHAR(12),
	IN email		VARCHAR(64),
    IN codigo		INT,
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

-- Dumping structure for procedure poam.agregarSubreceptor
DROP PROCEDURE IF EXISTS `agregarSubreceptor`;
DELIMITER //
CREATE PROCEDURE `agregarSubreceptor`(
	IN codigo 		VARCHAR(16),
    IN nombre 		VARCHAR(32),
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

-- Dumping structure for procedure poam.agregarUsuario
DROP PROCEDURE IF EXISTS `agregarUsuario`;
DELIMITER //
CREATE PROCEDURE `agregarUsuario`(
	IN documento 	BOOLEAN,
	IN numero		VARCHAR(16),
	IN nombre 		VARCHAR(32),
	IN apellido		VARCHAR(32),
	IN direccion	VARCHAR(64),
	IN telefono		VARCHAR(12),
	IN email		VARCHAR(64),
    IN rol			INT,
	IN pass			LONGTEXT,
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
	INSERT INTO usuario VALUES(IdUsuario,IdPersona,rol,lower(concat(left(nombre,1),left(apellido,1),year(now()),IdPersona)),sha(pass),subreceptor,1);
END//
DELIMITER ;

-- Dumping structure for procedure poam.login
DROP PROCEDURE IF EXISTS `login`;
DELIMITER //
CREATE PROCEDURE `login`(
	IN users		VARCHAR(24),
    IN contra		VARCHAR(24))
BEGIN
	SELECT * FROM usuario WHERE usuario = users AND pass = SHA(contra);
END//
DELIMITER ;
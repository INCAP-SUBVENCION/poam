-- -----------------------------------------------------
-- Table `poam`.`persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`persona` ;

CREATE TABLE IF NOT EXISTS `poam`.`persona` (
  `idPersona` INT NOT NULL,
  `codigo` VARCHAR(16) NULL,
  `nombre` VARCHAR(50) NULL,
  `apellido` VARCHAR(50) NULL,
  `telefono` VARCHAR(12) NULL,
  `correo` VARCHAR(45) NULL,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`catalogo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`catalogo` ;

CREATE TABLE IF NOT EXISTS `poam`.`catalogo` (
  `codigo` VARCHAR(24) NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `categoria` VARCHAR(32) NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`subreceptor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`subreceptor` ;

CREATE TABLE IF NOT EXISTS `poam`.`subreceptor` (
  `idSubreceptor` INT NOT NULL,
  `codigo` VARCHAR(24) NULL,
  `nombre` VARCHAR(100) NULL,
  `enatural` INT NULL DEFAULT NULL,
  `esabor` INT NULL DEFAULT NULL,
  `efemenino` INT NULL DEFAULT NULL,
  `elubricante` INT NULL DEFAULT NULL,
  `ppvih` FLOAT NULL DEFAULT NULL,
  `pautoprueba` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`idSubreceptor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`usuario` ;

CREATE TABLE IF NOT EXISTS `poam`.`usuario` (
  `idUsuario` INT NOT NULL,
  `persona_id` INT NOT NULL,
  `rol` VARCHAR(24) NOT NULL,
  `usuario` VARCHAR(32) NULL,
  `pass` LONGTEXT NULL,
  `subreceptor_id` INT NOT NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`poa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`poa` ;

CREATE TABLE IF NOT EXISTS `poam`.`poa` (
  `idPoa` INT NOT NULL,
  `anio` INT NULL,
  `mes` VARCHAR(24) NOT NULL,
  `departamento` VARCHAR(24) NOT NULL,
  `municipio` VARCHAR(24) NOT NULL,
  `nuevo` FLOAT NULL,
  `recurrente` FLOAT NULL,
  `subreceptor_id` INT NOT NULL,
  `observacion` TEXT NULL,
  `periodo` INT NULL,
  `estado` VARCHAR(24) NULL,
  PRIMARY KEY (`idPoa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`promotor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`promotor` ;

CREATE TABLE IF NOT EXISTS `poam`.`promotor` (
  `idPromotor` INT NOT NULL,
  `persona_id` INT NOT NULL,
  `dias` VARCHAR(45) NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`idPromotor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`insumo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`insumo` ;

CREATE TABLE IF NOT EXISTS `poam`.`insumo` (
  `idInsumo` INT NOT NULL,
  `poa_id` INT NOT NULL,
  `cnatural` FLOAT NULL,
  `csabor` FLOAT NULL,
  `cfemenino` FLOAT NULL,
  `lubricante` FLOAT NULL,
  `pruebaVIH` FLOAT NULL,
  `autoPrueba` FLOAT NULL,
  `reactivoE` FLOAT NULL,
  `sifilis` FLOAT NULL,
  PRIMARY KEY (`idInsumo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`pom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`pom` ;

CREATE TABLE IF NOT EXISTS `poam`.`pom` (
  `idPom` INT NOT NULL,
  `periodo` INT NULL,
  `mes` VARCHAR(16) NULL,
  `municipio` VARCHAR(16) NULL,
  `fecha` DATE NULL,
  `horaInicio` TIME NULL,
  `horaFin` TIME NULL,
  `lugar` TEXT NULL,
  `promotor_id` INT NOT NULL,
  `pNuevo` FLOAT NULL,
  `pRecurrente` FLOAT NULL,
  `cnatural` FLOAT NULL,
  `csabor` FLOAT NULL,
  `cfemenino` FLOAT NULL,
  `lubricante` FLOAT NULL,
  `pruebaVIH` FLOAT NULL,
  `autoprueba` FLOAT NULL,
  `reactivo` FLOAT NULL,
  `sifilis` FLOAT NULL,
  `observacion` TEXT NULL,
  `poa_id` INT NOT NULL,
  `estado` VARCHAR(24) NULL,
  `subreceptor_id` INT NOT NULL,
  `movil` TINYINT NULL DEFAULT 0,
  `supervisado` TINYINT NULL,
  `supervisor` VARCHAR(50) NULL,
  PRIMARY KEY (`idPom`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`Permiso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`Permiso` ;

CREATE TABLE IF NOT EXISTS `poam`.`Permiso` (
  `idPermiso` INT NOT NULL,
  `poa` TINYINT NULL,
  `pom` TINYINT NULL,
  `rol_idRol` INT NOT NULL,
  PRIMARY KEY (`idPermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`cobertura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`cobertura` ;

CREATE TABLE IF NOT EXISTS `poam`.`cobertura` (
  `idCobertura` INT NOT NULL,
  `subreceptor_id` INT NOT NULL,
  `departamento` VARCHAR(24) NOT NULL,
  `municipio` VARCHAR(24) NOT NULL,
  `region` INT NULL,
  `nuevo` FLOAT NULL,
  `recurrente` FLOAT NULL,
  `porcentaje` FLOAT NULL,
  PRIMARY KEY (`idCobertura`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`estado` ;

CREATE TABLE IF NOT EXISTS `poam`.`estado` (
  `idEstado` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `poa_id` INT NULL,
  `pom_id` INT NULL,
  `estado` VARCHAR(24) NULL,
  `descripcion` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`idEstado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`resumen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`resumen` ;

CREATE TABLE IF NOT EXISTS `poam`.`resumen` (
  `idResumen` INT NOT NULL,
  `cobertura_id` INT NOT NULL,
  `periodo` INT NULL,
  `meses` INT NULL,
  `nuevo` FLOAT NULL,
  `recurrente` FLOAT NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`idResumen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`asignacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`asignacion` ;

CREATE TABLE IF NOT EXISTS `poam`.`asignacion` (
  `idAsignacion` INT NOT NULL AUTO_INCREMENT,
  `promotor_id` INT NOT NULL,
  `cobertura_id` INT NOT NULL,
  PRIMARY KEY (`idAsignacion`))
ENGINE = InnoDB;

USE `poam` ;

-- -----------------------------------------------------
-- procedure agregarPoa
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarPoa`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarPoa(
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
    INSERT INTO estado VALUES(idE, usuario, idPoa, NULL, 'ES11', 'El Plan Operativo Anual se ha CREADO con exito', now());
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarUsuario
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarUsuario`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarUsuario(
	IN codigo		VARCHAR(16),
	IN pnombre 		VARCHAR(32),
    IN snombre		VARCHAR(32),
	IN papellido	VARCHAR(32),
    IN sapellido	VARCHAR(32),
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
	INSERT INTO persona VALUES(IdPersona, codigo, CONCAT(pnombre,' ',snombre), CONCAT(papellido,' ',sapellido), telefono, email);
	IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
	INSERT INTO usuario VALUES(IdUsuario, IdPersona, rol, lower(concat(left(pnombre,1),papellido,left(sapellido,1))), SHA('Usuario01'), sub, 1);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarPromotor
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarPromotor`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarPromotor(
	IN subreceptor	INT,
	IN codigo		VARCHAR(16),
	IN pnombre 		VARCHAR(32),
    IN snombre 		VARCHAR(32),
	IN papellido	VARCHAR(32),
    IN sapellido	VARCHAR(32),
	IN telefono		VARCHAR(16),
	IN email		VARCHAR(100),
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
	INSERT INTO persona VALUES(IdPersona, codigo, concat(pnombre,' ',snombre), concat(papellido,' ',sapellido), telefono, email);
	IF(idPro <=0) THEN SET IdPromotor := 1;
	ELSE SET IdPromotor := idPro + 1;
    END IF;
	INSERT INTO promotor VALUES(IdPromotor, IdPersona, dias, 1);
    IF(idU <=0) THEN SET IdUsuario := 1;
	ELSE SET IdUsuario := idU + 1;
    END IF;
    INSERT INTO usuario VALUES(IdUsuario, IdPersona, rol, usuario, SHA('Usuario01'), subreceptor, 1);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarPom
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarPom`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarPom(
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
    IN subreceptor	INT,
    IN movil 		TINYINT,
    IN supervisado	TINYINT,
    IN supervisor	VARCHAR(50)
    )
BEGIN
    DECLARE id INT DEFAULT 0;
    DECLARE idE INT DEFAULT 0;
    DECLARE idEs INT DEFAULT (SELECT COUNT(idEstado) FROM estado);
	DECLARE idP INT DEFAULT	(SELECT COUNT(idPom) FROM pom);
	IF(idP <=0) THEN SET id := 1;
	ELSE SET id := idP + 1;
    END IF;
	INSERT INTO pom VALUES(id,periodo,mes,municipio,fecha,inicio,fin,lugar,promotor,nuevo,recurrente,cnatural,csabor,cfeminino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis,observacion,poa,'ES01',subreceptor,movil);
	IF (idEs <= 0) THEN SET idE := 1;
    ELSE SET idE := idEs + 1;
    END IF;
    INSERT INTO estado VALUES(idE, usuario, NULL, id, 'ES01', 'El Plan Operativo Mensual se ha CREADO con exito', now());
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarSubreceptor
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarSubreceptor`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarSubreceptor(
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
	END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure login
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`login`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE login(
	IN users		VARCHAR(32),
    IN contra		VARCHAR(32))
BEGIN
	SELECT * FROM usuario WHERE usuario = users AND pass = SHA(contra) AND estado = 1;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarCobertura
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarCobertura`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarCobertura(
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
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure semestre
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`semestre`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE semestre(
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
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarResumen
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarResumen`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE agregarResumen(
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
END$$

DELIMITER ;


-- -----------------------------------------------------
-- procedure editarPoa
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`editarPoa`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE editarPoa(
	IN epoa			INT,
    IN einsumo		INT,
	IN emes			VARCHAR(24),
	IN edepartamento VARCHAR(24),
	IN emunicipio	VARCHAR(24),
	IN enuevo		FLOAT,
	IN erecurrente	FLOAT,
	IN esubreceptor	INT,
    IN eobservacion	TEXT,
    IN eperiodo		INT,
	IN ecnatural 	FLOAT,
	IN ecsabor		FLOAT,
    IN ecfemenino	FLOAT,
	IN elubricante	FLOAT,
	IN epruebaVIH	FLOAT,
	IN eautoPrueba	FLOAT,
	IN ereactivoE	FLOAT,
	IN esifilis		FLOAT)
BEGIN
	UPDATE poa SET mes=emes,departamento=edepartamento,municipio=emunicipio,nuevo=enuevo,recurrente=erecurrente,observacion=eobservacion,periodo=eperiodo WHERE idPoa=epoa AND subreceptor_id=esubreceptor;
	UPDATE insumo SET cnatural=ecnatural,csabor=ecsabor,cfemenino=ecfemenino,lubricante=elubricante,pruebaVIH=epruebaVIH,autoPrueba=eautoPrueba,reactivoE=ereactivoE,sifilis=esifilis WHERE idInsumo = einsumo;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure cambiarEstadoPoa
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`cambiarEstadoPoa`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE cambiarEstadoPoa(
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
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure cambiarEstadoPom
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`cambiarEstadoPom`;

DELIMITER $$
USE `poam`$$
CREATE PROCEDURE cambiarEstadoPom(
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
END$$

DELIMITER ;

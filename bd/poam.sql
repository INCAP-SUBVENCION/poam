-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema poam
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `poam` ;

-- -----------------------------------------------------
-- Schema poam
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `poam` DEFAULT CHARACTER SET utf8 ;
USE `poam` ;

-- -----------------------------------------------------
-- Table `poam`.`persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`persona` ;

CREATE TABLE IF NOT EXISTS `poam`.`persona` (
  `idPersona` INT NOT NULL,
  `documento` TINYINT NULL,
  `numero` VARCHAR(16) NULL,
  `nombre` VARCHAR(50) NULL,
  `apellido` VARCHAR(50) NULL,
  `direccion` VARCHAR(100) NULL,
  `telefono` VARCHAR(16) NULL,
  `email` VARCHAR(100) NULL,
  PRIMARY KEY (`idPersona`))
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
-- Table `poam`.`catalogo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`catalogo` ;

CREATE TABLE IF NOT EXISTS `poam`.`catalogo` (
  `idCatalogo` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(24) NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `categoria` VARCHAR(32) NULL,
  PRIMARY KEY (`idCatalogo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`usuario` ;

CREATE TABLE IF NOT EXISTS `poam`.`usuario` (
  `idUsuario` INT NOT NULL,
  `Persona_id` INT NOT NULL,
  `rol` INT NOT NULL,
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
  `Usuario_id` INT NOT NULL,
  `anio` VARCHAR(4) NULL,
  `mes` INT NOT NULL,
  `departamento` INT NOT NULL,
  `municipio` INT NOT NULL,
  `nuevo` FLOAT NULL,
  `recurrente` FLOAT NULL,
  `subreceptor_id` INT NOT NULL,
  `observacion` TEXT NULL,
  PRIMARY KEY (`idPoa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`promotor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`promotor` ;

CREATE TABLE IF NOT EXISTS `poam`.`promotor` (
  `idPromotor` INT NOT NULL,
  `codigo` VARCHAR(24) NULL,
  `persona_id` INT NOT NULL,
  `subreceptor_id` INT NOT NULL,
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
  `cnatural` INT NULL DEFAULT 0,
  `csabor` INT NULL DEFAULT 0,
  `cfemenino` INT NULL DEFAULT 0,
  `lubricante` INT NULL DEFAULT 0,
  `pruebaVIH` FLOAT NULL DEFAULT 0.0,
  `autoPrueba` FLOAT NULL DEFAULT 0.0,
  `reactivoE` FLOAT NULL DEFAULT 0.0,
  `sifilis` FLOAT NULL DEFAULT 0.0,
  PRIMARY KEY (`idInsumo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poam`.`pom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`pom` ;

CREATE TABLE IF NOT EXISTS `poam`.`pom` (
  `idPom` INT NOT NULL,
  `poa_id` INT NOT NULL,
  `fecha` DATE NULL,
  `horaInicio` TIME NULL,
  `horaFin` TIME NULL,
  `lugar` VARCHAR(64) NULL,
  `promotor_id` INT NOT NULL,
  `supervisado` TINYINT NULL,
  `supervisor` VARCHAR(64) NULL,
  `pNuevo` FLOAT NULL,
  `pRecurrente` FLOAT NULL,
  `cnatural` FLOAT NULL,
  `csabor` FLOAT NULL DEFAULT NULL,
  `cfeminino` FLOAT NULL DEFAULT NULL,
  `lubricante` FLOAT NULL,
  `pruebaVIH` FLOAT NULL,
  `autoprueba` FLOAT NULL,
  `reactivo` FLOAT NULL,
  `sifilis` FLOAT NULL,
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
-- Table `poam`.`permiso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `poam`.`permiso` ;

CREATE TABLE IF NOT EXISTS `poam`.`permiso` (
  `idPermiso` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `poa` TINYINT NULL,
  `pom` TINYINT NULL,
  `usuario` TINYINT NULL,
  `subreceptor` TINYINT NULL,
  `promotor` TINYINT NULL,
  `catalogo` TINYINT NULL,
  PRIMARY KEY (`idPermiso`))
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
    IN anio			VARCHAR(4),
	IN mes			INT,
	IN departamento INT,
	IN municipio	INT,
	IN nuevo		FLOAT,
	IN recurrente	FLOAT,
	IN subreceptor	FLOAT,
    IN observacion	TEXT,
	IN cnatural 	INT,
	IN csabor		INT,
    IN cfemenino	INT,
	IN lubricante	INT,
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
	INSERT INTO insumo VALUES(IdInsumo,IdPoa,cnatural,csabor,cfemenino,lubricante,pruebaVIH,autoPrueba,reactivoE,sifilis);
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
	IN documento 	BOOLEAN,
	IN numero		VARCHAR(16),
	IN nombre 		VARCHAR(50),
	IN apellido		VARCHAR(50),
	IN direccion	VARCHAR(100),
	IN telefono		VARCHAR(12),
	IN email		VARCHAR(100),
    IN rol			INT,
	IN pass			VARCHAR(16),
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
	INSERT INTO usuario VALUES(IdUsuario,IdPersona,rol,lower(concat(left(nombre,1),left(apellido,1),year(now()),IdPersona)),SHA(pass),subreceptor,1);
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
	END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarCatalogo
-- -----------------------------------------------------

USE `poam`;
DROP procedure IF EXISTS `poam`.`agregarCatalogo`;

DELIMITER $$
USE `poam`$$
/* ---------------CREATE--------------------*/
CREATE PROCEDURE agregarCatalogo(
	IN codigo		VARCHAR(24),
    IN nombre		VARCHAR(100),
    IN descripcion	TEXT,
    IN categoria 	VARCHAR(32) )
BEGIN
	INSERT INTO catalogo VALUES(codigo,nombre,descripcion,categoria);
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
	SELECT * FROM usuario WHERE usuario = users AND pass = SHA(contra);
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

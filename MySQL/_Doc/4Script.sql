-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema practica-bd
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `practica-bd` ;

-- -----------------------------------------------------
-- Schema practica-bd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `practica-bd` DEFAULT CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci ;
USE `practica-bd` ;

-- -----------------------------------------------------
-- Table `practica-bd`.`lugares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`lugares` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`lugares` (
  `lugar` INT(1) NOT NULL,
  PRIMARY KEY (`lugar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `practica-bd`.`vehiculos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`vehiculos` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`vehiculos` (
  `placa` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`placa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `practica-bd`.`fotodetecciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`fotodetecciones` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`fotodetecciones` (
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `velocidad` INT NOT NULL,
  `vehiculos_placa` VARCHAR(10) NOT NULL,
  `lugares_lugar` INT(1) NOT NULL,
  PRIMARY KEY (`fecha`, `hora`, `vehiculos_placa`, `lugares_lugar`),
  INDEX `fk_fotodetecciones_vehiculos_idx` (`vehiculos_placa` ASC),
  INDEX `fk_fotodetecciones_lugares1_idx` (`lugares_lugar` ASC),
  CONSTRAINT `fk_fotodetecciones_vehiculos`
    FOREIGN KEY (`vehiculos_placa`)
    REFERENCES `practica-bd`.`vehiculos` (`placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fotodetecciones_lugares1`
    FOREIGN KEY (`lugares_lugar`)
    REFERENCES `practica-bd`.`lugares` (`lugar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema practica-bd
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `practica-bd` ;

-- -----------------------------------------------------
-- Schema practica-bd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `practica-bd` DEFAULT CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci ;
USE `practica-bd` ;

-- -----------------------------------------------------
-- Table `practica-bd`.`lugares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`lugares` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`lugares` (
  `lugar` INT(1) NOT NULL,
  PRIMARY KEY (`lugar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `practica-bd`.`vehiculos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`vehiculos` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`vehiculos` (
  `placa` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`placa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `practica-bd`.`fotodetecciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `practica-bd`.`fotodetecciones` ;

CREATE TABLE IF NOT EXISTS `practica-bd`.`fotodetecciones` (
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `velocidad` INT NOT NULL,
  `vehiculos_placa` VARCHAR(10) NOT NULL,
  `lugares_lugar` INT(1) NOT NULL,
  PRIMARY KEY (`fecha`, `hora`, `vehiculos_placa`, `lugares_lugar`),
  INDEX `fk_fotodetecciones_vehiculos_idx` (`vehiculos_placa` ASC),
  INDEX `fk_fotodetecciones_lugares1_idx` (`lugares_lugar` ASC),
  CONSTRAINT `fk_fotodetecciones_vehiculos`
    FOREIGN KEY (`vehiculos_placa`)
    REFERENCES `practica-bd`.`vehiculos` (`placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fotodetecciones_lugares1`
    FOREIGN KEY (`lugares_lugar`)
    REFERENCES `practica-bd`.`lugares` (`lugar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema prova1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prova1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prova1` DEFAULT CHARACTER SET utf8 ;
USE `prova1` ;

-- -----------------------------------------------------
-- Table `prova1`.`pessoa_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova1`.`pessoa_fisica` (
  `pf_id` INT NOT NULL AUTO_INCREMENT,
  `pf_cpf` VARCHAR(45) NULL,
  `pf_nome` VARCHAR(250) NULL,
  `pf_dt_nascimento` VARCHAR(45) NULL,
  PRIMARY KEY (`pf_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova1`.`conta_corrent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova1`.`conta_corrent` (
  `cc_numero` INT NOT NULL AUTO_INCREMENT,
  `cc_saldo` DECIMAL(16,3) NULL,
  `cc_dt_ultima_alteracao` DATE NULL,
  `cc_pf_id` INT NOT NULL,
  PRIMARY KEY (`cc_numero`),
  INDEX `fk_conta_corrent_pessoa_fisica_idx` (`cc_pf_id` ASC),
  CONSTRAINT `fk_conta_corrent_pessoa_fisica`
    FOREIGN KEY (`cc_pf_id`)
    REFERENCES `prova1`.`pessoa_fisica` (`pf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova1`.`contatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova1`.`contatos` (
  `cont_id` INT NOT NULL AUTO_INCREMENT,
  `cont_tipo` VARCHAR(45) NULL,
  `cont_descricao` VARCHAR(250) NULL,
  `cont_pf_id` INT NOT NULL,
  PRIMARY KEY (`cont_id`),
  INDEX `fk_contatos_pessoa_fisica1_idx` (`cont_pf_id` ASC),
  CONSTRAINT `fk_contatos_pessoa_fisica1`
    FOREIGN KEY (`cont_pf_id`)
    REFERENCES `prova1`.`pessoa_fisica` (`pf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

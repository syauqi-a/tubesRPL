SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SET time_zone = "+07:00";

-- -----------------------------------------------------
-- Database db_good_habit
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Database db_good_habit
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `db_good_habit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `db_good_habit` ;

-- -----------------------------------------------------
-- Table `db_good_habit`.`akun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`akun` (
  `id_akun` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nama_lengkap` VARCHAR(64) NOT NULL COMMENT '',
  `username` VARCHAR(16) NOT NULL COMMENT '',
  `email` VARCHAR(64) NOT NULL COMMENT '',
  `password` VARCHAR(16) NOT NULL COMMENT '',
  `jenis_kelamin` ENUM('L', 'P') NOT NULL COMMENT '',
  `telepon` VARCHAR(15) NOT NULL COMMENT '',
  `foto_profil` VARCHAR(225) NOT NULL COMMENT '',
  PRIMARY KEY (`id_akun`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`alamat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`alamat` (
  `jalan` VARCHAR(100) NOT NULL COMMENT '',
  `kota` VARCHAR(100) NOT NULL COMMENT '',
  `kodePos` VARCHAR(5) NOT NULL COMMENT '',
  `id_akun` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_akun`)  COMMENT '',
  CONSTRAINT `fk_alamat_akun`
    FOREIGN KEY (`id_akun`)
    REFERENCES `db_good_habit`.`akun` (`id_akun`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`kebiasaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`kebiasaan` (
  `id_kebiasaan` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nama_kebiasaan` VARCHAR(100) NOT NULL COMMENT '',
  `status_kebiasaan` ENUM('pribadi', 'rekomendasi', 'challenge') NOT NULL COMMENT '',
  `waktu` TIME NOT NULL COMMENT '',
  `ulang` ENUM('tiap hari', 'tiap minggu', 'tiap bulan') NOT NULL COMMENT '',
  `deskripsi` VARCHAR(225) NULL COMMENT '',
  PRIMARY KEY (`id_kebiasaan`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`hadiah`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`hadiah` (
  `id_hadiah` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nama_hadiah` VARCHAR(100) NOT NULL COMMENT '',
  `kode_hadiah` VARCHAR(25) NOT NULL COMMENT '',
  `deskripsi` VARCHAR(225) NULL COMMENT '',
  `id_kebiasaan` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_hadiah`)  COMMENT '',
  INDEX `fk_hadiah_kebiasaan1_idx` (`id_kebiasaan` ASC)  COMMENT '',
  CONSTRAINT `fk_hadiah_kebiasaan1`
    FOREIGN KEY (`id_kebiasaan`)
    REFERENCES `db_good_habit`.`kebiasaan` (`id_kebiasaan`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`rekap_kebiasaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`rekap_kebiasaan` (
  `id_akun` INT NOT NULL COMMENT '',
  `id_kebiasaan` INT NOT NULL COMMENT '',
  `tanggal` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`id_akun`, `id_kebiasaan`)  COMMENT '',
  INDEX `fk_rekap_kebiasaan_kebiasaan1_idx` (`id_kebiasaan` ASC)  COMMENT '',
  INDEX `fk_rekap_kebiasaan_akun1_idx` (`id_akun` ASC)  COMMENT '',
  CONSTRAINT `fk_rekap_kebiasaan_akun1`
    FOREIGN KEY (`id_akun`)
    REFERENCES `db_good_habit`.`akun` (`id_akun`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_rekap_kebiasaan_kebiasaan1`
    FOREIGN KEY (`id_kebiasaan`)
    REFERENCES `db_good_habit`.`kebiasaan` (`id_kebiasaan`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
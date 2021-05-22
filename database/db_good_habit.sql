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
DROP DATABASE IF EXISTS `db_good_habit`;
CREATE DATABASE `db_good_habit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `db_good_habit`;

-- -----------------------------------------------------
-- Table `db_good_habit`.`akun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`akun` (
  `id_akun` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nama_lengkap` VARCHAR(64) NOT NULL COMMENT '',
  `username` VARCHAR(16) NOT NULL COMMENT '',
  `email` VARCHAR(64) NOT NULL COMMENT '',
  `password` VARCHAR(32) NOT NULL COMMENT '',
  `jenis_kelamin` ENUM('L', 'P') NOT NULL COMMENT '',
  `telepon` VARCHAR(15) NULL COMMENT '',
  `foto_profil` VARCHAR(225) NULL COMMENT '',
  PRIMARY KEY (`id_akun`)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`alamat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`alamat` (
  `jalan` VARCHAR(100) NULL COMMENT '',
  `kota` VARCHAR(100) NULL COMMENT '',
  `kodePos` VARCHAR(5) NULL COMMENT '',
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
  `ket` VARCHAR(45) NULL COMMENT '',
  `id_akun` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_kebiasaan`, `id_akun`)  COMMENT '',
  INDEX `fk_kebiasaan_akun1_idx` (`id_akun` ASC)  COMMENT '',
  CONSTRAINT `fk_kebiasaan_akun1`
    FOREIGN KEY (`id_akun`)
    REFERENCES `db_good_habit`.`akun` (`id_akun`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`hadiah`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`hadiah` (
  `id_hadiah` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `kode_hadiah` VARCHAR(25) NOT NULL COMMENT '',
  `nama_hadiah` VARCHAR(100) NOT NULL COMMENT '',
  `deskripsi` VARCHAR(225) NULL COMMENT '',
  `period` DATE NOT NULL COMMENT '',
  `claim` ENUM('n', 'y') NOT NULL COMMENT '',
  `id_akun` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id_hadiah`)  COMMENT '',
  INDEX `fk_hadiah_akun1_idx` (`id_akun` ASC)  COMMENT '',
  CONSTRAINT `fk_hadiah_akun1`
    FOREIGN KEY (`id_akun`)
    REFERENCES `db_good_habit`.`akun` (`id_akun`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_good_habit`.`rekap_kebiasaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_good_habit`.`rekap_kebiasaan` (
  `id_akun` INT NOT NULL COMMENT '',
  `id_kebiasaan` INT NOT NULL COMMENT '',
  `tanggal` DATETIME NOT NULL COMMENT '',
  `ketepatan` INT NOT NULL COMMENT '',
  `bukti` VARCHAR(225) NULL COMMENT '',
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

-- -----------------------------------------------------
-- Data for table `db_good_habit`.`akun`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_good_habit`;
INSERT INTO `db_good_habit`.`akun` (`id_akun`, `nama_lengkap`, `username`, `email`, `password`, `jenis_kelamin`, `telepon`, `foto_profil`) VALUES (1, 'admin', 'admin', '', 'f06403650f915eba030f842506a21d22', DEFAULT, NULL, NULL);

COMMIT;

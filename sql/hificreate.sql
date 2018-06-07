-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema 
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `hifi` ;

-- -----------------------------------------------------
-- Schema 
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hifi` DEFAULT CHARACTER SET utf8 ;
USE `hifi` ;

-- -----------------------------------------------------
-- Table `hifi`.`Aufschlag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Aufschlag` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Aufschlag` (
  `Aufschlag` DOUBLE NOT NULL,
  PRIMARY KEY (`Aufschlag`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Umsatzsteuer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Umsatzsteuer` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Umsatzsteuer` (
  `UmsatzsteuerId` INT NOT NULL,
  `Steuersatz` DOUBLE NULL,
  PRIMARY KEY (`UmsatzsteuerId`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `UmsatzsteuerId_UNIQUE` ON `hifi`.`Umsatzsteuer` (`UmsatzsteuerId` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Artikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Artikel` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Artikel` (
  `ArtikelID` INT NOT NULL AUTO_INCREMENT,
  `Artikelname` VARCHAR(45) NULL,
  `Einkaufspreis` DOUBLE NULL,
  `Verkaufspreis` DOUBLE NULL,
  `Mindestbestand` INT NULL,
  `Aufschlag` DOUBLE NULL,
  `Lagerstand` INT NULL,
  `Lagerort` VARCHAR(45) NULL,
  `UmsatzsteuerId` INT NOT NULL,
  `Aktiv` TINYINT NULL,
  PRIMARY KEY (`ArtikelID`),
  CONSTRAINT `fk_Artikel_Aufschlag1`
    FOREIGN KEY (`Aufschlag`)
    REFERENCES `hifi`.`Aufschlag` (`Aufschlag`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artikel_Umsatzsteuer1`
    FOREIGN KEY (`UmsatzsteuerId`)
    REFERENCES `hifi`.`Umsatzsteuer` (`UmsatzsteuerId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `ArtikelID_UNIQUE` ON `hifi`.`Artikel` (`ArtikelID` ASC);

CREATE INDEX `fk_Artikel_Aufschlag1_idx` ON `hifi`.`Artikel` (`Aufschlag` ASC);

CREATE INDEX `fk_Artikel_Umsatzsteuer1_idx` ON `hifi`.`Artikel` (`UmsatzsteuerId` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Zahlungsbedingungen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Zahlungsbedingungen` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Zahlungsbedingungen` (
  `ZahlungsbedingungID` INT NOT NULL AUTO_INCREMENT,
  `Skonto` DOUBLE NULL,
  `Rabatt` DOUBLE NULL,
  `ZahlungszielTage` INT NULL,
  PRIMARY KEY (`ZahlungsbedingungID`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `LieferbedingungID_UNIQUE` ON `hifi`.`Zahlungsbedingungen` (`ZahlungsbedingungID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Incoterms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Incoterms` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Incoterms` (
  `IncotermsID` INT NOT NULL AUTO_INCREMENT,
  `Typ` VARCHAR(45) NULL,
  PRIMARY KEY (`IncotermsID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Transportart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Transportart` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Transportart` (
  `TransportartID` INT NOT NULL AUTO_INCREMENT,
  `Transportart` VARCHAR(45) NULL,
  PRIMARY KEY (`TransportartID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Lieferbedingungen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Lieferbedingungen` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Lieferbedingungen` (
  `LieferbedingungID` INT NOT NULL AUTO_INCREMENT,
  `Kosten` DOUBLE NULL,
  `IncotermsID` INT NOT NULL,
  `TransportartID` INT NOT NULL,
  PRIMARY KEY (`LieferbedingungID`),
  CONSTRAINT `fk_Lieferbedingungen_Incoterms1`
    FOREIGN KEY (`IncotermsID`)
    REFERENCES `hifi`.`Incoterms` (`IncotermsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferbedingungen_Transportart1`
    FOREIGN KEY (`TransportartID`)
    REFERENCES `hifi`.`Transportart` (`TransportartID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Lieferbedingungen_Incoterms1_idx` ON `hifi`.`Lieferbedingungen` (`IncotermsID` ASC);

CREATE INDEX `fk_Lieferbedingungen_Transportart1_idx` ON `hifi`.`Lieferbedingungen` (`TransportartID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Land`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Land` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Land` (
  `LandID` INT NOT NULL AUTO_INCREMENT,
  `Kennzeichen` VARCHAR(3) NULL,
  `Bezeichnung` VARCHAR(255) NULL,
  PRIMARY KEY (`LandID`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `LandID_UNIQUE` ON `hifi`.`Land` (`LandID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Ort`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Ort` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Ort` (
  `OrtID` INT NOT NULL AUTO_INCREMENT,
  `PLZ` INT NULL,
  `Bezeichnung` VARCHAR(255) NULL,
  `LandID` INT NOT NULL,
  PRIMARY KEY (`OrtID`),
  CONSTRAINT `fk_Ort_Land1`
    FOREIGN KEY (`LandID`)
    REFERENCES `hifi`.`Land` (`LandID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Ort_Land1_idx` ON `hifi`.`Ort` (`LandID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Lieferant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Lieferant` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Lieferant` (
  `LieferantID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Telefonnummer` VARCHAR(15) NULL,
  `ZahlungsbedingungID` INT NOT NULL,
  `LieferbedingungID` INT NOT NULL,
  `Strasse` VARCHAR(45) NULL,
  `Hausnummer` INT NULL,
  `OrtID` INT NOT NULL,
  `Aktiv` TINYINT NULL,
  PRIMARY KEY (`LieferantID`),
  CONSTRAINT `fk_Lieferant_Zahlungsbedingungen`
    FOREIGN KEY (`ZahlungsbedingungID`)
    REFERENCES `hifi`.`Zahlungsbedingungen` (`ZahlungsbedingungID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferant_Lieferbedingungen1`
    FOREIGN KEY (`LieferbedingungID`)
    REFERENCES `hifi`.`Lieferbedingungen` (`LieferbedingungID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferant_Ort1`
    FOREIGN KEY (`OrtID`)
    REFERENCES `hifi`.`Ort` (`OrtID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `LieferantID_UNIQUE` ON `hifi`.`Lieferant` (`LieferantID` ASC);

CREATE INDEX `fk_Lieferant_Zahlungsbedingungen_idx` ON `hifi`.`Lieferant` (`ZahlungsbedingungID` ASC);

CREATE INDEX `fk_Lieferant_Lieferbedingungen1_idx` ON `hifi`.`Lieferant` (`LieferbedingungID` ASC);

CREATE INDEX `fk_Lieferant_Ort1_idx` ON `hifi`.`Lieferant` (`OrtID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Zahlungsmethode`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Zahlungsmethode` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Zahlungsmethode` (
  `ZahlungsmethodeID` INT NOT NULL,
  `Zahlungsmethode` VARCHAR(45) NULL,
  PRIMARY KEY (`ZahlungsmethodeID`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `ZahlungsmethodeID_UNIQUE` ON `hifi`.`Zahlungsmethode` (`ZahlungsmethodeID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Lieferantenbestellung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Lieferantenbestellung` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Lieferantenbestellung` (
  `LieferantenbestellungsID` INT NOT NULL AUTO_INCREMENT,
  `LieferantID` INT NOT NULL,
  `ZahlungsmethodeID` INT NOT NULL,
  `abgeschlossen` TINYINT NULL,
  PRIMARY KEY (`LieferantenbestellungsID`),
  CONSTRAINT `fk_Bestellung_Lieferant1`
    FOREIGN KEY (`LieferantID`)
    REFERENCES `hifi`.`Lieferant` (`LieferantID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferantenbestellung_Zahlungsmethode1`
    FOREIGN KEY (`ZahlungsmethodeID`)
    REFERENCES `hifi`.`Zahlungsmethode` (`ZahlungsmethodeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `BestellungID_UNIQUE` ON `hifi`.`Lieferantenbestellung` (`LieferantenbestellungsID` ASC);

CREATE INDEX `fk_Bestellung_Lieferant1_idx` ON `hifi`.`Lieferantenbestellung` (`LieferantID` ASC);

CREATE INDEX `fk_Lieferantenbestellung_Zahlungsmethode1_idx` ON `hifi`.`Lieferantenbestellung` (`ZahlungsmethodeID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`LieferantLiefert`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`LieferantLiefert` ;

CREATE TABLE IF NOT EXISTS `hifi`.`LieferantLiefert` (
  `LieferantID` INT NOT NULL,
  `ArtikelID` INT NOT NULL,
  PRIMARY KEY (`LieferantID`, `ArtikelID`),
  CONSTRAINT `fk_Lieferant_has_Artikel_Lieferant1`
    FOREIGN KEY (`LieferantID`)
    REFERENCES `hifi`.`Lieferant` (`LieferantID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferant_has_Artikel_Artikel1`
    FOREIGN KEY (`ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Lieferant_has_Artikel_Artikel1_idx` ON `hifi`.`LieferantLiefert` (`ArtikelID` ASC);

CREATE INDEX `fk_Lieferant_has_Artikel_Lieferant1_idx` ON `hifi`.`LieferantLiefert` (`LieferantID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`LieferantenLieferungen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`LieferantenLieferungen` ;

CREATE TABLE IF NOT EXISTS `hifi`.`LieferantenLieferungen` (
  `LieferantenLieferungID` INT NOT NULL AUTO_INCREMENT,
  `Lieferschein` VARCHAR(45) NULL,
  `Eingangsdatum` DATE NOT NULL,
  `LieferbestellungsID` INT NOT NULL,
  PRIMARY KEY (`LieferantenLieferungID`),
  CONSTRAINT `fk_LieferantenLieferungen_Lieferantenbestellung1`
    FOREIGN KEY (`LieferbestellungsID`)
    REFERENCES `hifi`.`Lieferantenbestellung` (`LieferantenbestellungsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_LieferantenLieferungen_Lieferantenbestellung1_idx` ON `hifi`.`LieferantenLieferungen` (`LieferbestellungsID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Lieferantenartikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Lieferantenartikel` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Lieferantenartikel` (
  `Anzahl` INT NULL,
  `ArtikelID` INT NOT NULL,
  `LieferantenbestellungsID` INT NOT NULL,
  PRIMARY KEY (`ArtikelID`, `LieferantenbestellungsID`),
  CONSTRAINT `fk_Lieferantenartikel_Artikel1`
    FOREIGN KEY (`ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferantenartikel_Lieferantenbestellung1`
    FOREIGN KEY (`LieferantenbestellungsID`)
    REFERENCES `hifi`.`Lieferantenbestellung` (`LieferantenbestellungsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Lieferantenartikel_Artikel1_idx` ON `hifi`.`Lieferantenartikel` (`ArtikelID` ASC);

CREATE INDEX `fk_Lieferantenartikel_Lieferantenbestellung1_idx` ON `hifi`.`Lieferantenartikel` (`LieferantenbestellungsID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Kundenstatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Kundenstatus` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Kundenstatus` (
  `KundenstatusID` INT NOT NULL AUTO_INCREMENT,
  `Rabatt` DOUBLE NULL,
  `Kundenstatus` VARCHAR(45) NULL,
  PRIMARY KEY (`KundenstatusID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Mitarbeiter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Mitarbeiter` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Mitarbeiter` (
  `MitarbeiterID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Abteilung` VARCHAR(45) NULL,
  PRIMARY KEY (`MitarbeiterID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Kunde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Kunde` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Kunde` (
  `KundeID` INT NOT NULL AUTO_INCREMENT,
  `Vorname` VARCHAR(45) NULL,
  `Mail` VARCHAR(45) NULL,
  `Telefon` VARCHAR(45) NULL,
  `Strasse` VARCHAR(45) NULL,
  `Hausnummer` INT NULL,
  `KundenstatusID` INT NULL,
  `MitarbeiterID` INT NULL,
  `OrtID` INT NULL,
  `Nachname` VARCHAR(45) NULL,
  PRIMARY KEY (`KundeID`),
  CONSTRAINT `Kundenstatus`
    FOREIGN KEY (`KundenstatusID`)
    REFERENCES `hifi`.`Kundenstatus` (`KundenstatusID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Mitarbeiter`
    FOREIGN KEY (`MitarbeiterID`)
    REFERENCES `hifi`.`Mitarbeiter` (`MitarbeiterID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Ort`
    FOREIGN KEY (`OrtID`)
    REFERENCES `hifi`.`Ort` (`OrtID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `Kundenstatus_idx` ON `hifi`.`Kunde` (`KundenstatusID` ASC);

CREATE INDEX `Mitarbeiter_idx` ON `hifi`.`Kunde` (`MitarbeiterID` ASC);

CREATE INDEX `Ort_idx` ON `hifi`.`Kunde` (`OrtID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`ZahlungsbedingungKunde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`ZahlungsbedingungKunde` ;

CREATE TABLE IF NOT EXISTS `hifi`.`ZahlungsbedingungKunde` (
  `ZahlungsbedingungKundeID` INT NOT NULL AUTO_INCREMENT,
  `Zahlungsart` VARCHAR(45) NULL,
  `Zahllungsfrist` INT NULL,
  PRIMARY KEY (`ZahlungsbedingungKundeID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hifi`.`Kundenbestellung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Kundenbestellung` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Kundenbestellung` (
  `KundenID` INT NOT NULL,
  `KundenbestellungsID` INT NOT NULL AUTO_INCREMENT,
  `Status` CHAR(1) NULL,
  `ZahlungsbedingungKundeID` INT NOT NULL,
  PRIMARY KEY (`KundenbestellungsID`),
  CONSTRAINT `fk_Kunde`
    FOREIGN KEY (`KundenID`)
    REFERENCES `hifi`.`Kunde` (`KundeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kundenbestellung_ZahlungsbedingungKunde1`
    FOREIGN KEY (`ZahlungsbedingungKundeID`)
    REFERENCES `hifi`.`ZahlungsbedingungKunde` (`ZahlungsbedingungKundeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Kunde_idx` ON `hifi`.`Kundenbestellung` (`KundenID` ASC);

CREATE INDEX `fk_Kundenbestellung_ZahlungsbedingungKunde1_idx` ON `hifi`.`Kundenbestellung` (`ZahlungsbedingungKundeID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Kundenlieferung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Kundenlieferung` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Kundenlieferung` (
  `KundenlieferungsID` INT NOT NULL AUTO_INCREMENT,
  `KundenbestellungsID` INT NULL,
  `Versanddatum` DATE NULL,
  `Rechnung` VARCHAR(45) NULL,
  `Übernahmeschein` VARCHAR(45) NULL,
  `Abgeschlossen` TINYINT NULL,
  `Lieferschein` VARCHAR(45) NULL,
  PRIMARY KEY (`KundenlieferungsID`),
  CONSTRAINT `fk_Kundenlieferung_Kundenbestellung1`
    FOREIGN KEY (`KundenbestellungsID`)
    REFERENCES `hifi`.`Kundenbestellung` (`KundenbestellungsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Kundenlieferung_Kundenbestellung1_idx` ON `hifi`.`Kundenlieferung` (`KundenbestellungsID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Auftragsposition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Auftragsposition` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Auftragsposition` (
  `Anzahl` INT NULL,
  `IstAbgezogen` TINYINT NULL,
  `ArtikelID` INT NOT NULL,
  `KundenbestellungsID` INT NULL,
  PRIMARY KEY (`ArtikelID`),
  CONSTRAINT `fk_Auftragsposition_Artikel1`
    FOREIGN KEY (`ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kunden_Bestellung`
    FOREIGN KEY (`KundenbestellungsID`)
    REFERENCES `hifi`.`Kundenbestellung` (`KundenbestellungsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Auftragsposition_Artikel1_idx` ON `hifi`.`Auftragsposition` (`ArtikelID` ASC);

CREATE INDEX `fk_Kunden_Bestellung_idx` ON `hifi`.`Auftragsposition` (`KundenbestellungsID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Kundenbewertung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Kundenbewertung` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Kundenbewertung` (
  `KundenbewertungID` INT NOT NULL AUTO_INCREMENT,
  `Gemahnt` TINYINT NULL,
  `Umsatz` DOUBLE NULL,
  `Kunde_KundeID` INT NOT NULL,
  `Datum` DATETIME NULL,
  PRIMARY KEY (`KundenbewertungID`),
  CONSTRAINT `fk_Kundenbewertung_Kunde1`
    FOREIGN KEY (`Kunde_KundeID`)
    REFERENCES `hifi`.`Kunde` (`KundeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Kundenbewertung_Kunde1_idx` ON `hifi`.`Kundenbewertung` (`Kunde_KundeID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`LieferantenKontaktperson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`LieferantenKontaktperson` ;

CREATE TABLE IF NOT EXISTS `hifi`.`LieferantenKontaktperson` (
  `KontaktpersonID` INT NOT NULL AUTO_INCREMENT,
  `Vorname` VARCHAR(45) NULL,
  `Nachname` VARCHAR(45) NULL,
  `Telefonnummer` VARCHAR(45) NULL,
  `LieferantID` INT NOT NULL,
  PRIMARY KEY (`KontaktpersonID`, `LieferantID`),
  CONSTRAINT `fk_LieferantenKontaktperson_Lieferant1`
    FOREIGN KEY (`LieferantID`)
    REFERENCES `hifi`.`Lieferant` (`LieferantID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_LieferantenKontaktperson_Lieferant1_idx` ON `hifi`.`LieferantenKontaktperson` (`LieferantID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Artikeleingang`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Artikeleingang` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Artikeleingang` (
  `Artikel_ArtikelID` INT NOT NULL,
  `LieferantenLieferungID` INT NOT NULL,
  `Anzahl` INT NOT NULL,
  PRIMARY KEY (`Artikel_ArtikelID`, `LieferantenLieferungID`),
  CONSTRAINT `fk_Artikeleingang_Artikel1`
    FOREIGN KEY (`Artikel_ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artikeleingang_LieferantenLieferungen1`
    FOREIGN KEY (`LieferantenLieferungID`)
    REFERENCES `hifi`.`LieferantenLieferungen` (`LieferantenLieferungID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Artikeleingang_Artikel1_idx` ON `hifi`.`Artikeleingang` (`Artikel_ArtikelID` ASC);

CREATE INDEX `fk_Artikeleingang_LieferantenLieferungen1_idx` ON `hifi`.`Artikeleingang` (`LieferantenLieferungID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Lagerlog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Lagerlog` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Lagerlog` (
  `ArtikelID` INT NOT NULL,
  `Änderung` CHAR(1) NOT NULL,
  `Anzahl` INT NOT NULL,
  `Datum` DATETIME NULL,
  `LieferungsID` INT NOT NULL,
  PRIMARY KEY (`ArtikelID`, `LieferungsID`),
  CONSTRAINT `fk_Lagerlog_Artikel1`
    FOREIGN KEY (`ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Lagerlog_Artikel1_idx` ON `hifi`.`Lagerlog` (`ArtikelID` ASC);


-- -----------------------------------------------------
-- Table `hifi`.`Artikelausgang`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hifi`.`Artikelausgang` ;

CREATE TABLE IF NOT EXISTS `hifi`.`Artikelausgang` (
  `ArtikelID` INT NOT NULL,
  `KundenlieferungsID` INT NOT NULL,
  `Anzahl` INT NOT NULL,
  PRIMARY KEY (`ArtikelID`, `KundenlieferungsID`),
  CONSTRAINT `fk_Artikelausgang_Artikel1`
    FOREIGN KEY (`ArtikelID`)
    REFERENCES `hifi`.`Artikel` (`ArtikelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artikelausgang_Kundenlieferung1`
    FOREIGN KEY (`KundenlieferungsID`)
    REFERENCES `hifi`.`Kundenlieferung` (`KundenlieferungsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Artikelausgang_Kundenlieferung1_idx` ON `hifi`.`Artikelausgang` (`KundenlieferungsID` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

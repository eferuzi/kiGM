SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS kigm ;
CREATE SCHEMA IF NOT EXISTS kigm DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE kigm;

-- -----------------------------------------------------
-- Table kigm.kg_languages
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_languages ;

CREATE  TABLE IF NOT EXISTS kigm.kg_languages (
  code VARCHAR(5) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  name VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (code) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_config
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_config ;

CREATE  TABLE IF NOT EXISTS kigm.kg_config (
  langcode VARCHAR(5) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  groupemail VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (langcode) ,
  INDEX fk_config_1 (langcode ASC) ,
  CONSTRAINT fk_config_1
    FOREIGN KEY (langcode )
    REFERENCES kigm.kg_languages (code )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_word_en
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_word_en ;

CREATE  TABLE IF NOT EXISTS kigm.kg_word_en (
  id INT(11) NOT NULL AUTO_INCREMENT ,
  word VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  definition TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  comments TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  current_status SMALLINT(6) NULL DEFAULT '0' ,
  source VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (id) )
ENGINE = MyISAM
AUTO_INCREMENT = 2501
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_login
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_login ;

CREATE  TABLE IF NOT EXISTS kigm.kg_login (
  id INT(11) NOT NULL AUTO_INCREMENT ,
  username VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  secretword VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  fullname VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  email VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (id) )
ENGINE = MyISAM
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_history
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_history ;

CREATE  TABLE IF NOT EXISTS kigm.kg_history (
  id INT(11) NOT NULL AUTO_INCREMENT ,
  word_id INT(11) NOT NULL ,
  login_id INT(11) NOT NULL ,
  def TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  tr_date DATETIME NOT NULL ,
  PRIMARY KEY (id, login_id) ,
  INDEX fk_history_1 (id ASC) ,
  INDEX fk_history_2 (login_id ASC) ,
  CONSTRAINT fk_history_1
    FOREIGN KEY (id )
    REFERENCES kigm.kg_word_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_history_2
    FOREIGN KEY (login_id )
    REFERENCES kigm.kg_login (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_sessions
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_sessions ;

CREATE  TABLE IF NOT EXISTS kigm.kg_sessions (
  session_id VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  session_data TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  expires INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (session_id) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_sycgroup_en
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_sycgroup_en ;

CREATE  TABLE IF NOT EXISTS kigm.kg_sycgroup_en (
  id INT(11) NOT NULL AUTO_INCREMENT ,
  shortname VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  fullname VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (id) ,
  UNIQUE INDEX shortname (shortname ASC, fullname ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_syc_word_en
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_syc_word_en ;

CREATE  TABLE IF NOT EXISTS kigm.kg_syc_word_en (
  syc_id INT(11) NOT NULL ,
  word_id INT(11) NOT NULL ,
  PRIMARY KEY (syc_id, word_id) ,
  INDEX fk_syc_word_tm_2 (word_id ASC) ,
  INDEX fk_syc_word_tm_1 (syc_id ASC) ,
  CONSTRAINT fk_syc_word_tm_2
    FOREIGN KEY (word_id )
    REFERENCES kigm.kg_word_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_syc_word_tm_1
    FOREIGN KEY (syc_id )
    REFERENCES kigm.kg_sycgroup_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_tag_en
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_tag_en ;

CREATE  TABLE IF NOT EXISTS kigm.kg_tag_en (
  id INT(11) NOT NULL AUTO_INCREMENT ,
  name VARCHAR(100) NOT NULL DEFAULT '' ,
  PRIMARY KEY (id) )
ENGINE = MyISAM
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table kigm.kg_tag_word_en
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_tag_word_en ;

CREATE  TABLE IF NOT EXISTS kigm.kg_tag_word_en (
  tag_id INT(11) NOT NULL ,
  word_id INT(11) NOT NULL ,
  PRIMARY KEY (tag_id, word_id) ,
  INDEX fk_tag_word_en_1 (tag_id ASC) ,
  INDEX fk_tag_word_en_2 (word_id ASC) ,
  CONSTRAINT fk_tag_word_en_1
    FOREIGN KEY (tag_id )
    REFERENCES kigm.kg_tag_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_tag_word_en_2
    FOREIGN KEY (word_id )
    REFERENCES kigm.kg_word_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_translation
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_translation ;

CREATE  TABLE IF NOT EXISTS kigm.kg_translation (
  id INT(11) NOT NULL ,
  word VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  definition TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  comment TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  weight INT(11) NULL DEFAULT NULL ,
  word_id INT(11) NOT NULL ,
  PRIMARY KEY (id, word_id) ,
  INDEX fk_tag_translation_1 (word_id ASC) ,
  CONSTRAINT fk_tag_translation_1
    FOREIGN KEY (word_id )
    REFERENCES kigm.kg_word_en (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table kigm.kg_translation_history
-- -----------------------------------------------------
DROP TABLE IF EXISTS kigm.kg_translation_history ;

CREATE  TABLE IF NOT EXISTS kigm.kg_translation_history (
  translation_id INT(11) NOT NULL ,
  history_id INT(11) NOT NULL ,
  PRIMARY KEY (translation_id, history_id) ,
  INDEX fk_translation_history_1 (translation_id ASC) ,
  INDEX fk_translation_history_2 (history_id ASC) ,
  CONSTRAINT fk_translation_history_1
    FOREIGN KEY (translation_id )
    REFERENCES kigm.kg_translation (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_translation_history_2
    FOREIGN KEY (history_id )
    REFERENCES kigm.kg_history (id )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

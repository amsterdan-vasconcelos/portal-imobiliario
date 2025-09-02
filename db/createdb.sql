-- DROP AND CREATE DATABASE
DROP DATABASE IF EXISTS casaweb;
CREATE DATABASE casaweb;
USE casaweb;

-- TABLE: access_profile
DROP TABLE IF EXISTS access_profile;
CREATE TABLE access_profile (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(40) DEFAULT NULL
);

-- TABLE: user
DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) DEFAULT NULL,
  username VARCHAR(60) DEFAULT NULL,
  email VARCHAR(100) DEFAULT NULL,
  password VARCHAR(100) DEFAULT NULL,
  active TINYINT(1) DEFAULT 0,
  profile_id INT(11) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL,
  FOREIGN KEY (profile_id) REFERENCES access_profile(id)
);

-- TABLE: property_type
DROP TABLE IF EXISTS property_type;
CREATE TABLE property_type (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(40) DEFAULT NULL
);

-- TABLE: purpose
DROP TABLE IF EXISTS purpose;
CREATE TABLE purpose (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(30) DEFAULT NULL
);

-- TABLE: owner
DROP TABLE IF EXISTS owner;
CREATE TABLE owner (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(14) DEFAULT NULL,
  gender ENUM('M', 'F') DEFAULT NULL,
  active boolean DEFAULT true
);

-- TABLE: property
DROP TABLE IF EXISTS property;
CREATE TABLE property (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(6) DEFAULT NULL,
  price DECIMAL(10,2) DEFAULT NULL,
  zip_code VARCHAR(100) DEFAULT NULL,
  street VARCHAR(100) DEFAULT NULL,
  neighborhood VARCHAR(100) DEFAULT NULL,
  city VARCHAR(100) DEFAULT NULL,
  bedrooms VARCHAR(2) DEFAULT NULL,
  bathrooms VARCHAR(2) DEFAULT NULL,
  garage VARCHAR(2) DEFAULT NULL,
  cover_image VARCHAR(40) DEFAULT NULL,
  total_area DECIMAL(10,0) DEFAULT NULL,
  built_area DECIMAL(10,0) DEFAULT NULL,
  status ENUM('0', '1') DEFAULT NULL,
  created_at TIMESTAMP NOT NULL,
  property_type_id INT(11) NOT NULL,
  purpose_id INT(11) NOT NULL,
  owner_id INT(11) NOT NULL,
  UNIQUE KEY unique_property_code (code),
  FOREIGN KEY (property_type_id) REFERENCES property_type(id),
  FOREIGN KEY (purpose_id) REFERENCES purpose(id),
  FOREIGN KEY (owner_id) REFERENCES owner(id)
);

-- TABLE: property_image
DROP TABLE IF EXISTS property_image;
CREATE TABLE property_image (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) DEFAULT NULL,
  property_id INT(11) DEFAULT NULL,
  FOREIGN KEY (property_id) REFERENCES property(id)
);

-- INSERT INTO access_profile
INSERT INTO access_profile (description) VALUES 
('administrador'), 
('usuário');

-- INSERT INTO property_type
INSERT INTO property_type (description) VALUES 
('casa'), 
('apartamento'), 
('chácara'), 
('edícula'), 
('barraco');

-- INSERT INTO purpose
INSERT INTO purpose (description) VALUES 
('venda'), 
('locação');

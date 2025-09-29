-- Tabela para os perfis de acesso
CREATE TABLE access_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(20) NOT NULL UNIQUE
);

-- Tabela para os propósitos (ex: Venda, Aluguel)
CREATE TABLE purposes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para os tipos de propriedade (ex: Casa, Apartamento, Terreno)
CREATE TABLE property_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para os usuários
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    active TINYINT(1) DEFAULT 1,
    access_profile_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (access_profile_id) REFERENCES access_profiles(id)
);

-- Tabela para os proprietários (donos de imóveis)
CREATE TABLE owners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NULL,
    gender CHAR(1) NULL, -- M, F, O
    active TINYINT(1) DEFAULT 1,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabela para as propriedades (imóveis)
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(10, 2) NULL,
    zip_code VARCHAR(10) NULL,
    street VARCHAR(150) NULL,
    neighborhood VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    bedrooms INT NULL,
    bathrooms INT NULL,
    garage INT NULL,
    total_area DECIMAL(10, 2) NULL,
    build_area DECIMAL(10, 2) NULL,
    active TINYINT(1) DEFAULT 1,
    owner_id INT NOT NULL,
    purpose_id INT NOT NULL,
    property_type_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (owner_id) REFERENCES owners(id),
    FOREIGN KEY (purpose_id) REFERENCES purposes(id),
    FOREIGN KEY (property_type_id) REFERENCES property_types(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabela para as imagens das propriedades
CREATE TABLE property_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NULL,
    path VARCHAR(255) NOT NULL,
    cover_image TINYINT(1) DEFAULT 0, -- 1 se for a imagem de capa
    property_id INT NOT NULL,
    FOREIGN KEY (property_id) REFERENCES properties(id)
);
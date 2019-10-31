-- USERS --
CREATE TABLE User (
  username VARCHAR NOT NULL UNIQUE,
  password NOT NULL VARCHAR,
  name VARCHAR NOT NULL,
  age, INTEGER NOT NULL,
  email TEXT NOT NULL UNIQUE,
  rating INTEGER NOT NULL,

  PRIMARY KEY(username)
);

INSERT INTO User VALUES (
  "motapinto", 
  "03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4", --SHA256 -- 1234  
  "Martim Pinto da Silva",
  "25",
  "noreply@gmail.com",
  "4"
);

INSERT INTO User VALUES (
  "lpramos", 
  "03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4", --SHA256 -- 1234  
  "Luis Ramos",
  "32",
  "noreply@gmail.com",
  "5"
);

-- PROPERTY --
--Notas: para ja fazemos com que a propriedade esta sempre available ou nao - sem data (dps altera-se)
CREATE TABLE Property (
  id INTEGER NOT NULL,
  username VARCHAR NOT NULL,
  city VARCHAR NOT NULL,
  street VARCHAR NOT NULL,
  door_number INTEGER NOT NULL,
  apartment_number INTEGER DEFAULT(NULL),
  post_date INTEGER NOT NULL,
  price_day INTEGER NOT NULL,
  available BOOLEAN NOT NULL,
  rating INTEGER NOT NULL,
  title VARCHAR NOT NULL,
  description VARCHAR NOT NULL,
  property_type VARCHAR NOT NULL,
  
  PRIMARY KEY(id),
  CHECK(property_type == 'House' OR paymentMethod == 'Apartment'),
  FOREIGN KEY (username) REFERENCES User(username) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO Property VALUES (
  1,
  "motapinto", 
  "Porto"
  "Rua do Portão", 
  "51",
  "147",
  "20191205",
  "65",
  true,
  "5"
  "Apartamento T7 vista mar, duplex, com 2 suites e condomínio de topo",
  "Se procura um apartamento com muito espaço, num condomínio privado de topo, 
  com segurança, zonas verdes e instalações como piscina, ginásio e salão de jogos, 
  então este imóvel é para si.",
  "Apartment"
);

INSERT INTO Property VALUES (
  2,
  "lpramos", 
  "Lisboa"
  "Rua do Fundo", 
  "14",
  NULL,
  "20191127",
  "80",
  true,
  "5"
  "Mansão T9 vista mar, com 4 andares, com 2 suites jardim e piscina",
  "Se procura uma casa com muito espaço, numa rua sossegada, 
  com segurança, zonas verdes e instalações como piscina, ginásio e salão de jogos, 
  então este imóvel é para si.",
  "House"
);

-- COMMENT --
CREATE TABLE Comment (
  id INTEGER NOT NULL,
  property_id INTEGER NOT NULL,
  username VARCHAR NOT NULL,
  description VARCHAR NOT NULL,
  
  PRIMARY KEY(id),
  FOREIGN KEY (username) REFERENCES User(username) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (property_id) REFERENCES Property(id) ON DELETE SET NULL ON UPDATE CASCADE
);
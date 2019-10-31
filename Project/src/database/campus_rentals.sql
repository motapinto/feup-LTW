--
-- File generated with SQLiteStudio v3.2.1 on Thu Oct 31 20:01:02 2019
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id          INTEGER NOT NULL
                        PRIMARY KEY AUTOINCREMENT,
    property_id INTEGER NOT NULL,
    email       VARCHAR NOT NULL
                        REFERENCES User (email) ON DELETE SET NULL
                                                ON UPDATE CASCADE,
    description VARCHAR NOT NULL,
    FOREIGN KEY (
        email
    )
    REFERENCES User (username) ON DELETE SET NULL
                               ON UPDATE CASCADE,
    FOREIGN KEY (
        property_id
    )
    REFERENCES Property (id) ON DELETE SET NULL
                             ON UPDATE CASCADE
);


-- Table: Property
DROP TABLE IF EXISTS Property;

CREATE TABLE Property (
    id               INTEGER NOT NULL
                             PRIMARY KEY AUTOINCREMENT,
    email            VARCHAR NOT NULL
                             REFERENCES User (email),
    city             VARCHAR NOT NULL,
    street           VARCHAR NOT NULL,
    door_number      INTEGER NOT NULL,
    apartment_number INTEGER DEFAULT (NULL),
    post_date        INTEGER NOT NULL,
    price_day        INTEGER NOT NULL,
    available        BOOLEAN NOT NULL,
    rating           INTEGER NOT NULL,
    title            VARCHAR NOT NULL,
    description      VARCHAR NOT NULL,
    property_type    VARCHAR NOT NULL,
    CHECK (property_type == 'House' OR 
           property_type == 'Apartment') 
);

INSERT INTO Property (
                         id,
                         email,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         available,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         1,
                         'motapinto',
                         'Porto',
                         'Rua do Portão',
                         51,
                         147,
                         20191205,
                         65,
                         1,
                         5,
                         'Apartamento T7 vista mar, duplex, com 2 suites e condomínio de topo',
                         'Se procura um apartamento com muito espaço, num condomínio privado de topo, 
  com segurança, zonas verdes e instalações como piscina, ginásio e salão de jogos, 
  então este imóvel é para si.',
                         'Apartment'
                     );

INSERT INTO Property (
                         id,
                         email,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         available,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         2,
                         'lpramos',
                         'Lisboa',
                         'Rua do Fundo',
                         14,
                         NULL,
                         20191127,
                         80,
                         1,
                         5,
                         'Mansão T9 vista mar, com 4 andares, com 2 suites jardim e piscina',
                         'Se procura uma casa com muito espaço, numa rua sossegada, 
  com segurança, zonas verdes e instalações como piscina, ginásio e salão de jogos, 
  então este imóvel é para si.',
                         'House'
                     );


-- Table: Rented
DROP TABLE IF EXISTS Rented;

CREATE TABLE Rented (
    id           INTEGER NOT NULL
                         PRIMARY KEY AUTOINCREMENT,
    initial_date VARCHAR NOT NULL,
    fina_date    VARCHAR NOT NULL,
    property_id  INTEGER NOT NULL,
    email        VARCHAR NOT NULL
                         REFERENCES User (email) ON DELETE SET NULL
                                                 ON UPDATE CASCADE,
    FOREIGN KEY (
        property_id
    )
    REFERENCES Property (id) ON DELETE SET NULL
                             ON UPDATE CASCADE
);


-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    email    VARCHAR NOT NULL
                     UNIQUE
                     PRIMARY KEY,
    password VARCHAR NOT NULL,
    name     VARCHAR NOT NULL,
    age      INTEGER NOT NULL,
    rating   INTEGER NOT NULL
);

INSERT INTO User (
                     email,
                     password,
                     name,
                     age,
                     rating
                 )
                 VALUES (
                     'ms@gmail.com',
                     '03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4',
                     'Martim Pinto da Silva',
                     25,
                     4
                 );

INSERT INTO User (
                     email,
                     password,
                     name,
                     age,
                     rating
                 )
                 VALUES (
                     'lr@gmail.com',
                     '03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4',
                     'Luis Ramos',
                     32,
                     5
                 );


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;

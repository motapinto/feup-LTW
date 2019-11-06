--
-- File generated with SQLiteStudio v3.2.1 on Thu Oct 31 19:22:41 2019
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = on;
BEGIN TRANSACTION;

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id          INTEGER NOT NULL
                        PRIMARY KEY AUTOINCREMENT,
    property_id INTEGER NOT NULL,
    username    VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    FOREIGN KEY (
        username
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
    username         VARCHAR NOT NULL,
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
           property_type == 'Apartment'),
    FOREIGN KEY (
        username
    )
    REFERENCES User (username) ON DELETE SET NULL
                               ON UPDATE CASCADE
);

INSERT INTO Property (
                         id,
                         username,
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
                         username,
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
    final_date    VARCHAR NOT NULL,
    property_id  INTEGER NOT NULL,
    username     VARCHAR NOT NULL,
    FOREIGN KEY (
        username
    )
    REFERENCES User (username) ON DELETE SET NULL
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
    username VARCHAR NOT NULL
                     PRIMARY KEY,
    password VARCHAR NOT NULL,
    name     VARCHAR NOT NULL,
    age      INTEGER NOT NULL,
    email    TEXT    NOT NULL
                     UNIQUE,
    rating   INTEGER NOT NULL
);

INSERT INTO User (
                     username,
                     password,
                     name,
                     age,
                     email,
                     rating
                 )
                 VALUES (
                     'motapinto',
                     '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220',
                     'Martim Pinto da Silva',
                     25,
                     'ms@gmail.com',
                     4
                 );

INSERT INTO User (
                     username,
                     password,
                     name,
                     age,
                     email,
                     rating
                 )
                 VALUES (
                     'lpramos',
                     '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220',
                     'Luis Ramos',
                     32,
                     'lr@gmail.com',
                     5
                 );


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;

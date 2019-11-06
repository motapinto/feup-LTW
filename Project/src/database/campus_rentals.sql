--
-- File generated with SQLiteStudio v3.2.1 on Wed Nov 6 09:56:52 2019
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
    property_id INTEGER NOT NULL
                        REFERENCES Property (id) ON DELETE CASCADE
                                                 ON UPDATE CASCADE,
    email       VARCHAR NOT NULL
                        REFERENCES User (email) ON DELETE CASCADE
                                                ON UPDATE CASCADE,
    description VARCHAR NOT NULL,
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
    initial_date DATE    NOT NULL,
    final_date   DATE    NOT NULL
                         CONSTRAINT [FinalDate > Initial Date] CHECK (final_date > initial_date),
    property_id  INTEGER NOT NULL
                         REFERENCES Property (id) ON DELETE CASCADE
                                                  ON UPDATE CASCADE,
    email        VARCHAR NOT NULL
                         REFERENCES User (email) ON DELETE NO ACTION
                                                 ON UPDATE CASCADE
);

INSERT INTO Rented (
                       id,
                       initial_date,
                       final_date,
                       property_id,
                       email
                   )
                   VALUES (
                       1,
                       '10/10/2012',
                       '10/12/2012',
                       1,
                       'lr@gmail.com'
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
    rating   INTEGER
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
                     '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220',
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
                     '7110EDA4D09E062AA5E4A390B0A572AC0D2C0220',
                     'Luis Ramos',
                     32,
                     5
                 );


-- Trigger: OnRent
DROP TRIGGER IF EXISTS OnRent;
CREATE TRIGGER OnRent
        BEFORE INSERT
            ON Rented
          WHEN (
    SELECT COUNT( * ) AS contagem
      FROM (
               SELECT R.initial_date,
                      R.final_date
                 FROM Rented AS R
                WHERE NEW.initial_date < R.final_date AND 
                      NEW.final_date > R.initial_date
           )
)
BEGIN
    SELECT RAISE(ROLLBACK, "Invalid Dates");
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;

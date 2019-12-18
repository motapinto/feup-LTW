--
-- File generated with SQLiteStudio v3.2.1 on qua dez 18 08:46:36 2019
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
    user_id     INTEGER NOT NULL
                        REFERENCES User (id) ON DELETE CASCADE
                                             ON UPDATE CASCADE,
    comment     TEXT    NOT NULL,
    date        DATE    CONSTRAINT [Post Date] DEFAULT (date('now') ) 
                        NOT NULL,
    rating      INTEGER CONSTRAINT [Rating Range] CHECK (rating >= 0 AND 
                                                         rating <= 5) 
);


-- Table: Image
DROP TABLE IF EXISTS Image;

CREATE TABLE Image (
    id          INTEGER PRIMARY KEY AUTOINCREMENT
                        NOT NULL,
    property_id INTEGER REFERENCES Property (id) ON DELETE CASCADE
                                                 ON UPDATE CASCADE
                        NOT NULL,
    name        STRING  UNIQUE
                        NOT NULL
);


-- Table: Message
DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    message  TEXT     NOT NULL,
    id       INTEGER  NOT NULL
                      PRIMARY KEY AUTOINCREMENT,
    receiver INTEGER  NOT NULL
                      REFERENCES User (id) ON DELETE CASCADE
                                           ON UPDATE CASCADE,
    sender   INTEGER  NOT NULL
                      REFERENCES User (id) ON DELETE CASCADE
                                           ON UPDATE CASCADE,
    date     DATETIME CONSTRAINT [Post Date] DEFAULT (datetime('now') ) 
                      NOT NULL
);


-- Table: Property
DROP TABLE IF EXISTS Property;

CREATE TABLE Property (
    id               INTEGER NOT NULL
                             PRIMARY KEY AUTOINCREMENT,
    user_id          INTEGER NOT NULL
                             REFERENCES User (id) ON DELETE CASCADE
                                                  ON UPDATE CASCADE,
    city             STRING  NOT NULL,
    street           STRING  NOT NULL,
    door_number      INTEGER NOT NULL,
    apartment_number INTEGER,
    post_date        INTEGER DEFAULT (date('now') ) 
                             NOT NULL,
    price_day        INTEGER NOT NULL,
    guests           INTEGER DEFAULT (1) 
                             NOT NULL,
    rating           INTEGER DEFAULT (0),
    title            STRING  NOT NULL,
    description      TEXT    NOT NULL,
    property_type    INTEGER NOT NULL
                             CONSTRAINT [Property Type Definition] CHECK (property_type >= 0 AND 
                                                                          property_type < 2) 
);


-- Table: Rented
DROP TABLE IF EXISTS Rented;

CREATE TABLE Rented (
    id           INTEGER NOT NULL
                         PRIMARY KEY AUTOINCREMENT,
    initial_date DATE    NOT NULL
                         CONSTRAINT [Before final date] CHECK (julianday(initial_date) < julianday(final_date) AND 
                                                               julianday(initial_date) >= julianday('now') ),
    final_date   DATE    NOT NULL
                         CONSTRAINT [After initial] CHECK (julianday(final_date) > julianday(initial_date) ),
    property_id  INTEGER NOT NULL
                         REFERENCES Property (id) ON DELETE CASCADE
                                                  ON UPDATE CASCADE,
    user_id      INTEGER NOT NULL
                         REFERENCES User (id) ON DELETE CASCADE
                                              ON UPDATE CASCADE,
    price        INTEGER CHECK (price > 0),
    adults       INTEGER NOT NULL
                         DEFAULT (1) 
                         CONSTRAINT [At least 1 adult] CHECK (adults > 0),
    children     INTEGER DEFAULT (0) 
                         NOT NULL,
    babies       INTEGER NOT NULL
                         DEFAULT (0) 
);


-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id       INTEGER PRIMARY KEY AUTOINCREMENT
                     NOT NULL,
    email    STRING  NOT NULL
                     UNIQUE,
    password STRING  NOT NULL,
    name     STRING  NOT NULL,
    age      INTEGER NOT NULL
                     CHECK (age > 17),
    image    STRING  UNIQUE
);


-- Trigger: Guests Limit
DROP TRIGGER IF EXISTS "Guests Limit";
CREATE TRIGGER [Guests Limit]
        BEFORE INSERT
            ON Rented
          WHEN (NEW.adults + NEW.children + NEW.babies) > (
                                                              SELECT guests
                                                                FROM Property
                                                               WHERE Property.id = NEW.property_id
                                                          )
BEGIN
    SELECT RAISE(FAIL, "OVER LIMIT");
END;


-- Trigger: Ocupied
DROP TRIGGER IF EXISTS Ocupied;
CREATE TRIGGER Ocupied
        BEFORE INSERT
            ON Rented
          WHEN (
    SELECT Rented.id
      FROM Rented
     WHERE NEW.property_id = Rented.property_id AND 
           (julianday(NEW.initial_date) BETWEEN julianday(Rented.initial_date) AND julianday(Rented.final_date) OR 
            julianday(NEW.final_date) BETWEEN julianday(Rented.initial_date) AND julianday(Rented.final_date) OR 
            julianday(Rented.initial_date) BETWEEN julianday(NEW.initial_date) AND julianday(NEW.final_date) ) 
)
BEGIN
    SELECT RAISE(FAIL, "Not Available");
END;


-- Trigger: Property Rating
DROP TRIGGER IF EXISTS "Property Rating";
CREATE TRIGGER [Property Rating]
         AFTER INSERT
            ON Comment
          WHEN NEW.rating NOT NULL
BEGIN
    UPDATE Property
       SET rating = (
               SELECT AVG(Comment.rating) 
                 FROM Comment
                WHERE Comment.property_id = NEW.property_id AND 
                      Comment.rating NOT NULL
           )
     WHERE Property.id = NEW.property_id;
END;


-- Trigger: Set Price
DROP TRIGGER IF EXISTS "Set Price";
CREATE TRIGGER [Set Price]
         AFTER INSERT
            ON Rented
BEGIN
    UPDATE Rented
       SET price = (julianday(final_date) - julianday(initial_date) ) * (
                                                                            SELECT price_day
                                                                              FROM Property
                                                                             WHERE Property.id = NEW.property_id
                                                                        )
     WHERE Rented.id = NEW.id;
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;

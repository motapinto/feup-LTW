--
-- File generated with SQLiteStudio v3.2.1 on Sun Dec 15 22:10:46 2019
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

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        1,
                        2,
                        9,
                        'Great house!',
                        '2019-12-09',
                        5
                    );

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        2,
                        3,
                        9,
                        'What a dream!',
                        '2019-12-10',
                        5
                    );

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        3,
                        4,
                        10,
                        'nineeee',
                        '2019-12-10',
                        5
                    );

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        4,
                        5,
                        9,
                        'I loved very much the place',
                        '2019-12-10',
                        4
                    );

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        5,
                        6,
                        9,
                        'I am loving this experience',
                        '2019-12-10',
                        5
                    );

INSERT INTO Comment (
                        id,
                        property_id,
                        user_id,
                        comment,
                        date,
                        rating
                    )
                    VALUES (
                        6,
                        2,
                        9,
                        'aaaaa',
                        '2019-12-12',
                        NULL
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

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      1,
                      4,
                      'cacf056de859cf86ede2f2bbe01d4f61309eca0f789ed9ba93e1e067da485965'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      2,
                      5,
                      'f5ca5bd1a6e1a27724e80c24f78258a2ccb36f726a27a1b12794b9efdeac2e57'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      3,
                      6,
                      'e76a7e5cfcc7c7b4272ceb99a6f874303a274c07e1afb92ba3c3ff06479a06e4'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      4,
                      7,
                      '8d08d21a68b6663e056d5ff79c637a871c666d2c813fec42170751488a07cbf6'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      5,
                      3,
                      '2b8f7480c123e3552e616c7d7d52ebab53a11c343c2c0d024f7840e6dfb85194'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      6,
                      1,
                      'e3fb111a113799f513992258309f3afa5764ac0d10209aa9ee2736fef8505afd'
                  );

INSERT INTO Image (
                      id,
                      property_id,
                      name
                  )
                  VALUES (
                      7,
                      2,
                      '9fbca8386299ff1d3a765ecb3372ac5f34d75305511a8c021b7f2c250d495799'
                  );


-- Table: Message
DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id       INTEGER  NOT NULL
                      PRIMARY KEY AUTOINCREMENT,
    message  TEXT     NOT NULL,
    receiver INTEGER  NOT NULL
                      REFERENCES User (id) ON DELETE CASCADE
                                           ON UPDATE CASCADE,
    sender   INTEGER  NOT NULL
                      REFERENCES User (id) ON DELETE CASCADE
                                           ON UPDATE CASCADE,
    date     DATETIME CONSTRAINT [Post Date] DEFAULT (datetime('now') ) 
                      NOT NULL
);

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        29,
                        'I have canceled my reservation of the property T1 for 2 people in Porto between the days 2020-11-30 and 2028-12-01.',
                        10,
                        9,
                        '2019-12-11 21:01:43'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        30,
                        'I have canceled my reservation of the property VB between the days 2020-07-14 and 2021-07-28.',
                        10,
                        9,
                        '2019-12-11 21:01:44'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        31,
                        'I have canceled my reservation of the property T3 for 3 people in Lisbon between the days 2020-07-14 and 2021-07-28.',
                        10,
                        9,
                        '2019-12-11 21:01:48'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        34,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:50'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        35,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        36,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        37,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        38,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        39,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        40,
                        'dfsds',
                        10,
                        9,
                        '2019-12-12 13:13:51'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        43,
                        'aaaa',
                        10,
                        9,
                        '2019-12-12 13:14:31'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        44,
                        'aaaa',
                        10,
                        9,
                        '2019-12-12 13:14:34'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        45,
                        'ssss',
                        10,
                        9,
                        '2019-12-12 13:15:32'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        46,
                        'asdasd',
                        10,
                        9,
                        '2019-12-12 13:17:54'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        47,
                        'asdasd',
                        10,
                        9,
                        '2019-12-12 13:17:59'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        48,
                        'asdasd',
                        10,
                        9,
                        '2019-12-12 13:17:59'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        49,
                        'asdasd',
                        10,
                        9,
                        '2019-12-12 13:17:59'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        50,
                        'ddd',
                        10,
                        9,
                        '2019-12-12 13:26:31'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        51,
                        'jjj',
                        10,
                        9,
                        '2019-12-12 13:54:50'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        57,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:39'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        58,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:39'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        59,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:40'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        60,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:40'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        61,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:40'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        62,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:42'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        63,
                        'dsfdsf',
                        10,
                        9,
                        '2019-12-12 14:11:42'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        64,
                        'ola',
                        10,
                        9,
                        '2019-12-12 14:12:04'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        65,
                        'adsddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
                        10,
                        9,
                        '2019-12-12 15:30:47'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        66,
                        'Ok I understand that',
                        9,
                        10,
                        '2019-12-12 17:16:18'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        67,
                        'testasddddddddddddddddddddddddd',
                        10,
                        11,
                        '2019-12-12 21:24:41'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        68,
                        'a',
                        9,
                        10,
                        '2019-12-12 22:04:55'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        69,
                        'a',
                        9,
                        10,
                        '2019-12-12 22:04:55'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        70,
                        'asdd',
                        9,
                        10,
                        '2019-12-12 22:05:02'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        71,
                        'dsadsadasdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                        9,
                        10,
                        '2019-12-12 22:05:09'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        72,
                        'adssadasdsadasdasdsadas',
                        9,
                        10,
                        '2019-12-12 22:05:12'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        73,
                        'asddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
                        9,
                        10,
                        '2019-12-12 22:05:21'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        75,
                        'fdssdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff',
                        9,
                        10,
                        '2019-12-12 22:19:48'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        76,
                        'ok',
                        10,
                        9,
                        '2019-12-14 23:25:53'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        77,
                        'Ok test',
                        12,
                        9,
                        '2019-12-15 16:18:25'
                    );

INSERT INTO Message (
                        id,
                        message,
                        receiver,
                        sender,
                        date
                    )
                    VALUES (
                        79,
                        'MAX TEST: AWDAWDJIAVWFDAOWI*DCFAWPJIRYUIPJDRTFGYUHJIFDFGHJDSDFGHJKSASDFGHJHGFDSASDFGHJHGFDSASDFGHJKJHGFDSASDFGHJKJHGFDSASDFGHJJHGFDSASDFGHJKJGFDSDFG',
                        10,
                        9,
                        '2019-12-15 16:37:51'
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

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         1,
                         10,
                         'Lisbon',
                         'Rua do Castro',
                         42,
                         NULL,
                         '2017-06-18',
                         55,
                         2,
                         0,
                         'T2 Lisbon',
                         'Wonderful house',
                         0
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         2,
                         10,
                         'Madrid',
                         'Passeo del Prado',
                         243,
                         51,
                         '2018-08-21',
                         78,
                         3,
                         5,
                         'T2 for 2 people in Madrid',
                         'Wonderful house',
                         1
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         3,
                         10,
                         'Porto',
                         'Avenida da Boavista',
                         35,
                         NULL,
                         '2019-12-10',
                         47,
                         4,
                         5,
                         'T3 for 4 people in Porto',
                         'Wonderul house',
                         0
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         4,
                         9,
                         'Vila do Conde',
                         'Test street',
                         81,
                         NULL,
                         '2019-12-04',
                         81,
                         4,
                         5,
                         'Test Houseadffffsfgkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkko',
                         'This is a test.',
                         0
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         5,
                         10,
                         'Porto',
                         'Ok',
                         90,
                         NULL,
                         '2019-12-05',
                         20,
                         3,
                         4,
                         'VB',
                         'Test',
                         0
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         6,
                         10,
                         'Porto',
                         'Rua do José',
                         182,
                         31,
                         '2019-03-04',
                         28,
                         2,
                         5,
                         'T1 for 2 people in Porto',
                         'Best place ever',
                         1
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         7,
                         10,
                         'Lisbon',
                         'Rua dos Quintais',
                         97,
                         64,
                         '2018-05-16',
                         57,
                         3,
                         0,
                         'T3 for 3 people in Lisbon',
                         'Best place ever',
                         1
                     );

INSERT INTO Property (
                         id,
                         user_id,
                         city,
                         street,
                         door_number,
                         apartment_number,
                         post_date,
                         price_day,
                         guests,
                         rating,
                         title,
                         description,
                         property_type
                     )
                     VALUES (
                         8,
                         10,
                         'Porto',
                         'asdfasdasd',
                         12,
                         NULL,
                         '2019-12-13',
                         12,
                         1,
                         0,
                         'asdsad',
                         'asdsadasd',
                         0
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

INSERT INTO Rented (
                       id,
                       initial_date,
                       final_date,
                       property_id,
                       user_id,
                       price,
                       adults,
                       children,
                       babies
                   )
                   VALUES (
                       1,
                       '2019-12-30',
                       '2020-01-01',
                       4,
                       9,
                       243,
                       1,
                       0,
                       0
                   );

INSERT INTO Rented (
                       id,
                       initial_date,
                       final_date,
                       property_id,
                       user_id,
                       price,
                       adults,
                       children,
                       babies
                   )
                   VALUES (
                       5,
                       '2020-02-05',
                       '2021-02-20',
                       1,
                       9,
                       140,
                       3,
                       0,
                       0
                   );

INSERT INTO Rented (
                       id,
                       initial_date,
                       final_date,
                       property_id,
                       user_id,
                       price,
                       adults,
                       children,
                       babies
                   )
                   VALUES (
                       8,
                       '2019-12-12',
                       '2019-12-21',
                       1,
                       9,
                       495,
                       1,
                       0,
                       0
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
                     CHECK (age > 0),
    rating   INTEGER CHECK ( (rating >= 0 AND 
                              rating <= 5) OR 
                             NULL),
    image    STRING  UNIQUE
);

INSERT INTO User (
                     id,
                     email,
                     password,
                     name,
                     age,
                     rating,
                     image
                 )
                 VALUES (
                     9,
                     'lr@gmail.com',
                     '$2y$10$WbV84AlsZMjN/y3clBlUiOn6gw6Gr8rZWiAuoGEVfIvIAf34yHQEe',
                     'Luís Ramos',
                     21,
                     NULL,
                     '732ef6928194656ca54596d66591525ba5c27a04b3e2c955a3a3b7cb32ae81b6'
                 );

INSERT INTO User (
                     id,
                     email,
                     password,
                     name,
                     age,
                     rating,
                     image
                 )
                 VALUES (
                     10,
                     'ms@gmail.com',
                     '$2y$10$Y/ZXht4wiN0kj.soGQFt4OD2dWOfubD.KysSvVvJsGkij.DjBJIzS',
                     'Martim Pinto da Silva',
                     21,
                     NULL,
                     '828d04fa8687f3fe84dde76883b09d039b9c15bed9123581518c1f719ba8c20f'
                 );

INSERT INTO User (
                     id,
                     email,
                     password,
                     name,
                     age,
                     rating,
                     image
                 )
                 VALUES (
                     11,
                     'dsadsadsa',
                     'dsadsadsa',
                     'testasddddddddddddddddddddddddddddddddddddddddddddddddd',
                     222,
                     NULL,
                     NULL
                 );

INSERT INTO User (
                     id,
                     email,
                     password,
                     name,
                     age,
                     rating,
                     image
                 )
                 VALUES (
                     12,
                     'ls@gmail.com',
                     '$2y$10$cGU9KiO7ls5dBgggXExUUugBuF.sfVH4pv6PJNlBkaFwstva15HuC',
                     'Morto',
                     21,
                     NULL,
                     '693626f48f32faa3584f7c4644300da2ffd749e0e26853e6a43f8bc753c88405'
                 );


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

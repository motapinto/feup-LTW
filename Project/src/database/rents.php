<?php
    include_once('../includes/database.php');      // connects to the database

    // returns all rents done by user
    function getAllRentsByUser($user) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Rented WHERE 
                              user_id = ?
                              ORDER BY initial_date');
        $stmt->execute(array($user));

        return $stmt->fetchAll();
    }

    // returns all rents related properties of owner
    function getAllRentsByOwner($owner) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT R.id AS id, initial_date, final_date, property_id, R.user_id AS user_id
                                FROM Rented AS R, Property AS P 
                                WHERE R.property_id = P.id, P.user_id = ?
                                ORDER BY initial_date');
        $stmt->execute(array($owner));

        return $stmt->fetchAll();
    }

    // returns all rents listed for property
    function getAllRentsByProperty($property) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Rented WHERE 
                              property_id = ?
                              ORDER BY initial_date'
                            );

        $stmt->execute(array($property));

        return $stmt->fetchAll();
    }

    // Adds a new rent to the database
    function addRent($user, $property, $initial_date, $final_date) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Rented (
                user_id,
                property_id,
                initial_date,
                final_date
            )
            VALUES (?, ?, ?, ?);
        ');
        $stmt->execute(array($user, $property, $initial_date, $final_date));
        $message = $stmt->fetch();
        return $message !== false;
    }
?>

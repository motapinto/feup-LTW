<?php
    include_once('../includes/database.php');      // connects to the database

    // Returns all listings
    function getAllListings() {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Returns listing with id = id
    function getListingById($id) {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property WHERE id = ? ORDER BY price_day');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns all listings with city = city
    function getListingByCity($city) {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? ORDER BY price_day');
        $stmt->execute(array($city));
        return $stmt->fetchAll();
    }

    // Returns all listings with city = city && street = street
    function getListingByStreet($city, $street) {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? AND street = ? ORDER BY price_day');
        $stmt->execute(array($city), array($street));
        return $stmt->fetchAll();
    }

    // Returns all listings wtih price < price_day
    function getListingsBelowPrice($price) {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property WHERE price_day < price ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /Returns all available listings
    function getListingsAvailable() {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM Property WHERE available == true ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
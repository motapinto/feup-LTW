<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    // Returns all listings
    function getAllListings() {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Returns listing with id = id
    function getListingById($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property WHERE id = ? ORDER BY price_day');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns all listings with city = city
    function getListingByCity($city) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? ORDER BY price_day');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    // Returns all listings with city = city && street = street
    function getListingByStreet($city, $street) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? AND street = ? ORDER BY price_day');
        $stmt->execute(array($city), array($street));
        return $stmt->fetchAll();
    }

    // Returns all listings wtih price < price_day
    function getListingsBelowPrice($price) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property WHERE price_day < price ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /Returns all available listings
    function getListingsAvailable($price) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property WHERE available == true ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }


?>
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

        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns listing with city = city
    function getListingByCity($city) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns listing with city = city && street = street
    function getListingByStreet($city, $street) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns all listings wtih price < price_day
    function getListingsBelowPrice($price) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /Returns all available listings
    function getListingsAvailable($price) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }


?>
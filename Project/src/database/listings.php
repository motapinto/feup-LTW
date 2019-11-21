<?php
    include_once('../includes/database.php');      // connects to the database

    // Adds a listing
    function addListing($user_id, $title, $description, $price_day, $guests, $city, $street, $door_number, $apartment_number, $property_type) {
        $db = Database::instance()->db();
        $stmt;

        switch ($property_type) {
            case 0:
                $stmt = $db->prepare('INSERT INTO Property (
                  user_id,
                  title,
                  description,
                  price_day,
                  guests,
                  city,
                  street,
                  door_number,
                  property_type
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?)');
                $stmt->execute(array($user_id, $title, $description, $price_day,
                                     $guests, $city, $street, $door_number,
                                     $property_type));
                break;
            
            case 1:
                $stmt = $db->prepare('INSERT INTO Property (
                  email,
                  title,
                  description,
                  price_day,
                  guests,
                  city,
                  street,
                  door_number,
                  apartment_number,
                  property_type
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute(array($email, $title, $description, $price_day,
                                     $guests, $city, $street, $door_number,
                                     $apartment_number, $property_type));
                break;
            
            default:
                return false;
        }
        $result = $stmt->fetch();
        return !$result?false:true;
    }

    // Returns all listings
    function getAllListings() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Returns listing with id = id
    function getListingById($id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE id = ? ORDER BY price_day');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns listing with email = email
    function getListingsByEmail($email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE email = ?');
        $stmt->execute(array($email));
        return $stmt->fetchAll();
    }

    // Returns all listings with city = city
    function getListingByCity($city) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? ORDER BY price_day');
        $stmt->execute(array($city));
        return $stmt->fetchAll();
    }

    // Returns all listings with city = city && street = street
    function getListingByStreet($city, $street) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE city = ? AND street = ? ORDER BY price_day');
        $stmt->execute(array($city), array($street));
        return $stmt->fetchAll();
    }

    // Returns all listings wtih price < price_day
    function getListingsBelowPrice($price) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE price_day < price ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /Returns all available listings
    function getListingsAvailable() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE available == true ORDER BY price_day');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
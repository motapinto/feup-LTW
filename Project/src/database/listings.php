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
        return $db->lastInsertId();
    }
    
    // Returns listing with id = id
    function getListingById($id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE id = ? ORDER BY price_day');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Returns listing with user_id = user_id
    function getListingsByUser($user_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property WHERE user_id = ?');
        $stmt->execute(array($user_id));
        return $stmt->fetchAll();
    }

    function getListingsFilter($type=null, $price=null, $city=null, $street=null, $checkin=null, $checkout=null) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
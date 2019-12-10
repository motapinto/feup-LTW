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

    function getListingsFilter($types=array(), $priceLow=0, $priceHigh='PHP_INT_MAX', $city='%', $checkdates = false, $checkin='now', $checkout='01-01-2300') {
        $db = Database::instance()->db();

        $return = array();
        
        if($checkdates){
            foreach ($types as $type) {
                $stmt = $db->prepare('SELECT * 
                                      From Property AS P
                                      WHERE price_day >= ? AND price_day <= ? AND 
                                      city LIKE ? AND property_type = ? AND id NOT IN (
                                          SELECT DISTINCT Property.id
                                          FROM Property, Rented 
                                          WHERE Property.id = property_id AND (julianday(?) BETWEEN julianday(initial_date) AND julianday(final_date)
                                          OR julianday(?) BETWEEN julianday(initial_date) AND julianday(final_date)
                                          OR julianday(initial_date) BETWEEN julianday(?) AND julianday(?)))'
                                    );
                $stmt->execute(array($priceLow, $priceHigh, $city, $type, $checkin, $checkout, $checkin));
                $return = array_merge($return, $stmt->fetchAll());
            }
        }
        else {
            foreach ($types as $type) {
                $stmt = $db->prepare('SELECT * 
                                      FROM Property
                                      WHERE price_day >= ? AND price_day <= ? 
                                      AND city LIKE ? AND property_type = ?');
                $stmt->execute(array($priceLow, $priceHigh, $city, $type, $offset));
                $return = array_merge($return, $stmt->fetchAll());
            }
        }

        return $return;
    }

    function getAllListings() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getMaxPrice(){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT price_day FROM Property ORDER BY price_day DESC LIMIT 1');
        $stmt->execute();
        return $stmt->fetch();
    }

    function getMinPrice(){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT price_day FROM Property ORDER BY price_day ASC LIMIT 1');
        $stmt->execute();
        return $stmt->fetch();
    }

    function getCities(){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT DISTINCT city FROM Property');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
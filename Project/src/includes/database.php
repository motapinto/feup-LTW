<!-- Idea based on fare-niente page: André Restivo-->
<!-- Previously in database/connection.php -->

<?php
    /**
     * A singleton representing the app connection 
     * to the database. Use Database::instance() to 
     * access it and getDB() to get the database connection.
     */
    class Database {
        private static $instance = NULL;
        private $db = NULL;

        private function __construct() {
            try {
                $db = new PDO('sqlite:'.__DIR__.'/campus_rentals.db');
            }
            catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
                exit;
            }
            //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            print("1\n");
            //$this->db->query('PRAGMA foreign_keys = ON');
            print("2\n");
            if (NULL == $this->db) 
                throw new Exception("Failed to open database");
            
            print("2\n");
        }

        public function getDB() {
            return $this->db;
        }

        static function instance() {
            if (NULL == self::$instance) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
    }
?>
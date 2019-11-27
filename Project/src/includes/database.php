<?php
    /**
     * A singleton representing the app connection 
     * to the database. Use Database::instance() to 
     * access it and db() to get the database connection.
     */
    class Database {
        private static $instance = null;
        private $db;

        private function __construct() {
            try {
              $this->db = new PDO('sqlite:'.__DIR__.'/campus_rentals.db');
              $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
              $this->db->query('PRAGMA foreign_keys = ON');
            }
            catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
                exit;
            }
            if (!$this->db) 
                throw new Exception("Failed to open database");
        }

        public function db() {
            return $this->db;
        }

        public static function instance() {
            if (!self::$instance) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
    }
?>
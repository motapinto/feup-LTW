<?php
    include_once(__DIR__.'/connection.php');

    //Returns all news
    function getAllNews() {
        global $db;

        $stmt = $db->prepare('SELECT * FROM news');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Returns news with id = id
    function getNewsById($id) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

?>
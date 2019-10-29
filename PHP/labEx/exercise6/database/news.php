<?php

    include_once('database/connection.php');

    //Returns all news
    function getAllNews() {
        global $db;

        $stmt = $db->prepare(
            'SELECT news.*, users.*, 
            COUNT(comments.id) AS comments FROM news JOIN
            users USING (username) LEFT JOIN comments 
            ON comments.news_id = news.id GROUP BY news.id,
            users.username, ORDER BY published DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Returns news with id = id
    function getNewsById($id) {
        global $db;

        $stmt = $db->prepare(
            'SELECT * FROM news JOIN users USING (username) WHERE id = ?'
        );
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

?>
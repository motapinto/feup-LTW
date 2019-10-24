<?php
    include_once(__DIR__.'/connection.php');

    function getAllNews($db){
        $stmt = $db->prepare('SELECT * FROM news');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function getNews($db, $id){
        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();      
    }

    function getComments($db, $id){
        $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function updateNews($db, $id, $title, $introduction, $text){
        $stmt = $db->prepare('UPDATE news SET title = ?, introduction = ?, fulltext = ? WHERE id = ?');
        $stmt->execute(array($title, $introduction, $text, $id));
        return $stmt->fetchAll()?true:false;
    }
?>
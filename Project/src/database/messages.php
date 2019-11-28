<?php
    include_once('../includes/database.php');      // connects to the database

    // returns all messages from user with id=senderId to user with id=receiverId
    function getAllMessagesFromUser($receiverId, $senderId) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Message WHERE receiver = ? AND sender = ?');
        $stmt->execute(array($receiverId, $senderId));
        $messages = $stmt->fetchAll();

        if (!$messages) 
            return -1;
        
        else 
            return $messages;
    }

    // True if user with id=receiverId has received a message from user with id=senderId
    function haveExchangeMessages($receiverId, $senderId) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Message WHERE receiver = ? AND sender = ?');
        $stmt->execute(array($receiverId, $senderId));
        $messages = $stmt->fetchAll();

        if (!$messages) 
            return false;
        
        else 
            return true;
    }

    // Adds a new message to the database
    function addMessage($receiverId, $senderId, $message) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Message (
                message,
                receiver,
                sender,
            )
            VALUES (?, ?, ?);
        ');
        $stmt->execute(array($message, $receiverId, $senderId));
        $user = $stmt->fetch();
        return !$user?true:false;
    }
?>
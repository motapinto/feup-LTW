<?php
    include_once('../includes/database.php');      // connects to the database

    // returns all messages exchange between $user1 and $user2
    function getAllMessagesBetweenUsers($user1, $user2) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Message WHERE 
                              receiver = ? AND sender = ? OR
                              receiver = ? AND sender = ?
                              ORDER BY date');
        $stmt->execute(array($user1, $user2, $user2, $user1));
        $messages = $stmt->fetchAll();

        // have not exchange messages
        if (!$messages) 
            return -1;
        
        else 
            return $messages;
    }

    function getLastMessageFromConversation($user1, $user2) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT message FROM Message WHERE 
                              receiver = ? AND sender = ? OR
                              receiver = ? AND sender = ?
                              ORDER BY date LIMIT 1');
        $stmt->execute(array($user1, $user2, $user2, $user1));
        $message = $stmt->fetch();

        // have not exchange messages
        if (!$message) 
            return -1;
        
        // last message to display in messages sidebar menu
        else 
            return $message;
    }

    // returns all users id that have exchange messages with user
    function getAllMessengers($user) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT DISTINCT user FROM 
                              (
                                SELECT receiver as user, date FROM Message Where sender = ? 
                                UNION 
                                SELECT sender as user, date FROM Message Where receiver = ?
                              )
                              ORDER BY DATE;'
                            );

        $stmt->execute(array($user, $user));
        $users = $stmt->fetchAll();

        // have not exchange any messages with any user
        if (!$users) 
            return -1;
        
        //  return users id's
        else 
            return $users;
    }

    // Adds a new message to the database
    function addMessage($receiverId, $senderId, $message) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Message (
                message,
                receiver,
                sender
            )
            VALUES (?, ?, ?);
        ');
        $stmt->execute(array($message, $receiverId, $senderId));
        $message = $stmt->fetchAll();
        return $message !== false;
    }
?>
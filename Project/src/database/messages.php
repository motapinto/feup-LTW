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
                sender
            )
            VALUES (?, ?, ?);
        ');
        $stmt->execute(array($message, $receiverId, $senderId));
        $message = $stmt->fetch();
        return !$message?true:false;
    }
?>

<!-- Hey!21
Fatal error: Uncaught PDOException: SQLSTATE[23000]: 
Integrity constraint violation: 19 FOREIGN KEY constraint 
failed in C:\xampp\htdocs\feup-LTW\Project\src\database\messages.
php:45 Stack trace: #0 C:\xampp\htdocs\feup-LTW\Project\src\database
\messages.php(45): PDOStatement->execute(Array) #1 C:\xampp\htdocs\feup-LTW
\Project\src\actions\action_message_add.php(20): addMessage('Hey!', '2', '1') 
#2 {main} thrown in C:\xampp\htdocs\feup-LTW\Project\src\database\messages.php 
on line 45 -->

<!-- CREATE TABLE Message (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, message 
TEXT NOT NULL, receiver INTEGER NOT NULL REFERENCES User (id) ON DELETE 
CASCADE ON UPDATE CASCADE, sender INTEGER NOT NULL REFERENCES User (id) 
ON DELETE CASCADE ON UPDATE CASCADE, date DATE CONSTRAINT "Post Date" DEFAULT 
(date('now', '%d-%m-%Y'))) -->
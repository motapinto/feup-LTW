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

        // have not exchange any messages
        if (!$users) 
            return -1;
        
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
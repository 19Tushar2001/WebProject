<?php
   define('DB_DSN','mysql:host=localhost;dbname=tushar19;charset=utf8');
   define('DB_USER','Tushar19');
   define('DB_PASS','T4313385917');     

   // Create a PDO object called $db.
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    } 
?>
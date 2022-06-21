<?php 
    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=vet', 
            'root', 
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        print_r($pdo);
        //echo "Success";
    } catch (  PDOException $e ) {
        echo "Connection to DB wad failed!";
    } 
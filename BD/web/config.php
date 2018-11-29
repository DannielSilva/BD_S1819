<?php
    $host = "db.ist.utl.pt";
    $user ="ist186409";
    $password = "mypassxxxx";
    $dbname = $user;

    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

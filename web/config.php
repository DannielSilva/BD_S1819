<?php
    $host = "db.ist.utl.pt";
    $user ="ist186409";
    $password = "SCTTOMARTOMARTOMAR";
    $dbname = $user;

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

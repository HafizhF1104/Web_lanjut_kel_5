<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=db_web_kel5', "root", ""); 
}
catch (PDOException $e) {
    print "Koneksi atau query bermasalah: " . $e->getMessage(). "<br/>";
    die();
}

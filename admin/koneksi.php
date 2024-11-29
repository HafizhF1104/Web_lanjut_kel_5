<?php
//$db=mysqli_connect('localhost','root','','db_tekom2a');

try{
    $db = new PDO('mysql:host=localhost;dbname=db_tekom2a', "root", ""); 
}
catch (PDOException $e) {
    print "Koneksi atau query bermasalah: " . $e->getMessage(). "<br/>";
    die();
}

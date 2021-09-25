<?php
$dbhost = 'localhost';
   $dbuser = 'dbuser';
   $dbpass = 'dbpass';
   $dbname = 'hunting';
   $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
   $number123 = $mysqli -> real_escape_string($_GET['n']);
   $event123 = $mysqli -> real_escape_string($_GET['e']);
   if ($number123 == "")
   {
      die();
   }
   $check = $mysqli->query("SELECT events FROM `numbers` WHERE number = $number123");
   print_r($check['events']);
   die();
   if ($check == '') {
    echo 'false';
   }else{
       echo 'true';
   }
   if ($mysqli->errno) {
    die();
   }
$mysqli->close();
die();
?>
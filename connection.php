<?php
$servername = "localhost";
$dbname = "coursework database";
$db_user = "root";
$db_pass = "";
// create connection
$db = new mysqli($servername,$db_user,$db_pass,$dbname);
//check our connection
if ($db->connect_error){
    die("connection failed: ".$db->connect_error);
}


?>
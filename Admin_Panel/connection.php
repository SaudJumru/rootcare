<?php
$host="localhost";
$user="root";
$pass="";
$dbname="root care";
$conn=new mysqli($host, $user, $pass, $dbname);
if($conn->connect_error){
    die("Database not connected");
}
?>
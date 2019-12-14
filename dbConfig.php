<?php
$dbname ="onlinestore";
$hostname="localhost";
$username="root";
$password="";
$con=new mysqli($hostname,$username,$password,$dbname);
if($con){
}
if($con->connect_error){
    die("Connection Failed  ".$con->connect_error);
}
?>
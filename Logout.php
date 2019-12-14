<?php

session_start();
    if(isset($_SESSION["userId"])){
    session_unset();
    header("location:index.php");
    }
?>
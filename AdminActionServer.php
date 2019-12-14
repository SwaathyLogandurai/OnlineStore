<?php
include_once('dbConfig.php');
session_start();
    if(isset($_SESSION["userId"])){
    $uId   = $_SESSION["userId"];
    }
    else
    header("location:index.php");
    
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    $selectedList = $_REQUEST["selectedList"];
    $selectedString="";

    foreach($selectedList as $value){
        $selectedString= $selectedString.$value.',';
    }    
    $selectedString=rtrim($selectedString, ",") ;  
    $Status =   $action == "reject" ? 0 : ( $action == "approve"? 1 : -1);  

    $updateStatusQuery = mysqli_query($con, "update seller set Status=$Status where seller_id in ($selectedString)");

    if($updateStatusQuery==true)
    echo 'Success';
}
   
<?php
include_once('dbConfig.php');
session_start();
    
    
if (isset($_REQUEST["umobile"])) {
    $umobile = $_REQUEST["umobile"];
    $upass = $_REQUEST["upass"];
    $query = mysqli_query($con, "select * from users where mobile=$umobile ");


    if (mysqli_num_rows($query) != 0) {
        $row   = mysqli_fetch_array($query);

        if ($upass != $row['password'])
            echo "Incorrect";
        else {
            $role = $row['role'];
            echo  $role;
            
            $_SESSION["userId"]=$row['id'];
            $_SESSION["userName"]=$row['name'];
                    

        }  
    } else {
        echo "NewUser";
    }
}

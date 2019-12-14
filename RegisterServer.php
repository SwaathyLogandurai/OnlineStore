<?php
include_once('dbConfig.php');
if (isset($_REQUEST["uname"])) {
    $uname = $_REQUEST["uname"];
    $upass = $_REQUEST["upass"];
    $urole = $_REQUEST["urole"];
    $ustore = $_REQUEST["ustore"];
    $uloc = $_REQUEST["uloc"];
    $uemail = $_REQUEST["uemail"];
    $umobile = $_REQUEST["umobile"];

    $validate=validateInputs($con,  $uname,$upass ,$urole ,$ustore ,$uloc,$uemail, $umobile);

    if($validate){


    if ($uname != "" || $upass != "" || $urole != "" ||  $uemail != "" || $umobile != "") {
        //User Record 
        $query = mysqli_query($con, "insert into users (name,password,role,email,mobile)
                            values('$uname','$upass','$urole','$uemail',$umobile)");


        $fetchUidQuery = mysqli_query($con, "select * from users where mobile=$umobile ");
        if (mysqli_num_rows($fetchUidQuery) != 0) {

            $row   = mysqli_fetch_array($fetchUidQuery);
            $uId   = $row['id'];
        }

        //Seller Record
        if ($urole == "Seller" && $ustore != "" &&  $uloc != "") {

            $sellerQuery = mysqli_query($con, "insert into seller (user_id,name,store_name,Location,Status)
                            values($uId,'$uname','$ustore','$uloc',-1)");
        }
        //Customer Record
        if ($urole == "Customer") {

            $customerQuery = mysqli_query($con, "insert into customer (user_id,name) values($uId,'$uname')");
        }
    }
    if ($query == true && (($urole == "Admin") || ($urole == "Seller" && $sellerQuery == true) || ($urole == "Customer" && $customerQuery == true)))
        echo 'Success';
}
}


function validateInputs($con,  $uname,$upass ,$urole ,$ustore ,$uloc,$uemail, $umobile)
{

    if ($uname == "" || $upass == "" || $urole == "Select" ||  $uemail == "" || $umobile == "") {
        echo "Empty";
        return false;
    }
    if ($urole == "Seller" && ($ustore == "" || $uloc == "")) {
        echo "Please fill Store details if you are a seller";
        return false;
    }

    $validateMblQuery = mysqli_query($con, "select * from users where mobile=$umobile");
    $validateEmailQuery = mysqli_query($con, "select * from users where email='$uemail'");

    if (mysqli_num_rows($validateMblQuery) != 0) {
        echo "MobileExist";
        return false;
    } elseif (mysqli_num_rows($validateEmailQuery) != 0) {
        echo "EmailExist";
        return false;
    }
    else{
        return true;
    }
}

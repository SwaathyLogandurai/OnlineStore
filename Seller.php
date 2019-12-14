<?php
include_once('dbConfig.php');
?>
<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="Assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="fontStyle">
<div class="logoutLink"> <a href="Logout.php">Logout</a></div>
  <div>
  <h3>Welcome  
    
    <?php
    
    session_start();
    echo $_SESSION["userName"];
    if(isset($_SESSION["userId"])){
    $uId   = $_SESSION["userId"];
    }
    else
    header("location:index.php");
    ?>
  </h3>
</div>
 

<?php
 $fetchSellerQuery = mysqli_query($con, "select * from seller where user_id=$uId ");
 if (mysqli_num_rows($fetchSellerQuery) != 0) {    
     $row   = mysqli_fetch_array($fetchSellerQuery);    
     $status =$row['Status'];        
     $_SESSION["sellerId"]=$row['seller_id'];
   
 }
if($status ==-1){//Pending Seller
  echo "Approval Pending with Admin.Please try logging in after sometime";
}
if($status ==1){//Active Seller
  $_SESSION["store"]=$row["store_name"];
  include_once('SellerHelper.php');
}
if($status ==0){//Rejected Seller
  echo "Approval Rejected by Admin.Please contact our Office";
}





?>
</body>

</html>
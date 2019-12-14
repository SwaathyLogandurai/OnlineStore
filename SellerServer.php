<?php
include_once('dbConfig.php');
session_start();

if (isset($_POST["productName"])) {
   $sellerId = $_SESSION["sellerId"];
   $productName = $_POST["productName"];
   $description = $_POST["description"];
   $price = $_POST["price"];
   $qty = $_POST["qty"];
   $img = $_FILES['file']['name'];
   $file = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));

   if ($sellerId != "" || $productName != "" || $price != "" ||  $qty != "" || $description != "") {
      $query = mysqli_query($con, "insert into products (Seller_Id,Product_name,Description,Price,Stock_qty,product_file)
                            values($sellerId,'$productName','$description',$price,$qty,'$file' )");
   }
   if ($query == true)
      echo 'Success';
}


if (isset($_REQUEST["action"])) {
   if ($_REQUEST["action"] == "delete") {
      $delId = $_REQUEST["delId"];
      $query = mysqli_query($con, "delete from products where Product_id = $delId");
      if ($query == true)
         echo 'Success';
   }
}
?>
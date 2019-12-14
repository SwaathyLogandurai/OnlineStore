

   <?php
   include_once('dbConfig.php');
   session_start();
   if (isset($_SESSION["userId"])) {
      $uId   = $_SESSION["userId"];
   }


   if (isset($_POST["action"])) {
      if ($_POST["action"] == "add") {
         $prodId = $_POST["prodId"];
         $userId = $_POST["userId"];
         $qty = $_POST["qty"];

         $cusquery = mysqli_query($con, "select customer_id from customer where user_id=$userId ");
         if (mysqli_num_rows($cusquery) != 0) {
            $row   = mysqli_fetch_array($cusquery);
            $custId = $row["customer_id"];
         }

         $cartCheckQry = mysqli_query($con, "select * from cart where customer_id=$custId and product_id =$prodId and status=0");
         if (mysqli_num_rows($cartCheckQry) != 0) {
            $delQry = mysqli_query($con, "delete from cart where customer_id=$custId and product_id =$prodId and status=0");
         }

         if ($custId != "" || $prodId != "" || $userId != "" ||  $qty != "") {
            $insquery = mysqli_query($con, "insert into cart (customer_id,user_id,product_id,quantity,Status)
                            values($custId,$userId,$prodId,$qty,0)");
         }
         if ($insquery == true)
            echo 'Success';
      }
   }




   if (isset($_POST["action"])) {
      if ($_POST["action"] == "delete") {
         $prodId = $_POST["prodId"];
         $userId = $_POST["userId"];
         $query = mysqli_query($con, "delete from cart where Product_id = $prodId and user_id=$userId and status=0");
         if ($query == true)
            echo 'Success';
      }
   }

   if (isset($_POST["action"])) {
      if ($_POST["action"] == "order") {
         $userId = $_POST["userId"];
         //cart 

         $cartItemsQry = mysqli_query($con, "select c.product_id,c.quantity,p.price,c.customer_id,p.seller_id   
   from cart c, products p where c.user_id=$userId and c.status=0 and c.product_id = p.product_id");
         if (mysqli_num_rows($cartItemsQry) != 0) {
            while ($row   = mysqli_fetch_array($cartItemsQry)) {
               $prodId = $row["product_id"];
               $quantity = $row["quantity"];
               $price = $row["price"];
               $customer_id = $row["customer_id"];
               $seller_id = $row["seller_id"];
               
               $insOrdDtlquery = mysqli_query($con, "insert into order_details (product_id,quantity,price,status,customer_id,seller_id)
       values($prodId,$quantity,$price,'Pending',$customer_id,$seller_id)");

         $insOrdHstquery = mysqli_query($con, "insert into order_history (customer_id,seller_id,status)
       values($customer_id,$seller_id,'Pending')");
            }
         }
         $cartStatusQry = mysqli_query($con, "update cart set status=1 where user_id=$userId and status=0");

         

         if ($cartStatusQry == true)
            echo 'Success';
      }
   }

   if (isset($_POST["action"])) {
      if ($_POST["action"] == "fetch") {
         $cartCheckQry = mysqli_query($con, "select * from cart where customer_id in (select customer_id from customer where user_id= $uId )  and status=0");
         if (mysqli_num_rows($cartCheckQry) != 0) {
            echo "showItems";
         } else {
            echo "noItems";
         }
      }
   }

   if (isset($_POST["action"])) {
      if ($_POST["action"] == "recharge") {
         $amt = $_POST["amt"];

         $query = mysqli_query($con, "update customer set account_balance=account_balance+$amt where user_id=$uId");
         if ($query == true)
            echo 'Success';
      }
   }
   ?>
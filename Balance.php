<? include_once('dbConfig.php'); 
         session_start();
         if (isset($_SESSION["userId"])) {
         $uId   = $_SESSION["userId"];
         } 
?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="Assets/Shopping.js"></script>
  <link rel="stylesheet" href="Assets/style.css">
</head>

<div class="container-fluid balanceCart">
    <div class="row">
        <div class="card  ">
            <div class="row">
                <b class="">Current Balance : Rs. </b>

                <?php
              $bal = "";
              $query = mysqli_query($con, "select format(account_balance,2) account_balance from customer where customer_id in 
              (select customer_id from customer where user_id= $uId )");
              while ($row   = mysqli_fetch_array($query)) {
                $bal = $row["account_balance"];
              }
              echo $bal;
              ?>
            <input type="hidden" value=<?php echo $bal?> id="balance">
            </div>
            <div class="row">
            <b class="">Add Amount : Rs. </b>
            <input type="text" class="amtBox" id="amtBox">

            </div>
            <div class="row">
            <button class="btn-primary" onclick="recharge()">Recharge </button>

            </div>

        </div>
    </div>
</div>
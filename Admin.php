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
    if(isset($_SESSION["userId"])){
    echo $_SESSION["userName"].",ADMIN";
    $uId   = $_SESSION["userId"];
    }
    else
    header("location:index.php");
    ?>
  </h3>
</div>
  <a href="AdminViewSeller.php">Seller Details</a>
  <a href="AdminViewCustomer.php">Customer Details</a>

</body>

</html>
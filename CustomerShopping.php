<!DOCTYPE html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Assets/style.css">
  <script src="Assets/Shopping.js"></script>
</head>

<body class="fontStyle mainPadding">
  <div class="row">
    <div class="col-md-11">
      <h3>Welcome

        <?php
        include_once('dbConfig.php');
        session_start();
        echo $_SESSION["userName"];
        if (isset($_SESSION["userId"])) {
          $uId   = $_SESSION["userId"];
        } else
          header("location:index.php");
        ?>
      </h3>
    </div>
    <div class="col-md-1 logoutPadding "> <a href="Logout.php">Logout</a></div>

  </div>
  <div class="navBar">
    <div class="row">
      <div class="col-md-9">

      </div>
      <div class="col-md-3">
        <div class="col-md-6">
          <span class="navLink" onclick="checkBalance()">Balance </span>
        </div>

        <div class="col-md-6">
          <span class="navLink" onclick="checkOrderHst()">Order History </span>
        </div>
      </div>

    </div>
  </div>

  <div class="productShow">
    <div class="row">

      <div class="col-md-9">
        <div class="row">
          <?php include("CustomerViewProducts.php"); ?>
        </div>
      </div>
      <div class="col-md-3 shoppingCartTotal">

        <?php include("ShoppingCart.php"); ?>
      </div>
    </div>
  </div>
  <!-- BALANCE POP -->
  <div class="balanceSheet" id="balanceSheet">
    <div class="popupHeader">
      ACCOUNT BALANCE
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true" onclick="closeFun();">&times;</span>
      </button>
    </div>
    <div class="popup">
    <?php include("Balance.php"); ?>

    </div>
  </div>
  <!-- ORDER POP -->
  <div class="orderSheet" id="orderSheet">
    <div class="popupHeader">
      ORDER HISTORY
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true" onclick="closeFun();">&times;</span>
      </button>
    </div>
    <div class="popup">
    <?php include("OrderDetails.php"); ?>

    </div>
  </div>
</body>

</html>
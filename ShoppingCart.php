<? include_once('dbConfig.php'); ?>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="Assets/Shopping.js"></script>
  <link rel="stylesheet" href="Assets/style.css">


</head>
<div>
  
  <div class="container-fluid noPrdDiv">
    <div class="row">
      <div class="card shoppingCartTotal cartScrollDiv">
        <div class="row">
          <b class="text-danger noitem">No Items in your cart</b>
        </div>

      </div>
    </div>
  </div>
  <div class="container-fluid cartDiv">
        <div class="row">
          <div class="card shoppingCartTotal cartScrollDiv">
          <span><b> Shopping Cart</b></span> 
            <div class="row">

              <b class="text-success">Items in your cart</b>

              <?php
              $cartList = "";
              $query = mysqli_query($con, "select p.product_file,p.product_name,c.quantity,p.product_id,
            format((c.quantity * p.Price),2) Price from cart c ,
            products p where c.product_id=p.product_id and c.user_id=$uId and c.Status=0");
              while ($row   = mysqli_fetch_array($query)) {
                $prodId = $row["product_id"];
                $cartList .= '
                <div class="col-lg-9 cartList">
                  <figure class="card card-product-grid card-lg"> 
                  <div class="row">
                    <a href="#" class="img-wrap" data-abc="true">
                    <img src="data:image/jpeg;base64,' . base64_encode($row['product_file']) . '" class="cartProd" id="prod_' . $prodId . '">
                    </a>
                    <a href="#" class="title" data-abc="true">' . $row["product_name"] . '</a>
                   
                  </div>

                    <figcaption class="info-wrap">
                      <div class="row">
                        <div class="col-md-6">  <a href="#" class="title" data-abc="true"> Qty : ' . $row["quantity"] . '</a> </div>
                        <div class="col-md-6"> <a href="#" class="title" data-abc="true">Rs. ' . $row["Price"] . '</a></div>

                      </div>
                    </figcaption>          
                  </figure>
                </div>
                <div class="col-lg-3 removebtn">
                <button type="button" class="btn btn-default btn-sm" id="prod_del_' . $prodId . '" onClick="deleteProduct(' . $prodId . ',' . $uId . ')">
          <span class="glyphicon glyphicon-remove"></span> <b class="text-danger"> Delete Item </b>
        </button>
        </div>';
              }
              echo $cartList;
              ?>

            </div>
          </div>
          <div class="card shoppingCartTotal">
            <div class="card-body">

              <dl class="dlist-align">
                <dd>Total:</dd>

                <?php
                $total = 0.00;

                $totalquery = mysqli_query($con, "select sum(format((c.quantity * p.Price),2) ) total from cart c ,
            products p where c.product_id=p.product_id and c.user_id=$uId and c.Status=0");
                while ($row   = mysqli_fetch_array($totalquery)) {
                  $total = $row["total"];
                }
                ?>
                <input type="hidden" value=<?php echo $total?> id="totalOrder">

                <dd class="text-right text-dark b ml-3"><strong>Rs.<?php echo $total ?></strong></dd>
              </dl>
              <hr> <a href="#" class="btn btn-out btn-success btn-square btn-main" data-abc="true" onClick="makePurchase(<?php echo $uId ?>)"> Make Purchase </a>

            </div>
          </div>
        </div>
      </div>
    </div>
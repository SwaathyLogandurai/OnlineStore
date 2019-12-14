<?php
$query = mysqli_query($con, "select * from products");
  $prodId=0;
  $productList="";
  while ($row   = mysqli_fetch_array($query)) {
    $prodId=$prodId+1;
    $qty=$row["Stock_qty"];
    $stockQty=$row["Stock_qty"];
    $productIdDB=$row["Product_id"];
  $productList.='
<div class="col-md-3">
        <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true">
          <img src="data:image/jpeg;base64,' . base64_encode($row['product_file']) .'" class="prodStyle" id="prod_'.$prodId.'"></a>
          <figcaption class="info-wrap">
            <div class="row">
              <div> <a href="#" class="title" data-abc="true">'.$row["Product_name"].'</a> </div>
              
            </div>
          </figcaption>
          <div class="bottom-wrap"> 
          <button name="incqty" id="incBtn" onClick="incQty('.$prodId.','.$stockQty.')">+</button>
          <input type="text" size="1" name="item" id="qtyBox_'.$prodId.'" value=1 onchange="qtyChange(this.value,'.$stockQty.','.$prodId.')">
          <button name="decqty" onClick="decQty('.$prodId.')">-</button>
          <a href="#" class="btn btn-primary float-right" data-abc="true" onClick="addtoCart('.$prodId.','.$productIdDB.','.$uId.')"> Add to Cart</a>
            <div class="price-wrap"> <span class="price h5">Rs.'. $row["Price"].'</span> <br> 
            <small class="text-success">'.$row["Description"].'</small> </div>
          </div>
        </figure>
      </div>';
  }
  echo $productList;
 ?>
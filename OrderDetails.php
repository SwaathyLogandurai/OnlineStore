<?
session_start();
if (isset($_SESSION["userId"])) {
  $uId   = $_SESSION["userId"];
}
?>

<head>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
  <script src="Assets/Shopping.js"></script>
  <link rel="stylesheet" href="Assets/style.css">
</head>

<div class="container-fluid balanceCart">
  <?php
  include_once('dbConfig.php');

  $output = ' <table class="productsList ordDetails">
    <tr>
    <th nowrap>Order Number</th>
    <th>Product </th>
    <th> Price </th>
    <th> Quantity </th>
    <th>Status</th>
    </tr>
';
  $query = mysqli_query($con, "select * from order_details o,products p where o.product_id=p.product_id");

  while ($row   = mysqli_fetch_array($query)) {
    $output .=  '
<tr>
<td>ORD#' . $row["order_id"] . '</td>
<td>
 <img src="data:image/jpeg;base64,' . base64_encode($row['product_file']) . '" height="60" width="75" class="img-thumbnail" />
<div><p>' . $row["Product_name"] . '</p></div>
</td>
<td>Rs.' . $row["Price"] . '</td>
<td>' . $row["quantity"] . '</td>
<td>' . $row["status"] . '</td>

</tr>
';
  }
  $output .= '</table>';
  echo $output;
  ?>

</div>
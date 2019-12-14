<head>
  <link rel="stylesheet" href="Assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="Assets/Seller.js"></script>

</head>

<body>

  <form id="image_form" method="post" enctype="multipart/form-data">
    <div class="productsHeader">Products Of
      <?php
      include_once('dbConfig.php');

      echo $_SESSION["store"] . " Store";
      ?>
    </div>
    <table>
      <tr>
        <td> Image : </td>
        <td><input type="file" name="file" id="file"> </td>
        <td> Product Name : </td>
        <td><input type="text" name="productName" id="productName"></td>
      </tr>
      <tr>
        <td>Price :</td>
        <td> <input type="text" name="price" id="price"></td>
        <td>Quantity : </td>
        <td><input type="text" name="qty" id="qty"></td>
      </tr>
      <tr>
        <td>Description : </td>
        <td><textarea name="description" id="description"></textarea></td>
        <td><input type="submit" value="Add Products" id="addProducts" /></td>
      </tr>
    </table>
  </form>
  <div>
    <?php
      $output = '
      <table class="productsList">  
       <tr>
        <th>ID</th>
        <th>PRODUCT NAME</th>
        <th>PRICE</th>
        <th>DESCRIPTION</th>
        <th>QUANTITY</th>
        <th>PRODUCT IMAGE</th>
        <th>DELETE PRODUCT</th>
       </tr>
     ';
   
   
         $query = mysqli_query($con, "select * from products");
   
         while ($row   = mysqli_fetch_array($query)) {
            $output .= '
   
       <tr>
        <td>' . $row["Product_id"] . '</td>
        <td>' . $row["Product_name"] . '</td>
        <td>' . $row["Price"] . '</td>
        <td>' . $row["Description"] . '</td>
        <td>' . $row["Stock_qty"] . '</td>
        <td>
         <img src="data:image/jpeg;base64,' . base64_encode($row['product_file']) . '" height="60" width="75" class="img-thumbnail" />
        </td>
        <td><input type="button" name="delete" class="delete" id="' . $row["Product_id"] . '" value="Remove"/></td>
       
   </tr>
      ';
         }
         $output .= '</table>';
         echo $output;
      
   
    ?>

  </div>

</body>
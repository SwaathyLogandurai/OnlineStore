<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="Assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

</html>
<?php
include_once('dbConfig.php');
session_start();
echo '<div class="logoutLink"> <a href="Logout.php">Logout</a></div>';
if (isset($_SESSION["userId"])) {
    $uId   = $_SESSION["userId"];
} else
    header("location:index.php");

if (isset($_REQUEST["sellerid"])) {
    $sellerId   = $_REQUEST["sellerid"];
}
if (isset($_REQUEST["sname"])) {
    $sname   = $_REQUEST["sname"];
}

$query = mysqli_query($con, "select p.*,s.name from products p,seller s where p.Seller_id = $sellerId and p.Seller_id=s.seller_id");

if (mysqli_num_rows($query) == 0) {
    echo "Sorry ,seller not registered any products";
} else {

    echo "
    <h3>PRODUCTS LIST of $sname SELLER</h3>
    <table class='productsList' id='productsList'>
    <tr>
    <th>PRODUCT ID</th>
    <th>PRODUCT NAME</th>
    <th>SELLER NAME</th>
    <th>AVAILABLE QUANTITY</th>
    <th>PRICE</th>
    <th>DESCRIPTION</th>
    </tr>
    </table> 
    ";



    while ($row   = mysqli_fetch_array($query)) {
        $p_id = $row['Product_id'];
        $p_name = $row['Product_name'];
        $seller_name = $row['name'];
        $qty = $row['Stock_qty'];
        $price = $row['Price'];
        $description = $row['Description'];
        ?>

        <script>
            var rowData = "<tr><td><?php echo $p_id ?> </td><td> <?php echo $p_name ?>  </td><td><?php echo $seller_name ?></td>" +
                "<td><?php echo $qty ?></td><td><?php echo $price ?></td><td><?php echo $description ?></td></tr> ";
                $('#productsList').append(rowData);
        </script>
    <?php
    }
}
?>
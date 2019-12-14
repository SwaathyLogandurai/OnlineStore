<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="Assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="Assets/Admin.js"></script>
</head>

</html>
<?php
include_once('dbConfig.php');
session_start();
echo '<div class="logoutLink"> <a href="Logout.php">Logout</a></div>';
    if(isset($_SESSION["userId"])){
    echo '<p> Welcome '.$_SESSION["userName"].",ADMIN" .'</p>';
    $uId   = $_SESSION["userId"];
    }
    else
    header("location:index.php");

$query = mysqli_query($con, "select * from seller");

if (mysqli_num_rows($query) != 0) {

    echo "
    <h3>ACTIVE SELLERS</h3>
    <table class='sellerView' id='activeSeller'>
    <tr>
    <th>SELECT</th>
    <th>SELLER ID</th>
    <th>SELLER NAME</th>
    <th>STORE NAME</th>
    <th>LOCATION</th>
    </tr>
    </table> 
    <div class='divBtn'><input type='button' value='REJECT' class='btn' id='rejectActiveBtn'/></div>
    <hr/>
    ";

    echo "
    <h3>PENDING SELLERS</h3>
    <table class='sellerView' id='pendingSeller'>
    <tr>
    <th>SELECT</th>
    <th>SELLER ID</th>
    <th>SELLER NAME</th>
    <th>STORE NAME</th>
    <th>LOCATION</th>
    </tr>
    </table>
    <div class='divBtn'><input type='button' value='APPROVE' class='btn' id='approvePendingBtn'/>
    <input type='button' value='REJECT'class='btn' id='rejectPendingBtn'/></div>
    <hr/>";

    echo "
    <h3>REJECTED SELLERS</h3>
    <table class='sellerView' id='rejectedSeller'>
    <tr>
    <th>SELECT</th>
    <th>SELLER ID</th>
    <th>SELLER NAME</th>
    <th>STORE NAME</th>
    <th>LOCATION</th>
    </tr>
    </table>
    <div class='divBtn'><input type='button' value='APPROVE' class='btn' id='approveRejectBtn'/></div>
    <hr/>";


    while ($row   = mysqli_fetch_array($query)) {
        $s_id = $row['seller_id'];
        $s_name = $row['name'];
        $store = $row['store_name'];
        $location =$row['Location'];
        ?>
        <script>
            var checkBox;
            var rowData = "<td><?php echo $s_id ?> </td><td> <a href='SellerProducts.php?sellerid=<?php echo $s_id?>&sname=<?php echo $s_name ?>'> <?php echo $s_name ?> </a> </td>"+
            "<td><?php echo $store ?></td><td><?php echo $location ?></td></tr> ";
        </script>
        <?php if ($row['Status'] == 1) { ?>
            <script>
                checkBox = "<tr><td><input type='checkbox' name='active' value=<?php echo $s_id ?>></input></td>";
                $('#activeSeller').append(checkBox + rowData);
            </script>
        <?php }
                if ($row['Status'] == -1) { ?>
            <script>
                checkBox = "<tr><td><input type='checkbox' name='pending' value=<?php echo $s_id ?>></input></td>";
                $('#pendingSeller').append(checkBox+rowData);
            </script>
        <?php }
                if ($row['Status'] == 0) { ?>
            <script>
                checkBox = "<tr><td><input type='checkbox' name='rejected' value=<?php echo $s_id ?>></input></td>";
                $('#rejectedSeller').append(checkBox+rowData);
            </script>
        <?php }
    }
}


?>
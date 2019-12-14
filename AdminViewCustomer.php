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
if (isset($_SESSION["userId"])) {
    echo '<p> Welcome ' . $_SESSION["userName"] . ",ADMIN" . '</p>';
    $uId   = $_SESSION["userId"];
} else
    header("location:index.php");

$query = mysqli_query($con, "select * from users u,customer c where c.user_id = u.id and u.role='Customer'");

if (mysqli_num_rows($query) != 0) {

    echo "
    <h3>CUSTOMER DETAILS</h3>
    <table class='customerView' id='customerView'>
    <tr>
    <th>CUSTOMER ID</th>
    <th>CUSTOMER NAME</th>
    <th>MOBILE</th>
    <th>EMAIL</th>
    </tr>
    </table> 

    ";


    while ($row   = mysqli_fetch_array($query)) {
        $c_id = $row['customer_id'];
        $c_name = $row['name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        ?>
        <script>
            var rowData = "<tr><td><?php echo $c_id ?> </td><td><?php echo $c_name ?> </td><td><?php echo $mobile ?> </a> </td>" +
                "<td><?php echo $email ?></td></tr> ";
            $('#customerView').append(rowData);
        </script>



<?php }
}



?>
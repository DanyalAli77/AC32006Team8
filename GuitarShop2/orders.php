<?php session_start();
require_once ('config.php');

//select statement for getting order id.
$customerID= $_SESSION['id'];
$sql_order = "SELECT orderID FROM orders WHERE customerID = '$customerID'";
$res_order = mysqli_query($db, $sql_order);
$r_order = mysqli_fetch_assoc($res_order);

?>


<?php
include ('header_inside.php');
?>

<div class="container">
    <div class="page-header">
        <p></p>
        <h1>Order Summary</h1>
        <p>OrderID: <?php echo $r_order['orderID'];?></p>
    </div>

    <div class="row">
        <div class="col-sm">
            <?php
            //select statment for getting user shipping details
            $username = $_SESSION['username'];
            $sql = "SELECT firstname, lastname, address1, address2, postcode, country, phoneNo FROM users WHERE username = '$username'";
            $res = mysqli_query($db, $sql);
            $r = mysqli_fetch_assoc($res);
            ?>
            <p class="font-weight-bold">Shipping Details: </p>
            <p class="font-weight-normal"><?php echo $r['firstname'];?> <?php echo $r['lastname'];?></p>
            <p class="font-weight-normal"><?php echo $r['address1'];?></p>
            <p class="font-weight-normal"><?php echo $r['address2'];?></p>
            <p class="font-weight-normal"><?php echo $r['firstname'];?></p>
            <p class="font-weight-normal"><?php echo $r['postcode'];?></p>
            <p class="font-weight-normal"><?php echo $r['country'];?></p>
        </div>
        <div class="col-6">
            <p class="font-weight-bold text-left">Items:</p>
        </div>
    </div>

</div>

<?php
include ('footer.php');
?>

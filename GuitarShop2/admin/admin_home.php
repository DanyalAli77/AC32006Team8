<?php session_start();
/**
 * Created by PhpStorm.
 * User: Juura
 * Date: 08/11/2018
 * Time: 16:09
 */

require_once ('../config.php');

// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: index.php");
    exit;
}

if(isset($_POST['update'])) {
    $sql_update_order="UPDATE orders SET orderStatus='$value' WHERE orderID = '$orderID'";
    mysqli_query($db, $sql_update_order);
}



?>


<?php include ('admin_header.php') ?>


<?php
$sql = "SELECT users.firstname, users.lastname, users.address1, users.address2, users.city, users.postcode, orders.orderID, orders.orderStatus
FROM users
INNER JOIN orders ON orders.customerID=users.id;";
$res = mysqli_query($db, $sql);

$orderID = $r["orderID"];
//{
//    echo $r["firstname"] ." ";
//    echo $r["lastname"]." ";
//    echo $r["address1"]." ";
//    echo $r["address2"]." ";
//    echo $r["city"]." ";
//    echo $r["postcode"]." ";
//    echo $r["orderID"]." ";
//    echo $r["orderStatus"]." ";
//    echo '<br>';
//}
?>


<div class="container">
    <p></p>
    <h1> Orders </h1>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Order #</th>
            <th scope="col">Name</th>
            <th scope="col">Shipping info</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($r = mysqli_fetch_assoc($res)) {



            echo '<tr>';
            echo '<th scope="row">' . $r["orderID"] . '</th>';
                echo '<td>' .  $r["firstname"] . " " . $r["lastname"] . '</td>';
                echo '<td>' . $r["address1"] . ", " . $r["address2"] . ", " . $r["city"] . ", " . $r["postcode"] . '</td>';
                echo '<td>';
                echo '<form method="post" action="">';
                    echo '<select class="btn btn-mini" id="inlineFormCustomSelect" name="orderStatusForm">';
                        echo '<option value="Processing">' . "Processing" . '</option>';
                        echo '<option value="received">' . "Received" . '</option>';
                        echo '<option value="cancelled">' . "Cancelled" . '</option>';
                        echo '<option value="shipped">' . "Shipped" . '</option>';
                    echo '</select>';
                    echo '<input type="submit" name="update" value="update">';
                    echo '</form>';
                echo '</td>';
            echo '</tr>';

        }
        ?>
        </tbody>
    </table>
</div>
<?php include ('../footer.php') ?>




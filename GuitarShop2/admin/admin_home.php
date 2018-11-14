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




?>


<?php include ('admin_header.php') ?>


<?php
$sql = "SELECT users.firstname, users.lastname, users.address1, users.address2, users.city, users.postcode, orders.orderID, orders.orderStatus
FROM users
INNER JOIN orders ON orders.customerID=users.id;";
$res = mysqli_query($db, $sql);



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

                $orderID = $r["orderID"];

                if(isset($_POST[$orderID])) {
                    $value = $_POST['orderStatusForm'];
                    $sql_update_order="UPDATE orders SET orderStatus='$value' WHERE orderID = '$orderID'";
                    mysqli_query($db, $sql_update_order);
                    echo "<meta http-equiv='refresh' content='0'>";
                }

                $sql2 = "SELECT order_product.item1, 
                           order_product.item2, 
                           order_product.item3, 
                           order_product.item4,
                           order_product.item5,
                           order_product.item6,
                           order_product.item7,
                           order_product.item8,
                           order_product.item9,
                           order_product.item10
                    
                          FROM order_product
                          INNER JOIN products ON order_product.item1=products.id   WHERE order_product.orderID = $orderID";
                $res2 = mysqli_query($db, $sql2);
                $r2 = mysqli_fetch_assoc($res2);
                $item = $r2['item1'];

                $sql3="SELECT title, id from products where id= $item";
                $res3 = mysqli_query($db, $sql3);
                $r3 = mysqli_fetch_assoc($res3);
                echo $r3['title'];


                ?>
                <tr>
                <th scope="row"> <?php echo $r["orderID"] ?>


                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $orderID; ?>"> <?php echo $r["orderID"] ?></button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $orderID; ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">Products</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $r3['title'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </th>


                <td>  <?php echo $r["firstname"] ?>   <?php echo $r["lastname"] ?></td>
                <td>  <?php echo $r["address1"] ?> , <?php echo $r["address2"] ?> , <?php echo $r["city"] ?> , <?php echo $r["postcode"] ?> </td>
                    <td>
                        <form method="post" action="admin_home.php">
                            <select class="btn btn-mini" id="inlineFormCustomSelect" name="orderStatusForm">
                                <option value="<?php $r["orderStatus"];?>"> <?php if ($r["orderStatus"]=='Processing') { echo ""; } ?> <?php echo $r['orderStatus'];?> </option>
                                <option value="Processing"> <?php if ($r["orderStatus"]=='Processing') { echo ""; } ?> Processing </option>
                                <option value="Received"> <?php if ($r["orderStatus"]=='Received') { echo ""; } ?> Received </option>
                                <option value="Shipped"> <?php if ($r["orderStatus"]=='Shipped') { echo ""; } ?> Shipped </option>
                                <option value="Cancelled"> <?php if ($r["orderStatus"]=='Cancelled') { echo ""; } ?> Cancelled </option>
                                <option value="Completed"> <?php if ($r["orderStatus"]=='Completed') { echo ""; } ?> Completed </option>
                            </select>
                            <input type="submit" name="<?php echo $orderID;?>" value="update" onclick="window.location.reload(true);">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>

    </div>
<?php include ('../footer.php') ?>
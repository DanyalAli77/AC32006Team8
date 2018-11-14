<?php session_start();

require_once ('../config.php');

// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: index.php");
    exit;
}
?>

<?php include ('admin_header.php') ?>

<?php
$sql = "SELECT users.firstname, users.lastname, users.address1, users.address2, users.city, users.postcode,users.email, users.phoneNo, orders.orderID, orders.orderStatus
FROM users
INNER JOIN orders ON orders.customerID=users.id;";
$res = mysqli_query($db, $sql);

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

                ?>
                <tr>
                <th scope="row">


                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $orderID; ?>"> <?php echo $r["orderID"] ?></button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $orderID; ?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">OrderID: <?php echo $orderID;?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Contact details: </p>
                                    <h6> <?php echo $r["firstname"] ?>   <?php echo $r["lastname"] ?> ,  <?php echo $r["phoneNo"]?> ,  <?php echo $r["email"] ?> </h6>
                                    <p>Products: </p>
                                    <h6><?php while($row = mysqli_fetch_assoc($res2))
                                        {
                                            $item = $row['item1'];
                                            $sql3="SELECT title, id from products where id= $item";
                                            $res3 = mysqli_query($db, $sql3);
                                            $r3 = mysqli_fetch_assoc($res3);
                                            echo $r3['title']."<br>";
                                            $item2 = $row['item2'];
                                            if(empty($item2))
                                            {
                                                break;
                                            }
                                            $sql4="SELECT title, id from products where id= $item2";
                                            $res4 = mysqli_query($db, $sql4);
                                            $r4 = mysqli_fetch_assoc($res4);
                                            echo $r4['title']."<br>";
                                            $item3 = $row['item3'];
                                            if(empty($item3))
                                            {
                                                break;
                                            }
                                            $sql5="SELECT title, id from products where id= $item3";
                                            $res5 = mysqli_query($db, $sql5);
                                            $r5 = mysqli_fetch_assoc($res5);
                                            echo $r5['title']."<br>";
                                            $item4 = $row['item4'];
                                            if(empty($item4))
                                            {
                                                break;
                                            }
                                            $sql6="SELECT title, id from products where id= $item4";
                                            $res6 = mysqli_query($db, $sql6);
                                            $r6 = mysqli_fetch_assoc($res6);
                                            echo $r6['title']."<br>";
                                            $item5 = $row['item5'];
                                            if(empty($item5))
                                            {
                                                break;
                                            }
                                            $sql7="SELECT title, id from products where id= $item5";
                                            $res7 = mysqli_query($db, $sql7);
                                            $r7 = mysqli_fetch_assoc($res7);
                                            echo $r7['title']."<br>";
                                            $item6 = $row['item6'];
                                            if(empty($item6))
                                            {
                                                break;
                                            }
                                            $sql8="SELECT title, id from products where id= $item6";
                                            $res8 = mysqli_query($db, $sql8);
                                            $r8 = mysqli_fetch_assoc($res8);
                                            echo $r8['title']."<br>";
                                            $item7 = $row['item7'];
                                            if(empty($item7))
                                            {
                                                break;
                                            }
                                            $sql9="SELECT title, id from products where id= $item7";
                                            $res9 = mysqli_query($db, $sql9);
                                            $r9 = mysqli_fetch_assoc($res9);
                                            echo $r9['title']."<br>";
                                            $item8 = $row['item8'];
                                            if(empty($item8))
                                            {
                                                break;
                                            }
                                            $sql10="SELECT title, id from products where id= $item8";
                                            $res10 = mysqli_query($db, $sql10);
                                            $r10 = mysqli_fetch_assoc($res10);
                                            echo $r10['title']."<br>";
                                            $item9 = $row['item9'];
                                            if(empty($item9))
                                            {
                                                break;
                                            }
                                            $sql11="SELECT title, id from products where id= $item9";
                                            $res11 = mysqli_query($db, $sql11);
                                            $r11 = mysqli_fetch_assoc($res11);
                                            echo $r11['title']."<br>";
                                            $item10 = $row['item10'];
                                            if(empty($item10))
                                            {
                                                break;
                                            }
                                            $sql12="SELECT title, id from products where id= $item10";
                                            $res12 = mysqli_query($db, $sql12);
                                            $r12 = mysqli_fetch_assoc($res12);
                                            echo $r12['title']."<br>";

                                        } ?></h6>
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
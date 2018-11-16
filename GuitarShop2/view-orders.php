<?php session_start();


require_once ('config.php');

//select statement for getting order id.
$customerID= $_SESSION['id'];
$sql_order = "SELECT MAX(orderID) FROM orders WHERE customerID = '$customerID'";
$res_order = mysqli_query($db, $sql_order);
$r_order = mysqli_fetch_assoc($res_order);

unset($_SESSION['cart']);
?>

<?php
include ('header_inside.php');
?>

<div class="container">

    <div class="row">
        <div class="col-9">

                <?php
                $order_size = array(50);
                $username = $_SESSION['id'];

                $sql_count = "SELECT
  (`item1` IS NOT NULL) +
  (`item2` IS NOT NULL) +
  (`item3` IS NOT NULL) +
  (`item4` IS NOT NULL) + 
  (`item5` IS NOT NULL) +
  (`item6` IS NOT NULL) +
  (`item7` IS NOT NULL) +
  (`item8` IS NOT NULL) +
  (`item9` IS NOT NULL) +
  (`item10` IS NOT NULL) AS Count
FROM `order_product`
WHERE `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'    )";


                if(!$result = $db->query($sql_count)){
                    die('There was an error running the query [' . $db->error . ']');
                }

                $x = 0;
                while($row = $result->fetch_assoc()){
                    $order_size[$x] =$row["Count"];
                    $x++;
                }



                $item_titles = array(50);
                $item_price = array(50);


                $test = $_SESSION['id'];
                $sql1 = "SELECT orderID, orderDate, orderPrice, orderStatus FROM orders WHERE customerID = '$test';";
                $res1 = mysqli_query($db, $sql1);






                $itemIndex=0;
                $currentItemPostfix = 1;
                echo '<h1>Orders</h1>';
                while(($r1 = mysqli_fetch_assoc($res1))){

                    $orderID = $r1["orderID"];
                    $sql_items = "SELECT * FROM `order_product` WHERE `orderID`='$orderID'";

                    if(!$result = $db->query($sql_items)){
                        die('There was an error running the query [' . $db->error . ']');
                    }

                    $row = $result->fetch_assoc();

                    $current = "item1";

                    echo '<ul class="list-group mb-3" style="height:auto">';
                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    echo '<h6 class="my-0">' . "OrderID: " . '<i>' . $r1["orderID"] . '</i>' . "    ";
                    echo "Date: " . '<i>'. $r1["orderDate"] . '</i>'. " ";
                    echo "Total Cost: ". '<i>'."£" . $r1["orderPrice"] . '</i>'. " " . "Order Status: ". '<i>' . $r1['orderStatus'] . '</i>'. '</h6>';
                    echo '</li>';


                    $total_cost=0;

                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    for($x = 0; $x < 10; $x++)
                    {
                        $item=$row[$current];


                        $sql = "SELECT title, price FROM products WHERE id='$item' ";
                        $res = mysqli_query($db, $sql);
                        $r = mysqli_fetch_assoc($res);
                        //echo $r["title"] . '<br>';

                            $item_titles[$itemIndex] = $r["title"];
                            $item_price[$itemIndex] = $r['price'];

                        if(!empty($item_titles[$itemIndex]) && !empty($item_price[$itemIndex])) {
                        echo $item_titles[$itemIndex] . " " . " £" . $item_price[$itemIndex] . '<br>';


                        }
                        $itemIndex++;
                        $current = substr($current, 0, -1);


                        $currentItemPostfix++;
                        $current .= $currentItemPostfix;
                    }

                    echo '</li>';
                    echo '</ul>';
                    $currentItemPostfix = 1;
                    $itemIndex++;

                }
                $result->close();

                ?>

        </div>
    </div>


</div>


<?php
include ('footer.php');
?>

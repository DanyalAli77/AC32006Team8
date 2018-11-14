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
                $username = 1;

                $sql_count = "SELECT
  (`item1` IS NOT NULL) +
  (`item2` IS NOT NULL) +
  (`item3` IS NOT NULL) AS Count
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



                $sql_items = "SELECT * FROM `order_product`";

                if(!$result = $db->query($sql_items)){
                    die('There was an error running the query [' . $db->error . ']');
                }

                $item_titles = array(50);
                $item_price = array(50);


                $test = $_SESSION['id'];
                $sql1 = "SELECT orderID, orderDate, orderPrice FROM orders WHERE customerID = '$test';";
                $res1 = mysqli_query($db, $sql1);

                $i=0;
                $j = 1;
                echo '<h1>Orders</h1>';
                while(($r1 = mysqli_fetch_assoc($res1)) && ($row = $result->fetch_assoc())){

                    $current = "item1";

                    echo '<ul class="list-group mb-3" style="height:auto">';
                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    echo '<h6 class="my-0">' . "OrderID: " . $r1["orderID"] . "    ";
                    echo "Date: " . $r1["orderDate"] . " ";
                    //echo "Cost: " . $r1["orderPrice"] . '</h6>';
                    echo '</li>';


                    $total_cost=0;

                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    for($x = 0; $x < 12; $x++)
                    {
                        $item=$row[$current];


                        $sql = "SELECT title, price FROM products WHERE id='$item' ";
                        $res = mysqli_query($db, $sql);
                        $r = mysqli_fetch_assoc($res);
                        //echo $r["title"] . '<br>';

                            $item_titles[$i] = $r["title"];
                            $item_price[$i] = $r['price'];

                        if(!empty($item_titles[$i]) && !empty($item_price[$i])) {
                        echo $item_titles[$i] . " " . " £" . $item_price[$i] . '<br>';
                            $total_cost += $item_price[$i];
                        }
                        $i++;
                        $current = substr($current, 0, -1);


                        $j++;
                        $current .= $j;



                    }

                    echo '<br>';
                    echo "Total: £" . $total_cost;
                    echo '</li>';
                    echo '</ul>';
                    $j = 1;
                    $i++;


                }
                $result->close();



                ?>

        </div>
    </div>


</div>


<?php
include ('footer.php');
?>

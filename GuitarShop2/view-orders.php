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
                $order_size = array(10);
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

                $item_titles = array(10);
                $item_price = array(10);




                $i=0;
                $j = 1;
                while($row = $result->fetch_assoc()){

                    $current = "item1";

                    for($x = 0; $x < 5; $x++)
                    {
                        $item=$row[$current];


                        $sql = "SELECT title, price FROM products WHERE id='$item' ";
                        $res = mysqli_query($db, $sql);
                        $r = mysqli_fetch_assoc($res);
                        //echo $r["title"] . '<br>';

                        $item_titles[$i] = $r["title"];
                        $item_price[$i] = $r['price'];

                        echo $current . " " . $item_titles[$i] . '<br>';
                        $i++;
                        $current = substr($current, 0, -1);


                        $j++;
                        $current .= $j;



                    }
                    $j = 1;
                    $i++;


                }
                $result->close();


                $test = $_SESSION['id'];
                $sql = "SELECT orderID, orderDate, orderPrice FROM orders WHERE customerID = '$test';";
                $res = mysqli_query($db, $sql);


                $i = 0;
                $order_index=0;
                while($r = mysqli_fetch_assoc($res))
                {

                    echo '<ul class="list-group mb-3" style="height:auto">';
                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    echo '<h6 class="my-0">' . "OrderID: " . $r["orderID"] . " ";
                    echo "Date: " . $r["orderDate"] . " ";
                    echo "Cost: " . $r["orderPrice"] . '</h6>';
                    echo '</li>';

                    $aaah = 0;

                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    while($aaah < $order_size[$order_index]) {

                            echo $item_titles[$i] . '<br>';
                            echo $item_price[$i] . '<br>';



                        $i++;
                        $aaah++;

                    }
                    $order_index++;
                    echo '</li>';
                    echo '</ul>';

                }

                $sql->free();





                ?>

        </div>
        <div class="col-9">
            <p>test</p>
        </div>
    </div>


</div>


<?php
include ('footer.php');
?>

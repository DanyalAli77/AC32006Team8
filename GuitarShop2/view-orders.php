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
                $username = 1;

                $sql_items = "SELECT `item1` AS item1
    FROM  `order_product`
    WHERE `item1` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item2`
    FROM  `order_product`
    WHERE `item2` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'    )
    UNION ALL

    SELECT `item3`
    FROM  `order_product`
    WHERE `item3` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item4`
    FROM  `order_product`
    WHERE `item4` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item5`
    FROM  `order_product`
    WHERE `item5` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item6`
    FROM  `order_product`
    WHERE `item6` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item7` AS item2
    FROM  `order_product`
    WHERE `item7` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item8`
    FROM  `order_product`
    WHERE `item8` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item9`
    FROM  `order_product`
    WHERE `item9` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )
    UNION ALL

    SELECT `item10`
    FROM  `order_product`
    WHERE `item10` IS NOT NULL
    AND `orderID` in (
    select `orderID` from `orders` WHERE `customerID`='$username'
    )";




                if(!$result = $db->query($sql_items)){
                    die('There was an error running the query [' . $db->error . ']');
                }

                $item_titles = array(10);
                $item_price = array(10);

                $i=0;
                while($row = $result->fetch_assoc()){

                    $item=$row["item1"];

                    $sql = "SELECT title, price FROM products WHERE id='$item' ";
                    $res = mysqli_query($db, $sql);
                    $r = mysqli_fetch_assoc($res);
                    //echo $r["title"] . '<br>';

                    $item_titles[$i] = $r["title"];
                    $item_price[$i] = $r['price'];

                    $i++;
                }




                $test = $_SESSION['id'];
                $sql = "SELECT orderID, orderDate, orderPrice FROM orders WHERE customerID = '$test';";
                $res = mysqli_query($db, $sql);


                $i = 0;
                while($r = mysqli_fetch_assoc($res))
                {
                    $items=$row["item1"];

                    echo '<ul class="list-group mb-3" style="height:auto">';
                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    echo '<h6 class="my-0">' . "OrderID: " . $r["orderID"];
                    echo "Date: " . $r["orderDate"] . " ";
                    echo "Cost: " . $r["orderPrice"] . '</h6>';
                    echo '</li>';

                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                    echo $item_titles[$i] . '<br>';
                    echo $item_price[$i] . '<br>';
                    echo '</li>';
                    echo '</ul>';

                    $i++;
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

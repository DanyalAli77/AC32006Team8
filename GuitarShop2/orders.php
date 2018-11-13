<?php session_start();

// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
require_once ('config.php');



unset($_SESSION['cart']);
?>




<?php
include ('header_inside.php');
?>




<div class="container">
    <div class="page-header">
        <p></p>
        <h1>Order Summary</h1>
        <?php
        //select statement for getting order id.
        $customerID= $_SESSION['id'];
        //$sql_order = "SELECT MAX(orderID) FROM orders WHERE customerID = '$customerID'";
        $sql_order = "SELECT orderID FROM orders WHERE customerID = '$customerID' ORDER BY orderID DESC LIMIT 1";
        $res_order = mysqli_query($db, $sql_order);
        $r_order = mysqli_fetch_assoc($res_order);
        ?>
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







            <?php
            $sql = "SELECT `item1` AS item1
    FROM  `order_product`
    WHERE `item1` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item2`
    FROM  `order_product`
    WHERE `item2` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item3`
    FROM  `order_product`
    WHERE `item3` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item4`
    FROM  `order_product`
    WHERE `item4` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item5`
    FROM  `order_product`
    WHERE `item5` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item6`
    FROM  `order_product`
    WHERE `item6` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item7` AS item2
    FROM  `order_product`
    WHERE `item7` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item8`
    FROM  `order_product`
    WHERE `item8` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item9`
    FROM  `order_product`
    WHERE `item9` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )
    UNION ALL

    SELECT `item10`
    FROM  `order_product`
    WHERE `item10` IS NOT NULL
    AND `orderID` in (
    select max(`orderID`) from `orders`
    )";


            if(!$result = $db->query($sql)){
                die('There was an error running the query [' . $db->error . ']');
            }

            $i=0;
            while($row = $result->fetch_assoc()){

                $test=$row["item1"];


                $sql = "SELECT title, price FROM products WHERE id='$test' ";
                $res = mysqli_query($db, $sql);
                $r = mysqli_fetch_assoc($res);
                //echo $r["title"] . '<br>';


                echo '<ul class="list-group mb-3">';
                        echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                            echo '<div>';
                                    echo $r["title"] . " ";
                                    echo '<span class="text-muted">';echo "£" . $r['price'];
                                    echo '</span>';
                            echo '</div>';
                            echo '</li>';
                        echo '</ul>';


                $i++;
            }

            ?>


        </div>
    </div>




</div>



<?php
include ('footer.php');
?>

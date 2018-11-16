<?php
session_start();

require_once('config.php');
if(isset($_SESSION['loggedin']))
{
include('header_inside.php');
}
else{
    include ('header.php');
}
if(!empty($_SESSION['cart'])) {
$items =  $_SESSION['cart'];
}

?>
<!-- Shopping cart code was taken from link below-->
<!-- https://codingcyber.org/simple-shopping-cart-application-php-mysql-6394/ -->



<div class="container">
    <div class="row">
        <table class="table">

            <tr>
                <th>Item Number</th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
            <?php
            $total = 0;
            $itemNumber=1;
            //If statement gets rid of weird error
            if(empty($_SESSION['cart']))
            {
                //echo "cart is empty";

            }
            else {
                if (is_array($items) || is_object($items)) {
                    //loop through each id in the cart.
                    foreach ($items as $key => $id) {
                        $sql = "SELECT * FROM products WHERE id = $id";
                        $result = mysqli_query($db, $sql);
                        $rows = mysqli_fetch_assoc($result);
                        ?>
                        <tr>
                            <td><?php echo $itemNumber; ?></td>
                            <td>
                                <a href="delcart.php?remove=<?php echo $id; ?>">Remove</a> <?php echo $rows['title']; ?>
                            </td>
                            <td>£<?php echo $rows['price']; ?></td>
                        </tr>
                        <?php
                        $total += $rows['price']; //stores total basket cost
                        $itemNumber++;
                    }
                    $_SESSION['totalcost']= $total;

                }
            }
            ?>
            <tr>
                <td><strong>Total Price</strong></td>
                <td><strong>$<?php echo $total; ?></strong></td>
                <?php
                    if(isset($_SESSION['loggedin']))
                    {
                        echo '<td><a href="checkout.php" class="btn btn-info">Checkout</a></td>';
                    }
                    else{
                        echo '<td><a href="login.php" class="btn btn-info">Checkout</a></td>';
                    }
                ?>
            </tr>
        </table>

        <?php
        if(empty($_SESSION['cart'])) {
        echo '<h1>Cart is empty!</h1>';
        }
        ?>
    </div>
</div>


<?php include('footer.php'); ?>


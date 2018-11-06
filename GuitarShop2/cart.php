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

<div class="container">
    <div class="row">
        <table class="table">

            <tr>
                <th>S.NO</th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
            <?php
            $total = 0;
            $i=1;
            //If statement gets rid of weird error
            if(empty($_SESSION['cart']))
            {
                echo "cart is empty";

            }
            else {
                if (is_array($items) || is_object($items)) {
                    //loop through each id in the cart.
                    foreach ($items as $key => $id) {
                        $sql = "SELECT * FROM products WHERE id = $id";
                        $res = mysqli_query($db, $sql);
                        $r = mysqli_fetch_assoc($res);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <a href="delcart.php?remove=<?php echo $id; ?>">Remove</a> <?php echo $r['title']; ?>
                            </td>
                            <td>$<?php echo $r['price']; ?></td>
                        </tr>
                        <?php
                        $total += $r['price'];
                        $i++;
                    }

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
    </div>
</div>


<?php include('footer.php'); ?>


<?php
session_start();

require_once('config.php');
include('header.php');


$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
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
                $total = '';
                $i=1;
                foreach ($cartitems as $key=>$id) {
                    $sql = "SELECT * FROM products WHERE id = $id";
                    $res=mysqli_query($db, $sql);
                    $r = mysqli_fetch_assoc($res);
                    ?>
                    <tr>
                    <td><?php echo $i; ?></td>
                    <td><a href="delcart.php?remove=<?php echo $key; ?>">Remove</a> <?php echo $r['title']; ?></td>
                    <td>$<?php echo $r['price']; ?></td>
                </tr>
                <?php
	                $total += $r['price'];
	                $i++;
	                }
                ?>
                <tr>
                    <td><strong>Total Price</strong></td>
                    <td><strong>$<?php echo $total; ?></strong></td>
                    <td><a href="#" class="btn btn-info">Checkout</a></td>
                </tr>
            </table>
        </div>
    </div>




<?php include('footer.php'); ?>


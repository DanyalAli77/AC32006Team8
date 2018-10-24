<?php
session_start();
require_once('config.php');
include('header.php');
 ?>
    <div class="container">
        <div class="row">
            <table class="table">
                <tr>
                    <th>S.NO</th>
                    <th>Item Name</th>
                    <th>Price</th>
                </tr>

                <tr>
                    <td>Item number</td>
                    <td><a href="delcart.php?remove=">Remove</a> Item Name</td>
                    <td>$1000</td>
                </tr>
                <tr>
                    <td><strong>Total Price</strong></td>
                    <td><strong>$1000</strong></td>
                    <td><a href="#" class="btn btn-info">Checkout</a></td>
                </tr>
            </table>
        </div>
    </div>




<?php include('footer.php'); ?>
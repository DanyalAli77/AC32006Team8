<?php
session_start();
// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
// Include config file
require_once "config.php";


if(!empty($_SESSION['cart'])) {
    $items =  $_SESSION['cart'];
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


        $username = $_SESSION['username'];


        $totalCost = $_SESSION['totalcost'];
        $sql_payment = "INSERT INTO payment (customerID, branchID, paymentAmount) VALUES ( ?, 1, '$totalCost')";
        $stmt_pay = mysqli_prepare($db, $sql_payment);
        mysqli_stmt_bind_param($stmt_pay, "s", $param_id);
        $param_id = $_SESSION['id'];
        mysqli_stmt_execute($stmt_pay);
        mysqli_stmt_close($stmt_pay);



        $sql_order = "INSERT INTO orders (branchID, customerID, paymentID, orderDate, orderPrice, orderStatus) VALUES (1, ?,(SELECT MAX( paymentID ) FROM payment) ,NOW(), '$totalCost', 'Received')";
        $stmt_order = mysqli_prepare($db, $sql_order);
        mysqli_stmt_bind_param($stmt_order, "s", $param_id);
        $param_id = $_SESSION['id'];
        mysqli_stmt_execute($stmt_order);
        mysqli_stmt_close($stmt_order);


        $sql_products = "INSERT INTO order_product (";
        $index = 1;
        while($index <= count($items))
        {
            $sql_products .= "item" . $index . ", ";
            $index += 1;
        }
        $sql_products = substr($sql_products, 0, -2);
        $sql_products .= ") VALUES ( ";

        foreach ($items as $key => $id)
        {
            $sql_products .= "'" .$id . "' ,";
        }

        $sql_products = substr($sql_products, 0, -1);
        $sql_products .= ")";

        $stmt_products = mysqli_prepare($db, $sql_products);
        mysqli_stmt_execute($stmt_products);
        mysqli_stmt_close($stmt_products);




        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, phoneNo=?, address1=?, address2=?, postcode=?, country=?, city=? WHERE username = '$username'";

        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_firstname, $param_lastname, $param_email, $param_phone, $param_address1, $param_address2, $param_postcode, $param_country, $param_city);

// Set parameters
            $param_firstname = trim($_POST["for_name"]);
            $param_lastname = trim($_POST["sur_name"]);
            $param_email = trim($_POST["email"]);
            $param_phone = trim($_POST["phone"]);
            $param_address1 = trim($_POST["street1"]);
            $param_address2 = trim($_POST["street2"]);
            $param_postcode = trim($_POST["zip"]);
            $param_country = trim($_POST["country"]);
            $param_city = trim($_POST["city"]);

            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: orders.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);


// Close connection
    mysqli_close($db);
}

?>

<?php
include ('header_inside.php')

?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <p></p>
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Shipping details</span>
            </h4>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">



    <div class="form-group"> <!-- Full Name -->
        <label for="for_name_id" class="control-label">Forame</label>
        <input type="text" class="form-control" id="for_name_id" name="for_name" placeholder="John">
    </div>

    <div class="form-group"> <!-- Full Name -->
        <label for="sur_name_id" class="control-label">Surname</label>
        <input type="text" class="form-control" id="sur_name_id" name="sur_name" placeholder="Deer">
    </div>

    <div class="form-group"> <!-- Email -->
        <label for="email_id" class="control-label">Email</label>
        <input type="text" class="form-control" id="email_id" name="email" placeholder="example@email.com">
    </div>

    <div class="form-group"> <!-- Phone -->
        <label for="phone_id" class="control-label">Phone</label>
        <input type="text" class="form-control" id="phone_id" name="phone" placeholder="07123456789">
    </div>

    <div class="form-group"> <!-- Street 1 -->
        <label for="street1_id" class="control-label">Street Address 1</label>
        <input type="text" class="form-control" id="street1_id" name="street1" placeholder="Street address, P.O. box, company name, c/o">
    </div>

    <div class="form-group"> <!-- Street 2 -->
        <label for="street2_id" class="control-label">Street Address 2</label>
        <input type="text" class="form-control" id="street2_id" name="street2" placeholder="Apartment, suite, unit, building, floor, etc.">
    </div>

    <div class="form-group"> <!-- City-->
        <label for="city_id" class="control-label">City</label>
        <input type="text" class="form-control" id="city_id" name="city" placeholder="Smallville">
    </div>

    <div class="form-group"> <!-- State Button -->
        <label for="state_id" class="control-label">Country</label>
        <select class="form-control" id="state_id" name="country">
            <option value="United Kingdom">United Kingdom</option>

        </select>
    </div>

    <div class="form-group"> <!-- Zip Code-->
        <label for="zip_id" class="control-label">Post Code</label>
        <input type="text" class="form-control" id="zip_id" name="zip" placeholder="#####">
    </div>

    <div class="form-group"> <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Buy!</button>
    </div>


</form>
        </div>


        <div class="col-4">
            <p></p>
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>

            </h4>

            <div style="height:31px">
            </div>

            <?php
            $totalCost = 0;
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
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <?php echo $row['title']; ?>
                                    <span class="text-muted">£<?php echo $row['price']; ?></span>
                                </div>
                            </li>
                        </ul>
                        <?php
                        $totalCost += $row['price'];
                    }

                }
            }
            ?>
            <tr>
                <td><strong>Total Price</strong></td>
                <td><strong>£<?php echo $totalCost; ?></strong></td>
            </tr>


        </div>
    </div>
</div>


<?php
include ('footer.php')
?>

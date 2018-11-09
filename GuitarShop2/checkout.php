<?php
session_start();
// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$forname = $surname = $address1 = $address2 = $address3 = $postcode = $email = $country = $phoneNo = "";
$username_err = $password_err = $confirm_password_err = "";

if(!empty($_SESSION['cart'])) {
    $items =  $_SESSION['cart'];
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $username = $_SESSION['username'];


        $sql = "SELECT MAX(orderID) AS currentID FROM orders";
        $stmt = mysqli_prepare($db, $sql);




        $payment_id = 4;

        $sql_payment = "INSERT INTO payment (paymentID, customerID, branchID, paymentAmount) VALUES ('$payment_id', ?, 1, 12.50)";
        $stmt_pay = mysqli_prepare($db, $sql_payment);
        mysqli_stmt_bind_param($stmt_pay, "s", $param_id);
        $param_id = $_SESSION['id'];

        mysqli_stmt_execute($stmt_pay);
        mysqli_stmt_close($stmt_pay);



        $sql_order = "INSERT INTO orders (orderID, branchID, customerID, paymentID, orderDate, orderPrice, orderComplete) VALUES ('$order_id', 1, ?, (select paymentID from payment where paymentID = '$payment_id'), NOW(), 12.12, 0) ";
        $stmt_order = mysqli_prepare($db, $sql_order);
        mysqli_stmt_bind_param($stmt_order, "s", $param_id);
        $param_id = $_SESSION['id'];
        mysqli_stmt_execute($stmt_order);
        mysqli_stmt_close($stmt_order);


        $sql_products = "INSERT INTO order_product (orderID, ";
        $index = 1;
        while($index <= count($items))
        {
            $sql_products .= "item" . $index . ", ";
            $index += 1;
        }
        $sql_products = substr($sql_products, 0, -2);
        $sql_products .= ") VALUES ((SELECT orderID FROM orders WHERE orderID = '$order_id'), ";

        foreach ($items as $key => $id)
        {
            $sql_products .= "'" .$id . "' ,";
        }

        $sql_products = substr($sql_products, 0, -1);
        $sql_products .= ")";

        $stmt_products = mysqli_prepare($db, $sql_products);
        mysqli_stmt_execute($stmt_products);
        mysqli_stmt_close($stmt_products);







// Prepare an insert statement
        //$sql = "INSERT INTO users (firstname, lastname, address1, postcode, country) VALUES (?, ?, ?, ?, ?)";

        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, phoneNo=?, address1=?, address2=?, postcode=?, country=? WHERE username = '$username'";

        if($stmt = mysqli_prepare($db, $sql)){
// Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_firstname, $param_lastname, $param_email, $param_phone, $param_address1, $param_address2, $param_postcode, $param_country);

// Set parameters
            $param_firstname = trim($_POST["for_name"]);
            $param_lastname = trim($_POST["sur_name"]);
            $param_email = trim($_POST["email"]);
            $param_phone = trim($_POST["phone"]);
            $param_address1 = trim($_POST["street1"]);
            $param_address2 = trim($_POST["street2"]);
            $param_postcode = trim($_POST["zip"]);
            $param_country = trim($_POST["country"]);

// Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
// Redirect to login page
                header("location: orders.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

// Close statement
        mysqli_stmt_close($stmt);

    }



// Close connection
    mysqli_close($db);
}

?>

<?php
include ('header_inside.php')

?>
<div class="container">
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
<h1><?php echo $_SESSION['$id'];?></h1>


<?php
include ('footer.php')
?>

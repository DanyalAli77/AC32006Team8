<?php
session_start();

// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$forname = $surname = $address1 = $address2 = $address3 = $postcode = $email = $country = $phoneNo = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

// Prepare an insert statement
        //$sql = "INSERT INTO users (firstname, lastname, address1, postcode, country) VALUES (?, ?, ?, ?, ?)";
        $username = $_SESSION['username'];
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
                header("location: login.php");
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

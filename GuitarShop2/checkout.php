<?php
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$forname = $surname = $address3 = $address2 = $address3 = $postcode = $email = $country = $phoneNo = $address = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
// Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

// Prepare an insert statement
        //$sql = "INSERT INTO users (firstname, lastname, address1, postcode, country) VALUES (?, ?, ?, ?, ?)";
        $username = $_SESSION['username'];
        $sql = "UPDATE users SET (firstname, lastname, address1, postcode, country) VALUES (?, ?, ?, ?, ?) WHERE username = '$username'";

        if($stmt = mysqli_prepare($db, $sql)){
// Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_firstname, $param_lastname, $param_address1, $param_postcode, $param_country);

// Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

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
        <select class="form-control" id="state_id">
            <option value="UK">United Kingdom</option>

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

<?php
include ('footer.php')
?>

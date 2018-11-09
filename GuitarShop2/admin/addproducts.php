<?php
require_once ('../config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $sql = "INSERT INTO products (title, price, description, image, stock,date_added, branchID) VALUES (?,?,?,?,?,?,?)";

    if($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sissisi", $param_title, $param_price, $param_description, $param_image, $param_stock,$date_added, $param_branchid);
        // Set parameters
        $param_title = trim($_POST["title"]);
        $param_price = trim($_POST["price"]);
        $param_description = trim($_POST["description"]);
        $param_image = "assets/productimages/" . trim($_POST["image"]);
        $param_stock = trim($_POST["stock"]);
        $date_added = date("Y/m/d");
        $param_branchid = trim($_POST["branch"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
            header("location: addproducts.php");
        } else{
            echo "Something went wrong. Please try again later.";
            echo  mysqli_error($db);
        }
    }
    mysqli_stmt_close($stmt);

    // Close connection
        mysqli_close($db);
}
?>


<?php include ('admin_header.php') ?>



    <div class="container">
        <h1>Add new product</h1>

        <form action="uploadImage.php" method="post"
              enctype="multipart/form-data">
            <label for="file">Add photo:</label>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submit" value="Submit">
        </form>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group"> <!-- Full Name -->
                <label for="for_name_id" class="control-label">Title</label>
                <input type="text" class="form-control" id="for_name_id" name="title" placeholder="Guitar">
            </div>

            <div class="form-group"> <!-- Full Name -->
                <label for="sur_name_id" class="control-label">Price</label>
                <input type="text" class="form-control" id="sur_name_id" name="price" placeholder="500">
            </div>

            <div class="form-group"> <!-- Email -->
                <label for="email_id" class="control-label">Description</label>
                <input type="text" class="form-control" id="email_id" name="description" placeholder="Electric guitar">
            </div>

            <div class="form-group"> <!-- Phone -->
                <label for="phone_id" class="control-label">Image</label>
                <input type="text" class="form-control" id="phone_id" name="image" placeholder="assets/productimages/image.jpg">
            </div>

            <div class="form-group"> <!-- Street 1 -->
                <label for="street1_id" class="control-label">Stock</label>
                <input type="text" class="form-control" id="street1_id" name="stock" placeholder="10">
            </div>

            <div class="form-group"> <!-- Street 2 -->
                <label for="street2_id" class="control-label">Branch</label>
                <input type="text" class="form-control" id="street2_id" name="branch" placeholder="1">
            </div>

            <div class="form-group"> <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Product</button>
            </div>

        </form>

    </div>


<?php include ('../footer.php') ?>
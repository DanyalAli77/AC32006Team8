<?php
require_once ('../config.php');



    $sql = "INSERT INTO products (title, description, image, stock, branchID, date_added) VALUES ('Guitar', 'test', 'image', '1', '1', '2018-11-02')";


        if (mysqli_query($db, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        mysqli_close($db);



?>


<?php include ('admin_header.php') ?>





<?php include ('../footer.php') ?>
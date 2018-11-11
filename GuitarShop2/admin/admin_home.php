<?php session_start();
/**
 * Created by PhpStorm.
 * User: Juura
 * Date: 08/11/2018
 * Time: 16:09
 */
// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: index.php");
    exit;
}

?>


<?php include ('admin_header.php') ?>



<div class="container">
    <p></p>
    <h1> Orders </h1>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Order #</th>
            <th scope="col">Name</th>
            <th scope="col">Shipping info</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark Mark</td>
            <td>1 Main Street, Dundee, DD1 1DD</td>
            <td>
                <select class="btn btn-mini" id="inlineFormCustomSelect" name="orderby">
                    <option value="completed">Completed</option>
                    <option value="received">Received</option>
                    <option value='cancelled'>Cancelled</option>
                    <option value='shipped'>Shipped</option>
                    <option value='pending'>Pending</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob Jacob</td>
            <td>Main Street, Dundee, DD1 1DD</td>
            <td> <select class="btn btn-mini" id="inlineFormCustomSelect" name="orderby">
                    <option value="completed">Completed</option>
                    <option value="received">Received</option>
                    <option value='cancelled'>Cancelled</option>
                    <option value='shipped'>Shipped</option>
                    <option value='pending'>Pending</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry Larry</td>
            <td>Main Street, Dundee, DD1 1DD</td>
            <td>
                <select class="btn btn-mini" id="inlineFormCustomSelect" name="orderby">
                    <option value="completed">Completed</option>
                    <option value="received">Received</option>
                    <option value='cancelled'>Cancelled</option>
                    <option value='shipped'>Shipped</option>
                    <option value='pending'>Pending</option>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<?php include ('../footer.php') ?>




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
        <p>
        <h1>Contact us</h1>
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>



        <div class="card-img-top">
            <div class="gmap_canvas" >
                <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=56.46058,-2.974133&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
            </div>
                <style>.mapouter{text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:700px;}</style>
        </div>

    </div>

<?php
include ('footer.php');
?>
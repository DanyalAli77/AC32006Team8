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

    <!-- Page Content -->
    <div class="container">

        <!-- Introduction Row -->
        <h1 class="my-4">About Us
            <small>It's Nice to Meet You!</small>
        </h1>
        <p>GuitarShop is a specialist music shop specialising in the sale of guitars and related accessories. We are a Scottish based company with several branches in several cities. To see a list of branches, or if you want to get in touch then <a href="contact.php">click here.</a></p>

        <!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="my-4">Our Team</h2>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile2.png" alt="">
                <!-- image source: https://pixabay.com/en/lady-teacher-profile-head-female-31217/ -->
                <h4>Judy Smith <small>CEO</small> </h4>
                <p>Brief description of employee</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile2.png" alt="">
                <h4>Alice McDonald <small>Head of e-Commerce</small> </h4>
                <p>Brief description of employee</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile2.png" alt="">
                <h4>Fiona Black <small>Branch Manager</small> </h4>
                <p>Brief description of employee</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile.png" alt="">
                <!-- image source: https://pixabay.com/en/man-avator-person-admin-161282/ -->
                <h4>John Smith <small>Branch Manager</small> </h4>
                <p>Brief description of employee</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile.png" alt="">
                <h4>Harry White <small>Sales Assistant</small> </h4>
                <p>Brief description of employee</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
                <img class="rounded-circle img-fluid d-block mx-auto" src="assets/profile.png" alt="">
                <h4>Cameron McGill <small></small> </h4>
                <p>Brief description of employee</p>
            </div>
        </div>

    </div>
    <!-- /.container -->



<?php
include ('footer.php');
?>
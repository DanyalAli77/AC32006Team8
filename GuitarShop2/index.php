<?php
require_once ('config.php');
include ('header.php');
?>

<!-- Page Content -->
<div class="container">

    <div class="row">


        <!-- /.col-lg-3 -->

        <div class="col-lg-13">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="assets/productimages/header-bands_web-1200x350.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
            //prepare sql statement
            $sql = "SELECT * FROM products";
            $res = mysqli_query($db, $sql);
            ?>
            <!-- Loop through all items in database using php-->
            <div class="row">
                <?php while($r = mysqli_fetch_assoc($res)){ ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo $r['image']; ?>" alt="<?php echo $r['title'] ?>">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#"><?php echo $r['title'] ?></a>
                            </h4>
                            <h5><?php echo $r['price'] ?></h5>
                            <p class="card-text"><?php echo $r['description'] ?></p>
                            <p class="card-text"><?php echo $r['id'] ?></p>

                            <p><a href="addtocart.php?id=<?php echo $r['id']; ?>" class="btn btn-primary" role="button">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<?php
include ('footer.php');
?>

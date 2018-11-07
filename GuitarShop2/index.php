<?php
require_once ('config.php');


$selected = array();
//$orderby = $_GET['orderby'];
$orderby = (isset($_GET['orderby']) ? $_GET['orderby'] : 'sort');
if(!$orderby) { $orderby = 'sort'; }

if($orderby == 'price_asc')
{
    $orderby_query = "order by price ASC";
}
else if($orderby == 'price_desc')
{
    $orderby_query = "order by price DESC";
}
else if($orderby == 'name')
{
    $orderby_query = "order by title";
}
else if($orderby == 'sort')
{
    $orderby_query = "";
}
else if($orderby == 'default')
{
    $orderby_query = "";
}
else { unset($orderby); }

// If $orderby was valid set the selected sort option for the form.

if($orderby)
{
    $selected[$orderby] = '';
}

// Now run your SQL query with the $orderby_query variable.  Ex:

$sql = "select * from products $orderby_query";

// SQL code goes here..
?>


<?php
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

            <!-- Sort products -->
            <form method=get style="display: inline;" name='orderby_form'>
                <select class="btn btn-mini" id="inlineFormCustomSelect" name=orderby onChange="orderby_form.submit();">
                    <option value="sort" <?php print $selected[$orderby];?>> Sort By</option>
                    <option value="default" <?php print $selected[$orderby];?>>Default</option>
                    <option value='name' <?php print $selected[$orderby]; ?>>Name</option>
                    <option value='price_asc' <?php print $selected[$orderby]; ?>>Price (Low - High)</option>
                    <option value='price_desc' <?php print $selected[$orderby]; ?>>Price (High - Low)</option>
                </select>
                <p></p>
            </form>

            <?php
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

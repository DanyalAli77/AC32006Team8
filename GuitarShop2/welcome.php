<?php
session_start();
// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

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




//Change title of website
ob_start();
include("header_inside.php");
$buffer=ob_get_contents();
ob_end_clean();
$title = "Welcome";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;



?>

<div class="container">
    <div class="page-header">
        <p></p>
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h3>
    </div>
</div>


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
                            <img class="d-block img-fluid" src="assets/productimages/owl_carusel_2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="assets/productimages/owl_carusel_3.jpg" alt="Third slide">
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
                //prepare sql statement
                //$sql = "SELECT * FROM products";
                $res = mysqli_query($db, $sql);
                ?>
                <!-- Loop through all items in database using php-->
                <div class="row">
                    <?php while($r = mysqli_fetch_assoc($res)){ ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <img src="<?php echo $r['image']; ?>" alt="<?php echo $r['title'] ?>" class="img-fluid img-thumbnail">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?php echo $r['title'] ?></a>
                                    </h4>
                                    <h5>£<?php echo $r['price'] ?></h5>

                                    <p><a href="addtocart.php?id=<?php echo $r['id']; ?>" class="btn btn-primary" role="button">Add to Cart</a></p>

                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $r['description'] ?>">More</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal<?php echo $r['description'] ?>" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Description</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $r['description'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
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
    $items = $_SESSION['cart'];
}

if(isset($_POST['email'])) {

    $email_to = "jilmjarv@dundee.ac.uk";
    $email_subject = "Customer contact form";

    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$first_name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if(!preg_match($string_exp,$last_name)) {
        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }

    if(strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";

// create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);




    echo "<script type='text/javascript'>
                alert('Thank you for contacting us. We will be in touch with you very soon.');
            </script>";



}



?>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 700px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }

    </style>

    <div class="container">
        <p> </p>
        <h1>Contact us</h1>
        <div class="row">
            <div class="col">
                <p> </p>


                    <!-- Map code is an edited version of that found at the following addresses:
                    https://developers.google.com/maps/documentation/javascript/adding-a-google-map
                    https://developers.google.com/maps/documentation/javascript/infowindows -->

                    <div id="map"></div>
                    <script>
                    function initMap() {
                        var branch1 = {lat: 56.4584978, lng: -2.9838224};
                        var branch2 = {lat: 55.9445158, lng: -3.1914353};
                        var branch3 = {lat: 57.16476,   lng: -2.1037197};
                        var branch4 = {lat: 55.87151,   lng: -4.2909549};
                    var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: branch1
                    });

                    var contentString1 = '<div id="content">'+
                        '<div id="siteNotice">'+
                            '</div>'+
                        '<h3 id="firstHeading" class="firstHeading">Dundee Branch</h3>'+
                        '<div id="bodyContent">'+
                            '<p>Location: 1 High Street, Dundee, DD1 123<br>' +
                        '       Telephone: 01382 123 456<br>' +
                        '       Email: <a href="mailto:Dundee@guitarshop.com" target="_top">Dundee@guitarshop.com</a><br>' +
                        '       Opening hours: ' +
                        '<ul>' +
                        '   <li>Monday: 0900 - 1800</li>' +
                        '   <li>Tuesday: 0900 - 1800</li>' +
                        '   <li>Wednesday: 0900 - 1800</li>' +
                        '   <li>Thursday: 0900 - 1900</li>' +
                        '   <li>Friday: 0900 - 1800</li>' +
                        '   <li>Saturday: 0900 - 1800</li>' +
                        '   <li>Sunday: 1000 - 1600</li>' +
                        '</ul>' +
                        '</p>'+

                            '</div>'+
                        '</div>';



                        var contentString2 = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h3 id="firstHeading" class="firstHeading">Edinburgh Branch</h3>'+
                            '<div id="bodyContent">'+
                            '<p>Location: 1 Queen Street, Edinburgh, EH8 9YL<br>' +
                            '       Telephone: 0131 123 4567<br>' +
                            '       Email: <a href="mailto:Edinburgh@guitarshop.com" target="_top">Edinburgh@guitarshop.com</a><br>' +
                            '       Opening hours: ' +
                            '<ul>' +
                            '   <li>Monday: 0900 - 1800</li>' +
                            '   <li>Tuesday: 0900 - 1800</li>' +
                            '   <li>Wednesday: 0900 - 1800</li>' +
                            '   <li>Thursday: 0900 - 1900</li>' +
                            '   <li>Friday: 0900 - 1800</li>' +
                            '   <li>Saturday: 0900 - 1800</li>' +
                            '   <li>Sunday: 1000 - 1600</li>' +
                            '</ul>' +

                            '</p>'+


                            '</div>'+
                            '</div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString1,
                        width: 400,
                        height: 700
                    });

                    var infowindow2 = new google.maps.InfoWindow({
                        content: contentString2
                    });

                    var marker = new google.maps.Marker({
                    position: branch1,
                    map: map,
                    title: 'Branch1'
                    });

                    var marker2 = new google.maps.Marker({
                        position: branch2,
                        map: map,
                        title: 'Branch2'
                    });

                    marker.addListener('click', function() {
                    infowindow.open(map, marker);
                    });

                    marker2.addListener('click', function() {
                        infowindow2.open(map, marker2);
                    });
                    }
                    </script>
                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJzx5QKDhaB72kgywxbbcXNpEsRH-xH2g&callback=initMap">
                    </script>

                <!-- End of map code -->

                <p></p>
            </div>
                <div class="col">
                    <p> </p>
                        <form name="contactform" method="post" action="contact.php">
                            <table width="450px">
                                <tr>
                                    <td valign="top">
                                        <label for="first_name">First Name *</label>
                                    </td>
                                    <td valign="top">
                                        <input  class="form-control" type="text" name="first_name" maxlength="50" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top"">
                                    <label for="last_name">Last Name *</label>
                                    </td>
                                    <td valign="top">
                                        <input  class="form-control" type="text" name="last_name" maxlength="50" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label for="email">Email Address *</label>
                                    </td>
                                    <td valign="top">
                                        <input  class="form-control" type="text" name="email" maxlength="80" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label for="telephone">Telephone Number</label>
                                    </td>
                                    <td valign="top">
                                        <input  class="form-control" type="text" name="telephone" maxlength="30" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label for="comments">Comments *</label>
                                    </td>
                                    <td valign="top">
                                        <textarea class="form-control"  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right">
                                        <p></p>
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div>
        </div>
    </div>

<?php
include ('footer.php');
?>


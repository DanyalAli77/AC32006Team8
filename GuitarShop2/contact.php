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
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 700px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }

    </style>

    <div class="container">
        <p>
        <h1>Contact us</h1>
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>



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



    </div>

<?php
include ('footer.php');
?>
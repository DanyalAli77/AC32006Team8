<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'silva.computing.dundee.ac.uk');
define('DB_USERNAME', '18ac3u08');
define('DB_PASSWORD', 'cba123');
define('DB_NAME', '18ac3d08');

//define('DB_SERVER', '127.0.0.1');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'GuitarShop');



/* Attempt to connect to MySQL database */
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($db === false){
    die("ERROR: Could not connect to database!" . mysqli_connect_error());


}





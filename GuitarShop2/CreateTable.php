<?php

 include "config.php";

 try
 {
 $query = "CREATE TABLE Students (
Firstname VARCHAR(30),
Surname VARCHAR(30)
)";

 $link->exec($query);
 } catch (PDOException $e) {
     echo $e->getMessage();
 }
 ?>
<?php

if( isset($_GET["id"])){
   $id =$_GET["id"]; 

   $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "usermanagement";

 // to create the connection
 $connection = new mysqli($servername, $username, $password, $database); 

 $sql=" DELETE FROM users WHERE id=$id";
 $connection->query($sql);
}
header("location: /myuser/crud.php");
exit;

?>
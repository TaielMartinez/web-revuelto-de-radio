<?php

error_reporting(E_ERROR | E_PARSE);

  $conn = new mysqli("localhost","u562328342_php","basededatosrevueltoderadio","u562328342_revuelto"); // server
  
  $conn=mysqli_connect("localhost","u562328342_php","basededatosrevueltoderadio","u562328342_revuelto");

   if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>
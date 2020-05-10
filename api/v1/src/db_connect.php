<?php

error_reporting(E_ERROR | E_PARSE);

  $conn = new mysqli("localhost","u562328342_php","basededatosrevueltoderadio","u562328342_revuelto"); // server
  
 

   if (mysqli_connect_errno()) {
      $conn=mysqli_connect("localhost","root","","revuelto_de_radio");
        //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>
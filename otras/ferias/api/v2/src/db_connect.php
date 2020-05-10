<?php

    error_reporting(E_ERROR | E_PARSE);

    $conn = new mysqli("localhost", "u562328342_ferias", "lD]Gtc7y", "u562328342_ferias"); // server

    if ($conn->connect_error) {
        $conn = new mysqli("localhost", "root", "", "madriguera");
    }

?>

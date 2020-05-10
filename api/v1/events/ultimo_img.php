<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    $fecha = date('Y')."-".date('m')."-".date('d');

    $sql = "SELECT foto FROM `events` WHERE autorizado = 1 AND date > '$fecha' ORDER by `date` DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $json;

    while($row = $result->fetch_assoc()) {
        //$json = $json.json_encode($row).',';
        echo $row['foto'];
    }

    //$rest = substr($json, 0, -1);
    //echo '['.$rest.']';


?>

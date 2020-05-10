<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    if(isset($_POST['id'])){

        $sql = "SELECT * FROM `events` WHERE autorizado = 1 AND id = ".$_POST['id'];
        $result = mysqli_query($conn, $sql);
        $json;

        while($row = $result->fetch_assoc()) {
            $json = $json.json_encode($row).',';
        }

        $rest = substr($json, 0, -1);
        echo '['.$rest.']';

    } else {
        echo '{ "error" : "falta id"}';
    }

?>

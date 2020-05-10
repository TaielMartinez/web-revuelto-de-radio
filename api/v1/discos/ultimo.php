<?php
    //echo 'aa';
    //echo "gola";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    $sql = "SELECT foto FROM `discos` ORDER by id DESC LIMIT 1";
    $json;
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_assoc()) {
        echo $row['foto'];
        //echo ",";
    //$json = $json.json_encode($row).',';
    }

    //echo '{"json": '.$json.'}';
    //echo $json;
    //$rest = substr($json, 0, -1);
    //echo '['.$rest.']';
?>

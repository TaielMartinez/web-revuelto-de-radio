<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    $sql = "SELECT title, date, id, url FROM `events` WHERE autorizado = 1";
    $result = mysqli_query($conn, $sql);
    $json;

    while($row = $result->fetch_assoc()) {
        $row['url'] = '../evento?e='.$row['id'];
        $json = $json.json_encode($row).',';
    }

    $rest = substr($json, 0, -1);
    echo '['.$rest.']';

?>

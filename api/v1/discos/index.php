<?php
    //echo 'aa';
    //echo "gola";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "SELECT * FROM `discos` WHERE id = '$id'";
    } else {
        $sql = "SELECT id, titulo, foto, producionPropia FROM `discos`";
    }
    $json;
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_assoc()) {
        //echo json_encode($row);
        //echo ",";
    $json = $json.json_encode($row).',';
    }

    //echo '{"json": '.$json.'}';
    //echo $json;
    $rest = substr($json, 0, -1);
    echo '['.$rest.']';
?>

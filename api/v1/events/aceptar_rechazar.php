<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    if(isset($_POST["id"]) && isset($_POST["accion"])){

        $id = $_POST["id"];
        $accion = $_POST["accion"];

        $sql = "UPDATE `events` SET `autorizado` = '$accion' WHERE `events`.`id` = $id";
        //$sql = "SELECT * FROM `events` WHERE autorizado = 1 AND id = ".$_POST['id'];

        $result = mysqli_query($conn, $sql);

        while($row = $result->fetch_assoc()) {
        }

        echo "true";

    } else {
        echo "errorpost";
    }

    //echo $_POST["id"];
?>
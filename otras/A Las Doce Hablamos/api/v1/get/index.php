<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include '../src/db_connect.php';


    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql2 = "SELECT * FROM `maps` WHERE id = $id";
        $result2 = mysqli_query($conn, $sql2);
        while($row = $result2->fetch_assoc()) {
            echo $row['json'];
        }
    } else {
        $sql = "SELECT id, name, author FROM `maps`";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count < 0) {
            echo '{"error": "la tabla esta vacia"}';
        } else {
            $json = '{ "maps": [';
            while($row = $result->fetch_assoc()) {
                $json = $json. '{"id": '.$row["id"].',"name": "'.$row["name"].'", "author": "'.$row["author"].'"},';
            }
            $json = substr($json, 0, -1);
            $json = $json. "]}";
            echo $json;
            
        }
    }

?>

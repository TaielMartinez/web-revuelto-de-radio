<?php
// recibe "mail" y devuelve el id_usuario de ese mail


    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include '../src/db_connect.php';

    $mail = $_POST["mail"];

    $sql = "SELECT id_usuario FROM `USUARIOS` WHERE mail = '$mail'";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    echo $sql;

    if($count > 0){
        while($row = $result->fetch_assoc()) {
            echo $row["id_usuario"];
        }
    } else {
        echo 'error_mail';
    }

?>
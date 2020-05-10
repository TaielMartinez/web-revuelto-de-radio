<?php
// recibe "valor" y "campo"
// valor es el campo de la tabla
// campo es el valor que busca dentro de la tabla

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include '../src/db_connect.php';


    if(isset($_POST)){
        if(isset($_POST["campo"])){
            if(isset($_POST["valor"])){
                $valor = $_POST["valor"];
                $campo = $_POST["campo"];
                
                $sql = "SELECT * FROM `USUARIOS` WHERE $campo = '$valor'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                if($count > 0) {
                    echo '{"json": "false"}';
                } else {
                    echo '{"json": "true"}';
                }
            } else {
                echo '{"error" : "No se recivio valor VALOR"}';
            }
        } else {
            echo '{"error" : "No se recivio valor CAMPO"}';
        }
    } else {
        echo '{"error" : "No se recivio ningun valor"}';
    }

?>

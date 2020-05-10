<?php

/*
    date       2020-03-08
    url         http://revueltoderadio.com/api/v1/ending.php
    nombre      varchar(255)
    lugar          https://www.google.com.ar/maps/place/Hierro+Celina/@-34.6938925,-58.4744191,15z
    costo         ej 1: 600 (osea 600 pesos) o ej 2: "sobre" o ej 3: "gratis"      (en el fomulario da 3 opciones, ingresar valor o las opciones de al "sobre" y "gratis" estos textos son harcodeados)
    foto            https://auth-db185.hostinger.com/themes/pmahomme/img/logo_left.png
    facebook    https://www.facebook.com/events/528701001383165/
    youtube      https://www.youtube.com/watch?v=nd3IKA3sBEk
    hora             2019-02-23 20:02:21 (es un timestamp, pero los unicos valores que usamos son hora y minuto, osea 20:02, los otros pueden ser todos 0 y no pasa nada)
    spotify
    direccion
    reserva
    artista
    descripcion
*/

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    if(isset($_POST['date'])){
        if(isset($_POST['nombre'])){
            if(isset($_POST['lugar'])){
                if(isset($_POST['foto'])){
                    if(isset($_POST['facebook'])){
                        if(isset($_POST['costo'])){
                            if(isset($_POST['youtube'])){
                                if(isset($_POST['hora'])){
                                    $date = $_POST['date'];
                                    $nombre = $_POST['nombre'];
                                    $lugar = $_POST['lugar'];
                                    $foto = $_POST['foto'];
                                    $facebook = $_POST['facebook'];
                                    $costo = $_POST['costo'];
                                    $youtube = $_POST['youtube'];
                                    $hora = $_POST['hora'];
                                    $spotify = $_POST['spotify'];
                                    $direccion = $_POST['direccion'];
                                    $reserva = $_POST['reserva'];
                                    $artista = $_POST['artista'];
                                    $descripcion = $_POST['descripcion'];
                                    $hora_2 = explode(' ', $hora);
                                    $hora_3 = explode(':', $hora_2[1]);
                                    $title = $nombre.'\n'.$hora_3[0].':'.$hora_3[1].'\n'.$lugar;

                                    $sql = "INSERT INTO `events` (`title` ,`date`, `nombre`, `lugar`, `foto`, `facebook`, `costo`, `youtube`, `hora`, `spotify`, `direccion`, `reserva`, `artista`, `descripcion`) VALUES ('$title', '$date', '$nombre', '$lugar', '$foto', '$facebook', '$costo', '$youtube', '$hora', '$spotify', '$direccion', '$reserva', '$artista', '$descripcion')";
                                    $result = mysqli_query($conn, $sql);

                                    echo $title;
                                    echo $hora;

                                } else {
                                    echo '{ "error" : "falta hora"}';
                                }
                            } else {
                                echo '{ "error" : "falta youtube"}';
                            }
                        } else {
                            echo '{ "error" : "falta costo"}';
                        }
                    } else {
                        echo '{ "error" : "falta facebook"}';
                    }
                } else {
                    echo '{ "error" : "falta foto"}';
                }
            } else {
                echo '{ "error" : "falta lugar"}';
            }
        } else {
            echo '{ "error" : "falta nombre"}';
        }
    } else {
        echo '{ "error" : "falta date"}';
    }

?>

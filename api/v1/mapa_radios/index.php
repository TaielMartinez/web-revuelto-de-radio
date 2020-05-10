<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    include '../src/db_connect.php';

    $sql = "SELECT * FROM `mapa_radios`";
    $result = mysqli_query($conn, $sql);
    $json;

	while($row = $result->fetch_assoc()) {
        //$texto = '<div class="leaflet-popup-content" style="width: 301px;"><div class="map-popup"><div class="map-popup-img"><a href="'.$row["web"].'"><img class="attachment-thumbnail size-thumbnail wp-post-image" alt="" src="'.$row["foto"].'" width="150" height="150"></a></div><a target="_blank" class="btn btn-info" role="button" href="'.$row["web"].'">Conocenos</a></div><div class="map-popup-title">'.$row["nombre"].'</div><div class="map-popup-summary">Transmitiendo desde Las Chacras, Traslasierra, al oeste de la provincia de Córdoba.</div></div>';
        $texto = "hola mundo";
        $json = $json.'{"cordenada" : ["'.$row['cordX'].'", "'.$row['cordY'].'"], "html" : "'.$texto.'"},';
    };

    $json = substr($json, 0, -1);
    echo '{ "array" : ['.$json.']}';

?>

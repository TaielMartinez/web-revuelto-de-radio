<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    session_start();

    if(isset($_POST['pass']) && $_POST['pass'] == 123)

    include '../src/db_connect.php';

    $fecha_hoy2 = date('Y').date('m').date('d');
    $fecha_hoy = (int)$fecha_hoy2;

    $sqlp = "SELECT * FROM `events` ORDER BY date ASC";
    $resultp = mysqli_query($conn, $sqlp);
    $pendientes;
    while($row = $resultp->fetch_assoc()) {
        $fecha2 = $row['date'][0].$row['date'][1].$row['date'][2].$row['date'][3].$row['date'][5].$row['date'][6].$row['date'][8].$row['date'][9];
        $fecha = (int)$fecha2;
        $fecha_if = "";
        $botones = "";
        if($fecha > $fecha_hoy){
            $facebook = ""; $youtube = ""; $foto = "";
            if($row['facebook']){
                $facebook = 'Facebook: <a href="'.$row['facebook'].'" target="_blank">link</a>';
            }
            if($row['youtube']){
                $youtube = 'Youtube: <a href="'.$row['youtube'].'" target="_blank">link</a>';
            }
            if($row['foto']){
                $foto = '<a href="'.$row['foto'].'" target="_blank"><img class="ml-4" src="'.$row['foto'].'" width="150" height="150"></a>';
            }
            $id = $row['id'];
            if($row['autorizado'] == 0){
                $botones = '
                    <button type="button" onclick="aceptar_rechazar('.$id.', 1)" class="btn btn-success m-2">Aceptar</button>
                    <button type="button" onclick="aceptar_rechazar('.$id.', 2)" class="btn btn-danger m-2">Rechazar</button>
                ';
            } else if($row['autorizado'] == 1){
                $botones = '
                    <button type="button" onclick="aceptar_rechazar('.$id.', 2)" class="btn btn-danger m-2">Rechazar</button>
                ';
            } else if($row['autorizado'] == 2){
                $botones = '
                    <button type="button" onclick="aceptar_rechazar('.$id.', 1)" class="btn btn-success m-2">Aceptar</button>
                ';
            }
            $armado = '
                <div class="card mt-1 mb-1" id="e'.$id.'">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <h4 class="ml-3 mr-3 mt-2">'.$row['nombre'].'</h4>
                            <p class="ml-4">Fecha: '.$row['date'][8].$row['date'][9].$row['date'][7].$row['date'][5].$row['date'][6].$row['date'][4].$row['date'][0].$row['date'][1].$row['date'][2].$row['date'][3].
                            ' Hora: '.$row['hora'][11].$row['hora'][12].$row['hora'][13].$row['hora'][14].$row['hora'][15].'</p>
                            <p class="ml-4">Lugar: '.$row['lugar'].' Costo: '.$row['costo'].'</p>
                            <p class="ml-4">'.$facebook.' '.$youtube.'</p>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            '.$foto.'
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 align-baseline align-items-center justify-content-around">
                        '.$botones.'
                        </div>
                    </div>
                    
                </div>
            ';
            if($row['autorizado'] == 0){
                $pendientes = $pendientes.$armado;
            } else if($row['autorizado'] == 1){
                $aprobados = $aprobados.$armado;
            } else if($row['autorizado'] == 2){
                $rechazados = $rechazados.$armado;
            }
        }
    }


    echo '
       
        <div class="container">
            <div class="col-12 ">
                <p>
                    <button class="btn btn-primary collapse_1" type="button" aria-expanded="false" aria-controls="collapseExample">
                        Pendientes
                    </button>
                    <button class="btn btn-primary collapse_2" type="button" aria-expanded="false" aria-controls="collapseExample">
                        Aprobados
                    </button>
                    <button class="btn btn-primary collapse_3" type="button" aria-expanded="false" aria-controls="collapseExample">
                        Rechazados
                    </button>
                    <button type="button" class="btn btn-danger cerrar_sesion">Cerrar sesion</button>
                </p>
            </div>
            <div class="collapse" id="collapsePendientes">
                <div class="card card-body collapsePendientes_text">
                '.$pendientes.'
                </div>
            </div>

            <div class="collapse" id="collapseAprobados">
                <div class="card card-body collapseAprobados_text">
                '.$aprobados.'
                </div>
            </div>

            <div class="collapse" id="collapseRechazados">
                <div class="card card-body collapseRechazados_text">
                '.$rechazados.'
                </div>
            </div>
        </div>




        <script>

            $(".collapse_1").click(function(){
                $("#collapsePendientes").collapse("show")
                $("#collapseAprobados").collapse("hide")
                $("#collapseRechazados").collapse("hide")
            })

            $(".collapse_2").click(function(){
                $("#collapseAprobados").collapse("show")
                $("#collapsePendientes").collapse("hide")
                $("#collapseRechazados").collapse("hide")
            })

            $(".collapse_3").click(function(){
                $("#collapseRechazados").collapse("show")
                $("#collapsePendientes").collapse("hide")
                $("#collapseAprobados").collapse("hide")
            })

            $( document ).ready(function() {
                $("#collapsePendientes").collapse("show")
            });

            function aceptar_rechazar(id, accion){
                console.log(id+" "+accion)
                console.log("#e"+id)
                $("#e"+id).hide();
                $(document).ready(function() {
                    $("#collapseEnviados").collapse("show")
                        $.ajax({
                            url: "http://revueltoderadio.com/api/v1/events/aceptar_rechazar.php",
                            method: "POST",
                            data: {id : id, accion : accion}
                        }).done(function(data) {
                            console.log(data)
                            if(data == "error"){
                                alert("error 277, recarge la pagina");
                                return false;
                            }
                            if(data == "errorpost"){
                                alert("error 278, recarge la pagina");
                                return false;
                            }
                        });
                    });
            }

            $(".cerrar_sesion").click(function(){
                localStorage.removeItem("pass")
                localStorage.removeItem("user")
                location.reload();
            })


        </script>
    ';

?>

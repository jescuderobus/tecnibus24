<?php
session_start();
if (empty($_SESSION["usuario"]) || ($_SESSION['tipo_usu']) != 0) {
    header("Location: http://172.31.0.190/tecnibus9/CitasUs/login.php");
    # Y salimos del script
    exit();
}
function traducirFecha($fecha) {
    $meses_en = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $meses_es = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    return str_replace($meses_en, $meses_es,$fecha);
}
function traducirDias($fecha) {
       
    $dias_en = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Saturday', 'Sunday');
    $dias_es = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

    return  str_replace($dias_en, $dias_es, $fecha);
}
setlocale (LC_TIME, "es_ES");
$hoy = date("Y-m-d");
$base_url = "http://172.31.0.190/tecnibus9/CitasUs/";
$user = "tecnibus9";
$pass = "TecniBus_123";
$host = "localhost";
$connection = mysqli_connect($host, $user, $pass);
$fecha_ini = date("");
$fecha_sig = date("");
$fecha_prev = date("");
$lunes = date("");
$peticion = "";
$biblio = "centrales";
if (date("D") == "Mon") {
    $lunes = date("Y-m-d");
} else {
    if ((date("D") != "Sat") && ((date("D") != "Sun"))) {
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    } else {
        $lunes = date("Y-m-d", strtotime('next Monday', time()));
    }
}
if (!$connection) {
    echo "No se ha podido conectar con el servidor";
}
if (isset($_POST['fecha'])) {
    if ($_POST['fecha'] != "") {
        $fecha_ini = $_POST['fecha'];
    }
} else {
    $fecha_ini = $lunes;
}
$fecha_sig = date("Y-m-d", strtotime($fecha_ini . "+ 7 days"));
$fecha_prev = date("Y-m-d", strtotime($fecha_ini . "- 7 days"));
$datab = "tecnibus9";
$db = mysqli_select_db($connection, $datab);
if (isset($_POST['nombre'])) {
    switch ($_POST['disponibilidad']) {
        case 0:
            $duplicados="SELECT * FROM citas3 WHERE fecha ='".$_POST['fecha_reserva']."'  AND tramo =" . $_POST['tramo_sel'] . "";
            $result_duplicados= $connection->query($duplicados);
        if($result_duplicados->num_rows >0){
            $actualizar_datos="UPDATE citas3  SET nombre ='" . $_POST['nombre'] . "' , comentario ='" . $_POST['comentario'] ."' WHERE fecha = '" . $_POST['fecha_reserva'] . "' AND tramo =" . $_POST['tramo_sel'] . "";
            $connection->query($actualizar_datos);
            break;
        }else{
            $peticion = "INSERT INTO citas3 (fecha,tramo,nombre,comentario) VALUES ('" . $_POST['fecha_reserva'] . "'," . $_POST['tramo_sel'] . ",'" . $_POST['nombre'] . "','" . $_POST['comentario'] . "')";
            $connection->query($peticion);
            break;}
        case 1:
            $peticion = "DELETE FROM citas3 WHERE fecha = '" . $_POST['fecha_reserva'] . "' AND tramo =" . $_POST['tramo_sel'] . "";
            $connection->query($peticion);
            break;
        case 2;
            $peticion = "INSERT INTO citas3 (fecha,tramo,nombre,comentario) VALUES ('" . $_POST['fecha_reserva'] . "'," . $_POST['tramo_sel'] . ",'" . $_POST['nombre'] . "','" . $_POST['comentario'] . "')";
            $connection->query($peticion);
    }
}
if (!$db) {
    echo "No se ha podido encontrar la Tabla";
} else
$numero_tramos = "SELECT COUNT(*) AS total FROM tramos";
$result = mysqli_query($connection, $numero_tramos);
$colum = mysqli_fetch_assoc($result);
$numtram = $colum['total'];
$tramos = 7 * $numtram;
if (!$result) {
    echo "No se ha podido realizar la consulta123213123";
}
if (!$db) {
    echo "No se ha podido encontrar la Tabla";
} else
    $citashoy = "SELECT * FROM citas3 WHERE fecha = '$hoy' ORDER BY tramo";
$consulta = "SELECT * FROM citas3  WHERE fecha >= '$fecha_ini' ORDER BY fecha LIMIT $tramos";
$result = mysqli_query($connection, $consulta);
if (!$result) {
    echo "No se ha podido realizar la consulta";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Citas Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/cal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script> windows.onload = limpiarTramos(); </script>
    <script> windows.onload = limpiarFormulario(); </script>
</head>

<body>

    <?php
    echo "<div class='cuerpo'><div class='cabecera'><div class='logos'><img class='img-fluid' src='/tecnibus9/CitasUs/img/logo_bus.png'></div> <h1 class='titulo'>Cita previa biblioteca</h1>";
    echo "<div class='usuario'><p>" . strtoupper($_SESSION['usuario']) . "</p> "?><button class='btn btn-outline-dark' onclick="location.href='http://172.31.0.190/tecnibus9/CitasUs/cierrasesion.php'" type="button">Cerrar sesión</button><?php echo "</div></div>";
    // echo "<h1>" . traducirFecha(date("M-Y", strtotime($fecha_ini))) . "</h1>";
    echo "<div class='containern botones '><div class='row'><div class='col semana_anterior'>";
    echo "<div class='usuario'><a>" . strtoupper($_SESSION['usuario']) . "</a> ";
    echo "</div></div>";
    echo "<div class='col cerrar_sesion'>";
    echo "<button class='btn btn-outline-dark'"?> onclick="location.href='http://172.31.0.190/tecnibus9/CitasUs/cierrasesion.php'" type="button">Cerrar sesión</button></div><?php
    echo "</form> </div></div>";
    echo "<div><table>";
    echo "<tr>";
    echo "<th><p>Fecha</p></th>";
    for ($i = 0; $i < 5; $i++) {
        if (date("Y-m-d", strtotime($fecha_ini . "+ " . $i . " days")) == $hoy) { ?>
            <th class='hoy'>
                <?php echo date("D d", strtotime($fecha_ini . "+ " . $i . " days")) ?>
            </th>
            <?php
        } else {
            if (((date('D', strtotime($fecha_ini . "+ " . $i . " days")) != 'Sun') && (date('D', strtotime($fecha_ini . "+ " . $i . " days")) != 'Sat'))) { ?>
                <th class=> <?php echo date("D d", strtotime($fecha_ini . "+ " . $i . " days")) ?></th>
                <?php
            }
        }
    }
    echo "</tr>";
    echo "<br>";
    for ($i = 1; $i <= $numtram; $i++) {
        $tramos = "SELECT * FROM tramos WHERE numero = " . $i . " ";
        $result_tram = mysqli_query($connection, $tramos);
        $colum3 = mysqli_fetch_array($result_tram);
        $result_citas = mysqli_query($connection, $consulta);
        echo "<tr>";
        echo "<th><h6>";
        echo $colum3['inicio'] . " - " . $colum3['fin'];
        echo "</h6></th>";
        for ($j = 0; $j < 5; $j++) {
            $ocupado = 0;
            $result_citas = mysqli_query($connection, $consulta);
            $fechatabla = date("Y-m-d", strtotime($fecha_ini . "+ " . $j . " days"));
            echo "<td ";
            if ($fechatabla < $hoy) {
                while ($colum4 = mysqli_fetch_array($result_citas)) {
                    if ($fechatabla == $colum4['fecha'] && $colum4['tramo'] == $colum3['numero']) {
                        ?>
                        class="no_disponible_admin pasado <?php echo date('D', strtotime($colum['fecha'])) ?>" data-bs-toggle='modal' onclick="limpiarFormulario() ;setcomentario_prev('<?php echo $colum4['comentario'] ?>'); setfecha_prev('<?php echo $fechatabla ?>'); setnombre_prev('<?php echo $colum4['nombre'] ?>'); settramo_prev('<?php echo $colum3['inicio']." - ".$colum3['fin']  ?>');fechaactual('<?php echo $fecha_ini ?>');"data-bs-target='#add_evento2'><?php ?>
                        </td>
                        <?php
                        $ocupado = 1;

                    }
                }
                if ($ocupado == 0) { ?>
                    <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?>
                    class="disponible pasado <?php echo date('D', strtotime($colum['fecha'])) ?>" </td>
                    <?php
                }
            } else {
                while ($colum4 = mysqli_fetch_array($result_citas)) {
                    if ($fechatabla == $colum4['fecha'] && $colum4['tramo'] == $colum3['numero']) {
                        ?>
                        class="no_disponible_admin
                        <?php echo date('D', strtotime($colum['fecha'])) ?>" data-bs-toggle='modal'onclick="limpiarFormulario(); setcomentario('<?php echo $colum4['comentario'] ?>'); setfecha('<?php echo $fechatabla ?>');settramo(<?php echo $i ?>);fechaactual('<?php echo $fecha_ini ?>');setnombre('<?php echo $colum4['nombre'] ?>');"data-bs-target='#add_evento'><?php ?></td>
                        <?php
                        $ocupado = 1;

                    }
                }
                if ($ocupado == 0) { ?>
                    <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?> class="disponible" <?php echo date('D', strtotime($colum['fecha'])) ?>" data-bs-toggle='modal'onclick="setfecha('<?php echo $fechatabla ?>');settramo(<?php echo $i; ?>);fechaactual('<?php echo $fecha_ini ?>');limpiarFormulario();setdisponibilidad ('1');"data-bs-target='#add_evento'><?php ?>
                    </td>
                    <?php
                }

            }
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<div class='containern botones '><div class='row'><div class='col semana_anterior'>";
    echo "<form action='/tecnibus9/CitasUs/administrador.php' method='post' class='inline'>"; //TODO mover botones
    echo "<input id='fecha_prev' name='fecha' type='hidden' value=" . $fecha_prev . ">";
    echo "<button type='submit' class='btn btn-secondary btn-sm '>  <i class='bi bi-chevron-bar-left'></i>Semana Anterior</button>";
    echo "</form>";
    echo "</div>";
    echo "<div class='col volverhoy'><form action='/tecnibus9/CitasUs/administrador.php' method='post' class='inline'";
    echo "<input id='fecha_actual' name='fecha' type='hidden' value=" . $lunes . ">";
    echo "<button type='submit' class='btn btn-secondary btn-sm'>Semana Actual <i class='bi bi-house'></i></button></div>";
    echo "</form>";
    echo "<div class='col siguiente'><form action='/tecnibus9/CitasUs/administrador.php' method='post' class='inline' >";
    echo "<input id='fecha_sig' name='fecha' type='hidden' value=" . $fecha_sig . ">";
    echo "<button type='submit' class='btn btn-secondary btn-sm'>Semana Siguiente <i class='bi bi-chevron-bar-right'></i></button></div>";
    echo "</form> </div></div>";
    $resultado_hoy = mysqli_query($connection, $consulta_hoy);
    $columna = mysqli_fetch_array($resultado_hoy);
    // echo "<button href='reporte.php'> Descargar reporte</button>";
?> 

<?php 
    echo "</div>";
    echo "<div class='citashoy row'><div class='col'></div>" ;
    echo "<div class='col'><h2> CITAS DE HOY </h2></div>"?><div class="col"><button class="btn btn-outline-primary btn-sm" onclick="location.href='reporte.php'" type="button">Descargar citas PDF</button></div><?php
    echo "</div>";
    echo "<div>";
    echo "<table>";
    echo "<tr>";
    echo "<th><p>Hora</p></th>";
    echo "<th><p>Nombre</p></th>";
    echo "<th><p>Comentario</p></th>";
    echo "</tr>";
    for ($i = 1; $i <= $numtram; $i++) {
        $tramos = "SELECT * FROM tramos WHERE numero = " . $i . " ";
        $result_tram = mysqli_query($connection, $tramos);
        $colum3 = mysqli_fetch_array($result_tram);
        $result_citas = mysqli_query($connection, $consulta);
        echo "<tr>";
        echo "<th><h6>";
        echo $colum3['inicio'] . " - " . $colum3['fin'];
        echo "</h6></th>";
        // $result = mysqli_query($connection, $citashoy);
        // while ($colum4 = mysqli_fetch_array($result)) {
        //     if ($colum4['tramo'] == $i) {
        //         // if ($colum4['disp'] == 0) {
        //             echo "<td>";
        //             echo $colum4['nombre'];
        //             echo "</td>";
        //             echo "<td>";
        //             echo $colum4['comentario'];
        //             echo "</td>";
        //         // }
        //     }

        // }
        $citasprueba = "SELECT * FROM citas3 WHERE fecha = '$hoy' AND tramo =".$i."";
        $result_citas = mysqli_query($connection, $citasprueba);
        $colum5=mysqli_fetch_array($result_citas);
        echo "<td>".$colum5['nombre']."</td>" ;
        echo "<td>".$colum5['comentario']."</td>" ;
        echo "</tr>";


    }
    echo "</div>";
    echo "<table class='config_tramos'>";
    echo "<h2> Configuracion del sitio </h2>";
    echo "<th class='numtram' >Numero de tramo</th>";
    echo "<th class='inicio' >Hora Inicio</th>";
    echo "<th class='final' >Hora Fin</th>";
    echo "<th class='miscancelar'>Editar</th>";
    $tramos = "SELECT * FROM tramos ORDER BY numero";
    $result = mysqli_query($connection, $tramos);
    while ($colum = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td class='columna_numero'>" . $colum['numero'] . "</td>";
                    echo "<td>" . $colum['inicio'] . "</td>";
                    echo "<td>" . $colum['fin'] . "</td>";
                    echo "<td><div class = 'botones_configuracion'>"; ?>
                    <button class='btn btn-success editar' data-bs-toggle='modal' data-bs-target='#add_evento3' onclick ="setHoraInicio('<?php echo $colum['inicio']?>'); setHoraFin('<?php echo $colum['fin']; ?>');setNumero('<?php echo $colum['numero']; ?>'); "><i class="bi bi-pencil"></i></button> <?php
                    echo "</form>";
                    if($colum['numero'] == $numtram){ //TODO acabar el borrado y la creacion
                    echo "<form action='/tecnibus9/CitasUs/borrartramo.php' method='post' class='inline'>";
                    echo "<input  name='numero' type='hidden' value=" . $colum['numero'] . ">";
                    echo "<button type='submit' class='btn btn-danger eliminartramo'> <i class='bi bi-trash'></i></span></button>";
                    echo "</form></div>";
                    }
                    echo "</td>";
                    echo "</tr>";
            }
            echo "<td></td><td></td><td></td><td><button class='btn btn-success editar' data-bs-toggle='modal' data-bs-target='#modal_tramos'> <i class='bi bi-plus-square'></i></button></td>";
    echo "</table></div>";
    ?>
    <form>
    </form>
    <?php
    echo "</body>";
    echo "</html>";
    ?>
    <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario2" action="" method="post">
                        <input id='fecha' type='hidden' name='fecha' value='<?php $fecha_ini ?>'>
                        <input id='fecha_reserva' type='hidden' name='fecha_reserva' value=''>
                        <input id='tramo_sel' type='hidden' name='tramo_sel' value=''>
                        <label for="title">Nombre</label>
                        <input id="nombre" class="form-control" required autocomplete="off" name="nombre"
                            placeholder="Introduce un título" value="">
                        <br>
                        <label for="body">Comentario</label>
                        <input id="comentario" name="comentario" class="form-control" rows="3" value=""></input>
                        </script>
                        <br>
                        <select name="disponibilidad">
                            <option id="anular" value="1">Anular</option>
                            <option id="reservar" value="0">Reservar</option>
                            <option id="deshabilitar" value="2" type='hidden'> Deshabilitar tramo </option>
                            <option id="Habilitar" value="1"> Habilitar tramo </option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                        Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_evento2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Cita Reservada</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario_prev" action="" method="post">
                        <input id='fecha_prev' type='hidden' value='<?php $fecha_ini ?>'>
                        <label for="title">Fecha</label>
                        <input id='fecha_reserva_prev' class="form-control" readonly value=''>
                        <br>
                        <label for="title">Hora</label>
                        <input id='tramo_sel_prev' class="form-control" readonly value=''>
                        <br>
                        <label for="title">Nombre</label>
                        <input id="nombre_prev" class="form-control" required autocomplete="off"
                            placeholder="Introduce un título" value="" readonly>
                        <br>
                        <label for="body">Comentario</label>
                        <input id="comentario_prev" class="form-control" rows="3" value="" readonly></input>
                        </script>
                        <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_evento3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modificar tramo</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario_tramos" action="/tecnibus9/CitasUs/editartramo.php" method="post">
                        <input id='numero' name="numero" type='hidden' value=''>
                        <label for="title">Hora inicio</label>
                        <input id='inicio' name="inicio" class="form-control">
                        <br>
                        <label for="title">Hora final</label>
                        <input id='final' name="fin" class="form-control">
                        <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cerrar</button>
                        <button type="submit"  class="btn btn-success"><i class="fa fa-check"></i>Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tramos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Crear tramo</h4>
                </div>
                <div class="modal-body">
                    <form id="formulario_tramos_borrar" action="/tecnibus9/CitasUs/creartramo.php" method="post">
                        <input id='numero' name="ultimo_tramo" type='hidden' value='<?php echo $numtram?>'>
                        <label for="title">Hora inicio</label>
                        <input id='inicio' name="inicio" class="form-control">
                        <br>
                        <label for="title">Hora final</label>
                        <input id='final' name="fin" class="form-control">
                        <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cerrar</button>
                        <button type="submit" onclick="limpiarTramos();" class="btn btn-success"><i class="fa fa-check"></i>Añadir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
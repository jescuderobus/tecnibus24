<?php 
session_start();
if (empty($_SESSION["usuario"]) || ($_SESSION['tipo_usu']) != 1) {
        # Lo redireccionamos al formulario de inicio de sesión
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
$hoy = date("Y-m-d");
$base_url = "http://172.31-0.190/tecnibus9/CitasUS";
$user = "tecnibus9";
$pass = "TecniBus_123";
$host = "localhost";
$connection = mysqli_connect($host, $user, $pass);
$fecha_ini = date("");
$fecha_sig = date("");
$fecha_prev = date("");
$lunes = date("");
$peticion = "";
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
        //comprobamos que el usuario no tenga otra cita ese mismo día
        $comprobacion = "SELECT * FROM citas3 WHERE fecha = '". $_POST['fecha_reserva']."' ";
        $resultado = mysqli_query($connection, $comprobacion);

$cita_encontrada = 0;
while($comp = mysqli_fetch_array($resultado)){
        if($comp['nombre'] == $_POST['nombre']){
                $cita_encontrada = 1;
        }
}
        if($cita_encontrada ==0){
        $peticion = "INSERT INTO citas3 (fecha,tramo,nombre,comentario,hora_inicio,hora_fin) VALUES ('". $_POST['fecha_reserva']."',".$_POST['tramo_sel'].",'".$_POST['nombre']."','".$_POST['comentario']."','".$_POST['hora_inicio']."','".$_POST['hora_fin']."')";
        $connection->query($peticion);
}else{
        function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        alert("No es posible reservar la cita puesto que su usuario ya tiene una asignada el mismo día.");
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
        echo "No se ha podido realizar la consulta";
}
if (!$db) {
        echo "No se ha podido encontrar la Tabla";
} else
        $tramos_sql = "SELECT * FROM tramos WHERE nombre ='centrales' AND activo = 1 ORDER BY inicio ";
$miscitas = "SELECT * FROM citas3 WHERE fecha >= '$hoy' AND nombre = '" . $_SESSION['usuario'] . "'ORDER BY fecha";
$consulta = "SELECT * FROM citas3  WHERE fecha >= '$fecha_ini' AND fecha <= '$fecha_sig'  ORDER BY fecha ";

$result = mysqli_query($connection, $consulta);
if (!$result) {
          echo "No se ha podido realizar la consulta";
}

?>
<!DOCTYPE html>
<html lang="es"><head>
        <meta charset="utf-8">
        <title>Citas Bus</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script src='js/cal.js'></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script> windows.onload = limpiarFormulario(); </script>
        <!-- <link rel="stylesheet" href="css/boostrap.css" type="text/css> -->
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
        echo "<table>";
        echo "<tr>";
        echo "<th class='cabecero_tabla_fecha'><p>Fecha</p></th>";
        for ($i = 0; $i < 5; $i++) {
                if (date("Y-m-d", strtotime($fecha_ini . "+ " . $i . " days")) == $hoy) { ?>
                        <th class='hoy'>
                                <?php echo traducirDias(date('D d', strtotime($fecha_ini . '+ ' . $i . ' days')))." (".traducirFecha(date("M", strtotime($fecha_ini))).")" ?>
                        </th>
                        <?php
                } else {
                        if (((date('D', strtotime($fecha_ini . "+ " . $i . " days")) != 'Sun') && (date('D', strtotime($fecha_ini . "+ " . $i . " days")) != 'Sat'))) { ?>
                                <th class=> <?php echo traducirDias(date('D d', strtotime($fecha_ini . '+ ' . $i . ' days')))." (".traducirFecha(date("M", strtotime($fecha_ini . '+ ' . $i . ' days'))).")"?></th>
                                <?php
                        }
                }
        }
        echo "</tr>";
        // echo "<br>";
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
                        $ocupado=0;
                        $result_citas = mysqli_query($connection, $consulta);
                        $fechatabla = date("Y-m-d", strtotime($fecha_ini . "+ " . $j . " days"));
                        echo "<td ";
                        while ($colum4 = mysqli_fetch_array($result_citas)) {
                                if ($fechatabla == $colum4['fecha'] && $colum4['tramo'] == $colum3['numero']) {
                                        echo "class='no_disponible_usu'></td>";
                                        $ocupado=1;

                                }
                        }
                        if(($fechatabla < $hoy) && ($ocupado == 0) ){
                                ?> class="pasado"<?php
                                echo "</td>";
                         }else{if($ocupado == 0){ ?>
                                 class="disponible <?php echo date('D', strtotime($colum['fecha'])) ?>" data-bs-toggle='modal' onclick="setfecha('<?php echo $fechatabla ?>');setInicio('<?php echo $colum3['inicio'] ?>');setFinal('<?php echo $colum3['fin'] ?>'); settramo(<?php echo $i;?>);fechaactual('<?php echo $fecha_ini ?>') ;limpiarFormulario()" data-bs-target='#add_evento'><?php ?> </td>
                        <?php
                        }}


                }
                echo "</tr>";
        }



        echo "</table>";
        echo "<div class='containern botones '><div class='row'><div class='col semana_anterior'>";
       
        if($fecha_ini > $lunes){
                echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>"; //TODO mover botones
    echo "<input id='fecha_prev' name='fecha' type='hidden' value=" . $fecha_prev . ">";
                echo "<button type='submit' class='btn btn-secondary btn-sm '>  <i class='bi bi-chevron-bar-left'></i>Semana Anterior</button>";
                echo "</form>";
        }
        echo "</div>";
        echo "<div class='col volverhoy'><form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'";
        echo "<input id='fecha_actual' name='fecha' type='hidden' value=" . $lunes . ">";
        echo "<button type='submit' class='btn btn-secondary btn-sm'>Semana Actual <i class='bi bi-house'></i></button></div>";
        echo "</form>";
        echo "<div class='col siguiente'><form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline' >";
        echo "<input id='fecha_sig' name='fecha' type='hidden' value=" . $fecha_sig . ">";
        echo "<button type='submit' class='btn btn-secondary btn-sm'>Semana Siguiente <i class='bi bi-chevron-bar-right'></i></button></div>";
        echo "</form> </div></div>";
        echo "<h1>Mis citas</h1>";
        echo "<table class='miscitas'>";
        echo "<th class='misfechas'>Fecha</th>";
        echo "<th class='mishoras' >Hora</th>";
        echo "<th class='mispreguntas'>Pregunta</th>";
        echo "<th class='miscancelar'></th>";
        $result = mysqli_query($connection, $miscitas);
        while ($colum = mysqli_fetch_array($result)) {
                if ($colum['nombre'] == $_SESSION['usuario']) {
                        $tramos = "SELECT * FROM tramos WHERE numero = " . $colum['tramo'] . "";
                        $result_tram = mysqli_query($connection, $tramos);
                        $colum3 = mysqli_fetch_array($result_tram);
                        $tram = $colum['tramo_sel'];
                        $horas = 'horas' . $colum['tramo'];
                        if($colum['fecha']>= $hoy){
                        echo "<tr>";
                        echo "<td>" . $colum['fecha'] . "</td>";
                        echo "<td>".$colum3['inicio'] . " - " . $colum3['fin']."</td>";
                        echo "<td>" . $colum['comentario'] . "</td>";
                        echo "<td>";
                        echo "<form action='/tecnibus9/CitasUs/borrarcita.php' method='post' class='inline'>";
                        echo "<input  name='fecha' type='hidden' value=" . $fecha_ini . ">";
                        echo "<input  type='hidden' name='fecha_reserva' value='" . $colum['fecha'] . "'>";
                        echo "<input  type='hidden' name='comentario' value=''>";
                        echo "<input  type='hidden' name='nombre' value=''>";
                        echo "<input type='hidden' name='tramo_sel' value='" . $colum['tramo'] . "'>";
                        echo "<button type='submit' class='btn btn-danger'> CANCELAR</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                }
        }
        }
        echo "</table>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        ?>
        <div class="modal fade formulario" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="basiclLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <h4 class="modal-title fs-5" id="myModalLabel">Agregar nuevo evento</h4>
                                </div>
                                <div class="modal-body">
                                        <form id="formulario2" action="" method="post">
                                                <input id='fecha' type='hidden' name='fecha'
                                                        value='<?php $fecha_ini ?>'>
                                                <input id='fecha_reserva' type='hidden' name='fecha_reserva' value=''>
                                                <input id='hora_inicio' type='hidden' name='hora_inicio' value=''>
                                                <input id='hora_fin' type='hidden' name='hora_fin' value=''>
                                                <input id='disponibilidad' type='hidden' name='disponibilidad'
                                                        value='0'>
                                                <input id='tramo_sel' type='hidden' name='tramo_sel' value=''>
                                                <label for="title">Nombre</label>
                                                <input type="text" required autocomplete="off" readonly name="nombre"
                                                        value="<?php echo $_SESSION["usuario"]; ?>" class="form-control"
                                                        id="title">

                                                <br>
                                                <label for="body">Pregunta para la consulta</label>
                                                <textarea id="body" name="comentario"  class="form-control"
                                                        rows="3"></textarea>
                                                </script>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                        class="fa fa-times"></i>
                                                Cancelar</button>
                                        <button type="submit" class="btn btn-success margin"><i class="fa fa-check"></i>
                                                Agregar</button>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog">
  
      

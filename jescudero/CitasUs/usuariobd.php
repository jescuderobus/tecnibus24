<?php echo '<link rel="stylesheet" href="css/style.css" type="text/css">';

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
        echo "No se ha podido conectar con el servidor" . mysql_error();
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
        $peticion = "UPDATE citas2 SET nombre_" . $_POST['tramo_sel'] . "='" . $_POST['nombre'] . "', comentario_" . $_POST['tramo_sel'] . "='" . $_POST['comentario'] . "', disponibilidad_" . $_POST['tramo_sel'] . "=".$_POST['disponibilidad']." WHERE fecha ='" . $_POST['fecha_reserva'] . "'";
        $connection->query($peticion);
}

if (!$db) {
        echo "No se ha podido encontrar la Tabla";
} else
        $miscitas = "SELECT * FROM citas3 WHERE nombre = '" . $_SESSION['usuario'] . "'";
        $consulta = "SELECT * FROM citas3  WHERE fecha >= '$fecha_ini' LIMIT 28";
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
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/cal.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
        <?php
        echo "1";
        echo "<div>";
        echo "<div class='usuario'><p> Usuario: " . $_SESSION['usuario'] . "</p><a href='http://172.31.0.190/tecnibus9/CitasUs/cierrasesion.php'>Cerrar Sesion</a></div>";
        echo "<h1>" . date("M-Y", strtotime($hoy)) . "</h1>";
        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
        echo "<input id='fecha_prev' name='fecha' type='hidden' value=" . $lunes . ">";
        echo "<button> Semana Actual</button>";
        echo "</form>";
        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
        echo "<input id='fecha_sig' name='fecha' type='hidden' value=" . $fecha_sig . ">";
        echo "<button> Siguiente semana</button>";
        echo "</form>";
        echo "<table>";
        echo "<tr>";
        echo "<th><p>Fecha</p></th>";
        while ($colum = mysqli_fetch_array($result)) {
                if ($colum['fecha'] == $hoy) {
                        echo "<th class='hoy'>" . date("D d", strtotime($colum['fecha'])) . "</th>";
                } else {
                        if (((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                                echo "<th>" . date("D d", strtotime($colum['fecha'])) . "</th>";

                        }
                }
        }
        echo "</tr>";
        echo "<tr>";
        echo "<th><h6>10:00-11:30</h6></th>";
        $result = mysqli_query($connection, $consulta);
        while ($colum = mysqli_fetch_array($result)) {
                if (($colum['fecha'] >= $hoy) && ((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                        if ($colum['disponibilidad_1'] == TRUE) {
                                ?>
                                <td <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?>
                                        class="disponible <?php echo date('D', strtotime($colum['fecha'])) ?>" data-toggle='modal'
                                        onclick="setfecha('<?php echo date('Y-m-d', strtotime($colum['fecha'])) ?>');settramo('1');fechaactual('<?php echo $fecha_ini ?>');limpiarFormulario()"
                                        data-target='#add_evento'><?php echo $colum['disponibilidad_1'] ?> </td>
                                <?php
                        } else {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='no_disponible_usu  " . date('D', strtotime($colum['fecha'])) . " '>" . $colum['disponibilidad_1'] . "</td>";
                        }
                } else {
                        if (((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                                echo "<td class='pasado' name=" . date('Y-m-d', strtotime($colum['fecha'])) . "></td>";
                        }
                }
        }
        echo "</tr>";
        echo "<tr>";
        echo "<th><h6>10:30-11:00</h6></th>";
        $result = mysqli_query($connection, $consulta);
        while ($colum = mysqli_fetch_array($result)) {
                if (($colum['fecha'] >= $hoy) && ((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                        if ($colum['disponibilidad_2'] == TRUE) {
                                ?>
                                <td <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?>
                                        class="disponible <?php echo date('D', strtotime($colum['fecha'])) ?>" data-toggle='modal'
                                        onclick="setfecha('<?php echo date('Y-m-d', strtotime($colum['fecha'])) ?>');settramo('2');fechaactual('<?php echo $fecha_ini ?>');limpiarFormulario()"
                                        data-target='#add_evento'><?php echo $colum['disponibilidad_2'] ?> </td>
                                <?php
                        } else {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='no_disponible_usu  " . date('D', strtotime($colum['fecha'])) . "'>" . $colum['disponibilidad_2'] . "</td>";
                        }
                } else {
                        if (((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='pasado'></td>";
                        }
                }
        }
        echo "</tr>";
        echo "<tr>";
        echo "<th><h6>11:00 - 11:30</h1></th>";
        $result = mysqli_query($connection, $consulta);
        while ($colum = mysqli_fetch_array($result)) {
                if (($colum['fecha'] >= $hoy) && ((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                        if ($colum['disponibilidad_3'] == TRUE) {
                                ?>
                                <td <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?>
                                        class="disponible <?php echo date('D', strtotime($colum['fecha'])) ?>" data-toggle='modal'
                                        onclick="setfecha('<?php echo date('Y-m-d', strtotime($colum['fecha'])) ?>');settramo('3');fechaactual('<?php echo $fecha_ini ?>');limpiarFormulario()"
                                        data-target='#add_evento'><?php echo $colum['disponibilidad_3'] ?> </td>
                                <?php
                        } else {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='no_disponible_usu  " . date('D', strtotime($colum['fecha'])) . "'>" . $colum['disponibilidad_3'] . "</td>";
                        }
                } else {
                        if (((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='pasado'></td>";
                        }
                }
        }
        echo "</tr>";
        echo "<tr>";
        echo "<th><h6>11:30-12:00</h6></th>";
        $result = mysqli_query($connection, $consulta);
        while ($colum = mysqli_fetch_array($result)) {
                if (($colum['fecha'] >= $hoy) && ((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                        if ($colum['disponibilidad_4'] == TRUE) {
                                ?>
                                <td <?php echo "name=" . date('Y-m-d', strtotime($colum['fecha'])) . "" ?>
                                        class="disponible <?php echo date('D', strtotime($colum['fecha'])) ?>" data-toggle='modal'
                                        onclick="setfecha('<?php echo date('Y-m-d', strtotime($colum['fecha'])) ?>');settramo('4');fechaactual('<?php echo $fecha_ini ?>');limpiarFormulario()"
                                        data-target='#add_evento'><?php echo $colum['disponibilidad_4'] ?> </td>
                                <?php
                        } else {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='no_disponible_usu  " . date('D', strtotime($colum['fecha'])) . "'>" . $colum['disponibilidad_4'] . "</td>";
                        }
                } else {
                        if (((date('D', strtotime($colum['fecha'])) != 'Sun') && (date('D', strtotime($colum['fecha'])) != 'Sat'))) {
                                echo "<td name=" . date('Y-m-d', strtotime($colum['fecha'])) . " class='pasado'></td>";
                        }
                }
        }
        echo "</tr>";
        echo "</table>";
        echo "</div>";
        echo "<h1>Mis citas</h1>";
        echo "<table class='miscitas'>";
        echo "<th class='misfechas'>Fecha</th>";
        echo "<th class='mishoras' >Hora</th>";
        echo "<th class='mispreguntas'>Pregunta</th>";
        echo "<th class='miscancelar'></th>";
        echo $_SESSION['usuario'];
        $result = mysqli_query($connection, $miscitas);
        while ($colum = mysqli_fetch_array($result)) {
                if ($colum['nombre_1'] == $_SESSION['usuario']) {
                        echo "<tr>";
                        echo "<td>" . $colum['fecha'] . "</td><td>10:00 - 10:30</td> ";
                        echo "<td>".$colum['comentario_1']."</td>";
                        echo "<td>";
                        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
                        echo "<input  name='fecha' type='hidden' value=" . $fecha_ini . ">";
                        echo "<input  type='hidden' name='fecha_reserva' value='".$colum['fecha']."'>";
                        echo "<input  type='hidden' name='comentario' value=''>";
                        echo "<input  type='hidden' name='nombre' value=''>";
                        echo "<input  type='hidden' name='disponibilidad' value='1'>";
                        echo "<input type='hidden' name='tramo_sel' value='1'>";
                        echo "<button type='submit' class='btn btn-danger'> CANCELAR</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                }
                if ($colum['nombre_2'] == $_SESSION['usuario']) {
                        echo "<tr>";
                        echo "<td>" . $colum['fecha'] . "</td><td>10:30 - 11:00</td>";
                        echo "<td>".$colum['comentario_2']."</td>";
                        echo "<td>";
                        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
                        echo "<input  name='fecha' type='hidden' value=" . $fecha_ini . ">";
                        echo "<input  type='hidden' name='fecha_reserva' value='".$colum['fecha']."'>";
                        echo "<input  type='hidden' name='comentario' value=''>";
                        echo "<input  type='hidden' name='nombre' value=''>";
                        echo "<input  type='hidden' name='disponibilidad' value='1'>";
                        echo "<input type='hidden' name='tramo_sel' value='2'>";
                        echo "<button type='submit' class='btn btn-danger margin'> CANCELAR</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                }
                if ($colum['nombre_3'] == $_SESSION['usuario']) {
                        echo "<tr>";
                        echo "<td>" . $colum['fecha'] . "</td><td>11:00 - 11:30</td>";
                        echo "<td>".$colum['comentario_3']."</td>";
                        echo "<td>";
                        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
                        echo "<input  name='fecha' type='hidden' value=" . $fecha_ini . ">";
                        echo "<input  type='hidden' name='fecha_reserva' value='".$colum['fecha']."'>";
                        echo "<input  type='hidden' name='comentario' value=''>";
                        echo "<input  type='hidden' name='nombre' value=''>";
                        echo "<input  type='hidden' name='disponibilidad' value='1'>";
                        echo "<input type='hidden' name='tramo_sel' value='3'>";
                        echo "<button type='submit' class='btn btn-danger margin '> CANCELAR</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                }
                if ($colum['nombre_4'] == $_SESSION['usuario']) {
                        echo "<tr>";
                        echo "<td>" . $colum['fecha'] . "</td><td>11:30 - 12:00</td>";
                        echo "<td>".$colum['comentario_4']."</td>";
                        echo "<td>";
                        echo "<form action='/tecnibus9/CitasUs/usuario.php' method='post' class='inline'>";
                        echo "<input  name='fecha' type='hidden' value=" . $fecha_ini . ">";
                        echo "<input  type='hidden' name='fecha_reserva' value='".$colum['fecha']."'>";
                        echo "<input  type='hidden' name='comentario' value=''>";
                        echo "<input  type='hidden' name='nombre' value=''>";
                        echo "<input  type='hidden' name='disponibilidad' value='1'>";
                        echo "<input type='hidden' name='tramo_sel' value='4'>";
                        echo "<button type='submit' class='btn btn-danger margin'> CANCELAR</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
        }}
        echo "</table>";
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
                                        <form id="formulario" action="" method="post">
                                                <input id='fecha' type='hidden' name='fecha'
                                                        value='<?php $fecha_ini ?>'>
                                                <input id='fecha_reserva' type='hidden' name='fecha_reserva' value=''>
                                                <input id='disponibilidad' type='hidden' name='disponibilidad' value='0'>
                                                <input id='tramo_sel' type='hidden' name='tramo_sel' value=''>
                                                <label for="title">Nombre</label>
                                                <input type="text" required autocomplete="off" readonly name="nombre"
                                                        value="<?php echo $_SESSION["usuario"]; ?>" class="form-control"
                                                        id="title">

                                                <br>
                                                <label for="body">Pregunta para la consulta</label>
                                                <textarea id="body" name="comentario" required class="form-control"
                                                        rows="3"></textarea>
                                                </script>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                        class="fa fa-times"></i>
                                                Cancelar</button>
                                        <button type="submit" class="btn btn-success margin"><i class="fa fa-check"></i>
                                                Agregar</button>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>
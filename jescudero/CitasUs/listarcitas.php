<?php echo '<link rel="stylesheet" href="css/style.css" type="text/css">';
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
    $peticion = "SELECT* citas2 SET nombre_" . $_POST['tramo_sel'] . "='" . $_POST['nombre'] . "', comentario_" . $_POST['tramo_sel'] . "='" . $_POST['comentario'] . "', disponibilidad_" . $_POST['tramo_sel'] . "=0 WHERE fecha ='" . $_POST['fecha_reserva'] . "'";
    $connection->query($peticion);
}

if (!$db) {
    echo "No se ha podido encontrar la Tabla";
} else

    $consulta = "SELECT * FROM citas2  WHERE fecha >= '$fecha_ini' LIMIT 7 ";
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
    <!-- <link rel="stylesheet" href="css/calendar.css"> -->
    <aS></aS>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <script type="text/javascript" src="js/es-ES.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/cal.js"></script>
    <!-- <script src="js/moment.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/bootstrap-datetimepicker.js"></script> -->
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
    <!-- <script src="js/bootstrap-datetimepicker.es.js"></script> -->

</head>
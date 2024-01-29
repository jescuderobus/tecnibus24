<?php
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
$hoy_normal=date("d-m-Y");
$biblio ="centrales";
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
    $peticion = "UPDATE citas3 SET nombre ='" . $_POST['nombre'] . "', comentario='" . $_POST['comentario'] . "', disp = " . $_POST['disponibilidad'] . " WHERE fecha = '" . $_POST['fecha_reserva'] . "' AND tramo = " . $_POST['tramo_sel'];
    $connection->query($peticion);
}





















?>
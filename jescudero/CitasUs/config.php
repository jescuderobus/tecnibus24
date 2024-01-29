<?php
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
$datab = "tecnibus9";
if (date("D") == "Mon") {
        $lunes = date("Y-m-d");
} else {
        if ((date("D") != "Sat") && ((date("D") != "Sun"))) {
                $lunes = date("Y-m-d", strtotime('last Monday', time()));
        } else {
                $lunes = date("Y-m-d", strtotime('next Monday', time()));
        }
}
?>
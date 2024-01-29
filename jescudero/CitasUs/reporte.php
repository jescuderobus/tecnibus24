<?php
require_once("admin/libreria/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnable' => true));
$dompdf->setOptions($options);
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
ob_start();
echo "<style>";
echo "h2 {";
echo "text-align: center; margin:auto; padding:20px 0; width:75%;";
echo "}";
echo "table, {";
echo "    border-collapse: collapse; margin:auto; width:75%;";
echo "}";
echo "table,th,td{";
echo "border: 1px solid black;";
echo "}";
echo "th,td {";
echo "padding: 5px;";
echo "}";
echo "</style>";
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "    <meta charset='utf-8'>";
echo "    <title>Citas Bus</title>";
echo "    <script src='js/cal.js'></script>";
echo "    <link rel='stylesheet' href='css/style.css' type='text/css'>";
echo "</head>";
echo "    <body> ";
echo "<h2> CITAS DE HOY </h2>";
echo "<table>";
echo "<tr>";
echo "<th><p>Hora</p></th>";
echo "<th><p>Nombre</p></th>";
echo "<th><p>Comentario</p></th>";
echo "</tr>";
for ($i = 1; $i <= $numtram; $i++) {
    $tramos = "SELECT * FROM tramos WHERE numero = ".$i." ";
    $result_tram = mysqli_query($connection, $tramos);
    $colum3 = mysqli_fetch_array($result_tram);
    echo "<tr>";
    echo "<th><h6>";
    echo $colum3['inicio']."-".$colum3['fin'];
    echo "</h6></th>";
    echo "<td>";
    $result = mysqli_query($connection, $citashoy);
    while ($colum4 = mysqli_fetch_array($result)) {
    if ($colum4['tramo'] == $i) {
        if($colum4 ['disp'] == 0){
        echo $colum4['nombre'];
        }
    }

}
    echo "</td>";
    echo "<td>";
    $result = mysqli_query($connection, $citashoy);
    while ($colum4 = mysqli_fetch_array($result)) {
    if ($colum4['tramo'] == $i) {
        if($colum4 ['disp'] == 0){
        echo $colum4['comentario'];
        }
    }

}
    echo "</tr>";


}
echo "</table>";
echo " </body>";
echo "   </html>";

$html = ob_get_clean();
//echo $html;
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("horario_".$hoy_normal.".pdf", array("Attachment" => true));
?>
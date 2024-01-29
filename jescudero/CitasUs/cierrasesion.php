<?php
/* Destruir la sesion */
session_start();
session_destroy();
/* Redirigir */
header('Location: http://172.31.0.190/tecnibus9/CitasUs/login.php');
?>
<?php
// Obtener el timestamp actual
$timestamp = time();

// Construir la URL de redirección con el timestamp
$url = "infoLikeBussi.html?" . $timestamp;

// Redirigir al navegador a la nueva URL
header("Location: $url");
exit;
?>

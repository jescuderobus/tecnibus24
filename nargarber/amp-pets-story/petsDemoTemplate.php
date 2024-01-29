<?php
// Obtener el timestamp actual
$timestamp = time();

// Construir la URL de redirección con el timestamp
$url = "petsDemoTemplate.html?" . $timestamp;

// Redirigir al navegador a la nueva URL
header("Location: $url");
exit;
?>

<?php
// Establece el directorio que quieres listar
$directorio = '.';

// Abre el directorio
$gestor = opendir($directorio);

if ($gestor) {
    echo "<h1>Listado del directorio: $directorio</h1>";
    echo "<ul>";

    // Recorre todos los archivos del directorio
    while (false !== ($archivo = readdir($gestor))) {
        // Omite los directorios . y ..
        if ($archivo != "." && $archivo != "..") {
            // Crea un enlace a cada archivo/directorio
            echo "<li><a href='$archivo'>$archivo</a></li>";
        }
    }

    echo "</ul>";
    closedir($gestor);
}
?>

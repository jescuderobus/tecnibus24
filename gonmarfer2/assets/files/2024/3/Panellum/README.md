# Script para generar Recorridos para Panellum

## ¿Cómo funciona?

1. Se crea una carpeta _data_ donde incluir tres ficheros:
    1. __escenas.csv__ (Contiene la información de las escenas)
    2. __hotspotinfo.csv__ (Contiene la información de los hotspots de información)
    3. __hotspotescenas.csv__ (Contiene la información de los hotspots de escenas)
2. Se ejecuta el script Python _generate_paths.py_
3. El script genera una carpeta _out_ con el fichero HTML generado, y cuyo título será la fecha y la hora actuales.

## ¿Cómo deben ser los ficheros?

### escenas.csv

Tiene la cabecera:
`idEscena,title,basePath`

* idEscena (texto): el identificador de la escena.

* title (texto): la descripción de la escena.

* basePath (texto): ruta de la imagen panorámica de la escena.

### hotspotinfo.csv

Tiene la cabecera:
`idEscena,pitch,yaw,text,URL`

* idEscena (texto): el identificador de la escena.

* pitch (número): posición Y del punto.

* yaw (número): posición X del punto.

* text (texto): descripción del punto.

* URL (texto): ruta opcional.

### hotspotescenas.csv

Tiene la cabecera:
`idEscena,sceneId,pitch,yaw,text,targetYaw,targetPitch`

* idEscena (texto): el identificador de la escena de origen.

* sceneId (texto): el identificador de la escena de destino.

* pitch (número): posición Y del punto.

* yaw (número): posición X del punto.

* text (texto): descripción del punto.

* targetPitch (número): posición Y del punto.

* targetYaw (número): posición X del punto.

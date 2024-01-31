# Formabus Mysteries


Después de jugar un poco con la güija nos informan de que se han perdido registros de un server.


## Buscar una cadena en una base de datos

Este script busca una cadena de texto y reporta en que tabla y columna se encuentra.

```bash
#!/bin/bash

# Definir la cadena que deseas buscar
SEARCH_STRING="cadena_a_buscar"

# Nombre de la base de datos
DATABASE_NAME="baseDeDatos"
DATABASE_USER="usuario"
DATABASE_PWD="password"

# Obtener la lista de todas las tablas en la base de datos
TABLES=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SHOW TABLES;" 2>/dev/null | tail -n +2)

# Iterar a través de las tablas y buscar la cadena en todas las columnas de cada tabla
for TABLE in $TABLES; do
  COLUMNS=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SHOW COLUMNS FROM $TABLE;" 2>/dev/null | awk '{print $1}' | tail -n +2)
  for COLUMN in $COLUMNS; do
    FOUND=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SELECT 1 FROM $TABLE WHERE $COLUMN LIKE '%$SEARCH_STRING%';" 2>/dev/null )
    if [ -n "$FOUND" ]; then
      echo "La cadena '$SEARCH_STRING' se encontró en la tabla $TABLE, columna $COLUMN."
    fi
  done
done
```

## Buscar una cadena en un conjunto de ficheros

``` bash
egrep -i "search" `find . -name *.js -type f -print`
```

## Calcular lo que ocupa cada tabla de una BBDD

Primera aproximación

```bash
#!/bin/bash

# Nombre de la base de datos
DATABASE_NAME="baseDeDatos"
DATABASE_USER="usuario"
DATABASE_PWD="password"

# Obtener el tamaño total de la base de datos en bytes
TOTAL_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT SUM(data_length + index_length) FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME';" --skip-column-names  2>/dev/null )

# Obtener la lista de todas las tablas en la base de datos
TABLES=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SHOW TABLES;" --skip-column-names  2>/dev/null )

# Calcular y mostrar el porcentaje de cada tabla
for TABLE in $TABLES; do
  TABLE_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT data_length + index_length FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME' AND table_name = '$TABLE';" --skip-column-names  2>/dev/null )
  
  # Calcular el porcentaje
  PERCENTAGE=$(echo "scale=2; $TABLE_SIZE / $TOTAL_SIZE * 100" | bc)
  
  echo "Tabla: $TABLE - Tamaño: $TABLE_SIZE bytes - Porcentaje: $PERCENTAGE%"
done

```

Segunda Aproximación, con dos decimales y quitando la salida de errores

```bash

#!/bin/bash

# Nombre de la base de datos
DATABASE_NAME="baseDeDatos"
DATABASE_USER="usuario"
DATABASE_PWD="password"

# Obtener el tamaño total de la base de datos en bytes y redirigir errores a /dev/null
TOTAL_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT SUM(data_length + index_length) FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME';" --skip-column-names 2>/dev/null)

# Obtener la lista de todas las tablas en la base de datos
TABLES=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SHOW TABLES;" --skip-column-names 2>/dev/null)

# Calcular y mostrar el porcentaje de cada tabla
for TABLE in $TABLES; do
  # Obtener el tamaño de la tabla y redirigir errores a /dev/null
  TABLE_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT data_length + index_length FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME' AND table_name = '$TABLE';" --skip-column-names 2>/dev/null)
  
  # Calcular el porcentaje con dos decimales
  PERCENTAGE=$(echo "scale=2; $TABLE_SIZE / $TOTAL_SIZE * 100" | bc 2>/dev/null)
  
  # Evitar mostrar "0.00%" si el porcentaje es muy bajo
  if [ "$PERCENTAGE" != "0.00" ]; then
    echo "Tabla: $TABLE - Tamaño: $TABLE_SIZE bytes - Porcentaje: $PERCENTAGE%"
  fi
done

```

Tercera aproximación, ignorando algunas tablas

```bash

#!/bin/bash

# Nombre de la base de datos
DATABASE_NAME="baseDeDatos"
DATABASE_USER="usuario"
DATABASE_PWD="password"

# Lista de tablas a ignorar (separadas por espacios)
IGNORED_TABLES=("tabla1" "tabla2")

# Obtener el tamaño total de la base de datos en bytes y redirigir errores a /dev/null
TOTAL_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT SUM(data_length + index_length) FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME';" --skip-column-names 2>/dev/null)

# Obtener la lista de todas las tablas en la base de datos
TABLES=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "USE $DATABASE_NAME; SHOW TABLES;" --skip-column-names 2>/dev/null)

# Calcular y mostrar el porcentaje de cada tabla
for TABLE in $TABLES; do
  # Verificar si la tabla actual está en la lista de tablas a ignorar
  if [[ " ${IGNORED_TABLES[@]} " =~ " $TABLE " ]]; then
    continue  # Saltar la tabla y pasar a la siguiente si está en la lista de ignoradas
  fi
  
  # Obtener el tamaño de la tabla y redirigir errores a /dev/null
  TABLE_SIZE=$(mysql -u $DATABASE_USER -p$DATABASE_PWD -e "SELECT data_length + index_length FROM information_schema.TABLES WHERE table_schema = '$DATABASE_NAME' AND table_name = '$TABLE';" --skip-column-names 2>/dev/null)
  
  # Calcular el porcentaje con dos decimales
  PERCENTAGE=$(echo "scale=2; $TABLE_SIZE / $TOTAL_SIZE * 100" | bc 2>/dev/null)
  
  # Evitar mostrar "0.00%" si el porcentaje es muy bajo
  if [ "$PERCENTAGE" != "0.00" ]; then
    echo "Tabla: $TABLE - Tamaño: $TABLE_SIZE bytes - Porcentaje: $PERCENTAGE%"
  fi
done


```

## Algunas sentencias SQL interesantes

```sql
 select * from watchdog WHERE timestamp BETWEEN 1706518800 AND 1706536800;

```
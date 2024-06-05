<?php
/**
 * Function file to get info from database
 */
function get_elements_sql($conn){
    // Check connection
    if ($conn->connect_error) {
        return false;
    } else {
        // Preparar la consulta SQL
        $query = "SELECT id, id_imdb, titulo, descripcion, anho, tipo, duracion, img_url, fecha_created FROM elemento";
        // Ejecutar la consulta preparada
        $stmt = $conn->prepare($query);
        // Verificar si la consulta se ejecutó correctamente
        if ($stmt->execute()) {
            // Obtener resultados de la consulta
            $result = $stmt->get_result();
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                $elements = array();
                // Recorrer los resultados y crear objetos Elemento
                while ($row = $result->fetch_assoc()) {
                    $element = new Elemento($row['id'], $row['id_imdb'], $row['titulo'], $row['descripcion'], $row['anho'], $row['tipo'], $row['duracion'], $row['img_url'], $row['fecha_created']);
                    $elements[] = $element;
                }
                // Cerrar la sentencia
                $stmt->close();
                return $elements;
            } else {
                // Cerrar la sentencia
                $stmt->close();
                return false;
            }
        } else {
            // Cerrar la sentencia
            $stmt->close();
            return false;
        }
    }
}

function get_element_by_id($conn, $id){
    // Check connection
    if ($conn->connect_error) {
        return false;
    } else {
        // Preparar la consulta SQL con un marcador de posición (?)
        $query = "SELECT * FROM elemento WHERE id_imdb = ?";
        // Preparar la sentencia
        $stmt = $conn->prepare($query);
        // Vincular el parámetro a la consulta
        $stmt->bind_param("s", $id);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $elements = array();
            // Recorrer los resultados y crear objetos Elemento
            while ($row = $result->fetch_assoc()) {
                $element = new Elemento($row['id'], $row['id_imdb'], $row['titulo'], $row['descripcion'], $row['anho'], $row['tipo'], $row['duracion'], $row['img_url'], $row['fecha_created']);
                $elements[] = $element;
            }
            // Cerrar la sentencia
            $stmt->close();
            return $elements;
        } else {
            // Cerrar la sentencia
            $stmt->close();
            return false;
        }
    }
}

/**
 * Método para validar los $_POST del form de index.php
 */
//function validar_array

?>
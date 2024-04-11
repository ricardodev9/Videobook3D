<?php
/**
 * Function file to get info from database
 */
function get_elements_sql($conn){
   
    // Check connection
    if ($conn->connect_error) {
      //die("Connection failed: " . $conn->connect_error);
      return false;
    }else{
        $query = "SELECT * FROM elemento";
        $result = $conn->query($query);
        // check if results is not empty
        if ($result && $result->num_rows > 0) {
            // loop over results and create new Element
            while ($row = $result->fetch_assoc()) {
                // Crear un nuevo objeto Elemento y agregarlo al array
                $element = new Elemento($row['id'], $row['id_imdb'] , $row['titulo'],$row['descripcion'], $row['anho'], $row['tipo'],$row['img_url'],$row['fecha_created']);
                $elements[] = $element;
            }
        }
        return $elements;
    }

}
?>
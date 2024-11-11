<?php
/**
 * Class para el elemento videobook, que puede ser película, serie, libro...
*/
class Videobook {
    private $conn;

    //conexión a la base de datos
    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    /**
     * Get para todos los elementos de la bbdd
     */
    function getVideobooks(){
        $sql = "SELECT * FROM elemento";
        $result = $this->conn->query($sql);
        // Verifica que se obtuvieron resultados
        if ($result->num_rows > 0) {
            $videbooks = [];
            while ($videbook = $result->fetch_object()) {
                $videbooks[] = $videbook;
            }
            return $videbooks;
        } else {
            return [];
        }
    }

    /**
     * Get un videobook en concreto
     */
    function getVideobookByUuid($uuid){
        $stmt = $this->conn->prepare("SELECT * FROM elemento WHERE uuid = ?");
        $stmt->bind_param("s", $uuid);
        $stmt->execute();
        
        // Obtener el resultado
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_object();
        } else {
            return null;
        }
        // Cerrar el statement
        $stmt->close();
    }
}

?>
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
            $users = [];
            while ($user = $result->fetch_object()) {
                $users[] = $user;
            }
            return $users;
        } else {
            return [];
        }
    }
}
?>
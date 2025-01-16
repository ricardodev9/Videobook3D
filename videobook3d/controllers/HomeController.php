<?php

class HomeController
{
    private $conn;
    private $videobook_table = "videobook";

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function index()
    {
        $data = [
            'title' => 'Página de inicio',
            'welcomeMessage' => '¡Bienvenido a nuestro sitio web!',
            'elementos' => $this->getVideobooks()
        ];

        render_view('home', $data);
    }

    /**
     * Get para todos los elementos de la bbdd
     */
    private function getVideobooks()
    {
        try {
            $sql = "SELECT * FROM {$this->videobook_table}";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ); // Retorna los resultados como objetos
        } catch (PDOException $e) {
            error_log("Error al obtener videobooks: " . $e->getMessage());
            return [];
        }
    }
}

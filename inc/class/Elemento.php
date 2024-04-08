<?php
/**
 * 
*/
class Elemento{
    public $id;
    public $titulo;
    public $anho;
    public $tipo;
    public $fecha_created;
    //we need to know if class attr require date_created

    public function __construct($id,$titulo,$anho,$tipo,$fecha_created) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->anho = $anho;
        $this->tipo = $tipo;
        $this->fecha_created = $fecha_created;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of anho
     */ 
    public function getAnho()
    {
        return $this->anho;
    }

    /**
     * Set the value of anho
     *
     * @return  self
     */ 
    public function setAnho($anho)
    {
        $this->anho = $anho;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of fecha_created
     */ 
    public function getFecha_created()
    {
        return $this->fecha_created;
    }

    /**
     * Set the value of fecha_created
     *
     * @return  self
     */ 
    public function setFecha_created($fecha_created)
    {
        $this->fecha_created = $fecha_created;

        return $this;
    }
}
?>
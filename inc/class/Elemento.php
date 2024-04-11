<?php
/**
 * 
*/
class Elemento{
    public $id;
    public $titulo;
    public $descripcion;
    public $anho;
    public $tipo;
    public $img_url;
    public $fecha_created;
    
   
    //we need to know if class attr require date_created

    public function __construct($id,$titulo,$descripcion,$anho,$tipo,$img_url,$fecha_created) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->anho = $anho;
        $this->tipo = $tipo;
        $this->img_url = $img_url;
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

    /**
     * Get the value of img_url
     */ 
    public function getImg_url()
    {
        return $this->img_url;
    }

    /**
     * Set the value of img_url
     *
     * @return  self
     */ 
    public function setImg_url($img_url)
    {
        $this->img_url = $img_url;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDescripcionFormatted($descripcion){
        $desc_formatted = $descripcion;
        if(strlen($this->descripcion) > 200){
            $desc_formatted = substr($this->descripcion, 0, 200) . "..."; 
        }
        return $desc_formatted;
    }
}
?>
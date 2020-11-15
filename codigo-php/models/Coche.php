<?php
class Coche {
    private $matricula;
    private $precio;
    private $marca;
    private $modelo;
    private $n_puertas;
    private $color;
    private $edad;

    //Constructor del coche
    public function __construct($matricula, $precio, $marca, $modelo, $n_puertas, $color, $edad){
        $this->matricula = $matricula;
        $this->precio = $precio;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->n_puertas = $n_puertas;
        $this->color = $n_puertas;
        $this->edad = $edad;
    }

    //GETTERS $ SETTERS

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getNPuertas()
    {
        return $this->n_puertas;
    }

    /**
     * @param mixed $n_puertas
     */
    public function setNPuertas($n_puertas)
    {
        $this->n_puertas = $n_puertas;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * Actualiza un coche
     * @param $matricula String de la matricula
     * @param $precio String del precio
     * @param $marca String de la marca
     * @param $modelo String del modelo
     * @param $n_puertas String del n_puertas
     * @param $color String del color
     * @param $edad String de la fecha en la que se matriculço el coche
     */
    public function updateAllCoche($matricula, $precio, $marca, $modelo, $n_puertas, $color, $edad){
        $this->matricula = $matricula;
        $this->precio = $precio;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->n_puertas = $n_puertas;
        $this->color = $n_puertas;
        $this->edad = $edad;
    }




}



?>
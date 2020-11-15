<?php
include_once("../controllers/functions.php");

/**
 * Clase DataBase
 */
class DataBase {
    //Atrinutos de la clase
    private $enlace;

    //Constructor
    public function __construct() {
        try{
            $this->enlace = new PDO("mysql:host=db;dbname=concesionario", "alumnado", "pestillo");   
            $this->enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    /**
     * Getter del enlace
     */
    public function getEnlace(){
        if(!isset($this->enlace)){
            die("No se ha establecido conexión");
        }
        return $this->enlace;
    }

    /**
     * Ejecuta una a partir de una tabla
     * devuelve un array con la información de esa consulta
     */
    public function consulta($tabla){
        $sql = "SELECT * FROM " . $tabla;
        $rs = $this->enlace->query($sql);
        return $rs;
    }

    /**
     * @param $datos_formulario array comprueba si el usuario o correo ya existen
     * @return bool false si existen true si no
     */
    public function checkRegistro($datos_formulario){
        foreach($this->consulta("usuarios") as $fila){
            if($fila['username'] == $datos_formulario[0] || $fila['email'] == $datos_formulario[1]){
                return false;
            }else{
                continue;
            }
        }
        return true;
    }


    /**
     * @param $datos_formulario array comprueba si existe el usuario o correo y si su contraseña conincide con la registrada
     * en la base de datos
     * @return bool si existe devuelve true si no false
     */
    public function checkLoging($datos_formulario){
        foreach($this->consulta("usuarios") as $fila){
            if(($fila[1] == $datos_formulario[0] || $fila[2] == $datos_formulario[0]) && $fila[3] == $datos_formulario[1]) {
                return true;
            }
        }
        return false;
    }



    /**
     * Registra un nuevo usuario en la base de datos
     */
    public function registro($datos_formulario){
        try{
            $sql = $this->enlace->prepare("INSERT INTO usuarios (username, email, contrasena) VALUES (:username, :email, :contrasena)");
            
            $sql->bindParam(':username',$datos_formulario[0]);
            $sql->bindParam(':email',$datos_formulario[1]);
            $sql->bindParam(':contrasena', $datos_formulario[2]);
            $sql->execute(); 

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    /**
     * Ingresa un coche en la base de datos
     */
    public function ingresaCoche($datos_formulario){
        try{
            $sql = $this->enlace->prepare("INSERT INTO coches (matricula, precio, marca, modelo, n_puertas, color, edad) VALUES (:matricula, :precio, :marca, :modelo, :n_puertas, :color, :edad)");
        
            $sql->bindParam(':matricula', $datos_formulario[0]);
            $sql->bindParam(':precio', $datos_formulario[1]);
            $sql->bindParam(':marca', $datos_formulario[2]);
            $sql->bindParam(':modelo', $datos_formulario[3]);
            $sql->bindParam(':n_puertas', $datos_formulario[4]);
            $sql->bindParam(':color', $datos_formulario[5]);
            $sql->bindParam(':edad', $datos_formulario[6]);

            $sql->execute();

        }catch(PDOException $e){
            header("Location: ../controllers/add_up.php?matriculaInvalida=" . $datos_formulario[0] . "");
            die($e->getMessage());

        }

    }

    /**
     * Actualiza el registro de un coche en la base de datos
     */
    public function actualizaCoche($datos_formulario, $antiguaMatricula){

        try{ 
            $sql = $this->enlace->prepare("UPDATE coches SET matricula = :matricula, precio = :precio, marca= :marca, modelo = :modelo, n_puertas = :n_puertas, color = :color, edad = :edad WHERE matricula = :antiguaMatricula");
            $sql->bindParam(':matricula', $datos_formulario[0]);
            $sql->bindParam(':precio', $datos_formulario[1]);
            $sql->bindParam(':marca', $datos_formulario[2]);
            $sql->bindParam(':modelo', $datos_formulario[3]);
            $sql->bindParam(':n_puertas', $datos_formulario[4]);
            $sql->bindParam(':color', $datos_formulario[5]);
            $sql->bindParam(':edad', $datos_formulario[6]);
            $sql->bindParam(':antiguaMatricula', $antiguaMatricula);
            
            $sql->execute();
        }catch(PDOException $e){
            header("Location: ../controllers/crud.php?matriculaInvalida=" . $datos_formulario[0] . "");
            die($e->getMessage());
    
        }

    }

    /**
     * @param $indice
     * @return mixed array devuelve una matricula a partir de un índice
     */
    public function dameUnaMatricula($indice){
        $csec = 0;
        foreach($this->consulta("coches") as $fila){
            $csec++;
            if($csec == $indice){
                return $fila;
            }
        }
    }



    /**
     * Elimina el registro de un coche en la base de datos
     */
    public function elimina($indice){
        try{
            $matricula = $this->dameUnaMatricula($indice); //obtiene a partir del contador justo el registro con el coche que se deseea eliminar
            $sql = $this->enlace->prepare("DELETE  FROM coches WHERE coches.matricula = :matricula");
            $sql->bindParam(':matricula', $matricula[0]);
            $sql->execute(); //Preguntar si lo puedo hacer asi
            header("Location: ../views/crud.php");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
?>
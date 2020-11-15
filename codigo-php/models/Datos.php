<?php
require("Coche.php");

class Datos{
    private $datos = array();
    private $indice;

    
    /**
     * Constructor de la clase datos si 
     */
    public function __construct($consulta){
        $this->indice = 0;
        if($consulta == ""){
            $this->datos = array();
        }else{
            //No se puede usar como array hay que hacer la locura;
            foreach($consulta as $fila){
                $this->datos[$this->indice] = new Coche($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                $this->indice++;
            }
        }
    }


    /**
     * Imprime los datos de la aplicación y actualiza el indice
     */
    public function imprimeDatos(){
        $this->indice = 0;
        echo"
                <table>
                    <tr>
                        <th>Matrícula</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Puertas</th>
                        <th>Color</th>
                        <th>Edad</th>
                    </tr>";
        foreach($this->datos as $coche){
            $this->indice ++;
            echo"<tr>";
            echo"<td>".$coche->getMatricula()."</td>".
                "<td>".$coche->getPrecio()."</td>".
                "<td>".$coche->getMarca()."</td>".
                "<td>".$coche->getModelo()."</td>".
                "<td>".$coche->getNPuertas()."</td>".
                "<td>".$coche->getColor()."</td>".
                "<td>".$coche->getEdad()."</td>";
            echo"
                <td><a href='../controllers/delete.php?contador=" . $this->indice . "' alt='eliminar' title='pulsa para eliminar'><span class='fas fa-trash-alt ' alt='eliminar' style='color: black; '></sapn></a>
                </td>
                <td>
                <a href='../views/crud.php?edita=yes&contador=" . $this->indice . "'><span class='fas fa-edit' alt='eliminar' id='icon' style='color:black;'></sapn></a>
                </td>
                ";

            echo"</tr>";
        }
        echo"</table>";
    }

}



?>
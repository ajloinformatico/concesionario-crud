<?php
/**
 * Establece la conexión con la base de datos 
 * 
 */
function con(){
    try {
        $enlace = new PDO("mysql:host=db;dbname=concesionario", "alumnado", "pestillo");
        // Selecciona modo de excepción
        $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $enlace;
    } catch(PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

/**
 * recibe conexion y devuelve 
 * el resultado de una consulta en un query
 */
function consulta($enlace, $tabla){
    $sql = "SELECT * FROM ". $tabla;
        //Guardo en $rs el resultado de hacer una consulta sobre
    $rs = $enlace->query($sql);
    return $rs;
    die();
}

/* *
 * recibe una consulta y con un for each imprime el resultado
 */
function imprime_usuarios($consulta){
    //$consulta la variable que se recorre
    //$fila es la variable que recorre a $consulta
    foreach($consulta as $fila){
        echo"hola";
        echo"<p>Id:".$fila[0]." Nombre:". $fila[1] . " Mail:". $fila[2]. " Contraseña:" . $fila[3]. "</p>";
    }

}

/**
 * Muestra información de los coches por pantalla
 */
function imprimeCoches($rs){
    $cotador = 0;
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

    //print_r($fila);
    foreach($rs as $fila){
        $contador++;
        echo"<tr>";
        $bol = 0;
        foreach($fila as $s){
            $bol += 1;
            if($bol%2 == 0){ //Para imprimir uno si otro no ya que si no salen dobles
                echo"<td>". $s ."</td>";
            }else{
                continue;
            }
        }
        echo"
        <td><a href='anadir_eliminar.php?contador=" . $contador . "&eliminar=si' alt='eliminar' title='pulsa para eliminar'><img class='modal_img' src='img/delete.png' alt='eliminar'/></a>
        </td>
        <td>
        <!--<a href='#editar'  data-toggle='modal' data-target='#modal_edita'> <img alt='editar' title='edita el registro' class='modal_img' src='img/ed.png'></img></a>-->
        <a href='grud.php?edita=yes'><img alt='editar'  data-target='#modal_edita' class='modal_img' src='img/ed.png'/></a>
        </td>
        ";
        
        echo"</tr>";
    }
    echo"</table>";
}





/*Comprueba si los datos del formulario son correctos*/
function check_loging($consulta,  $datos_formulario){
    foreach($consulta as $fila){
        if(($fila[1] == $datos_formulario[0] || $fila[2] == $datos_formulario[0]) && $fila[3] == $datos_formulario[1]){
            return true;
        }
    }
    return false;
}

/**  
 * Comprueba si existe una matricula
*/
function check_matricula($consulta, $matricula){
    foreach($consulta as $fila){
        if($fila['matricula'] == $matricula){
            return true;
        }
    }
    return false;
    
}   



/**
 * Comprueba que no existe ningun usario con el nombre o el correo
 * Si es así devuelve true
*/
function check_registro($consulta, $datos_formulario){
    foreach($consulta as $fila){        
        if($fila['username'] == $datos_formulario[0] || $fila['email'] == $datos_formulario[1]){
           
            
            return false;
        }else{
            continue;
        }
    }
    return true;
}

/**
 * Inserta un nuevo usuario en la base de datos
 */
function registro($enlace, $datos_formulario){
    try{
        $sql = $enlace->prepare("INSERT INTO usuarios (username, email, contrasena) VALUES (:username, :email, :contrasena)");
        
        $sql->bindParam(':username',$datos_formulario[0]); //INDICA EL TIPO
        $sql->bindParam(':email',$datos_formulario[1]);
        $sql->bindParam(':contrasena', $datos_formulario[2]);
        $sql->execute(); //Preguntar si lo puedo hacer asi
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

/**
 * Inserta en coches un nuevo registro
 */
function ingresaCoche($enlace, $datos_formulario){

    try{
        $sql = $enlace->prepare("INSERT INTO coches (matricula, precio, marca, modelo, n_puertas, color, edad) VALUES (:matricula, :precio, :marca, :modelo, :n_puertas, :color, :edad)");
        
        $sql->bindParam(':matricula', $datos_formulario[0]);
        $sql->bindParam(':precio', $datos_formulario[1]);
        $sql->bindParam(':marca', $datos_formulario[2]);
        $sql->bindParam(':modelo', $datos_formulario[3]);
        $sql->bindParam(':n_puertas', $datos_formulario[4]);
        $sql->bindParam(':color', $datos_formulario[5]);
        $sql->bindParam(':edad', $datos_formulario[6]);

        $sql->execute();

        //script para mostrar que se ha enviado correctamete valor con la variable $_MATRICULA
        //recarga la página
        
    }catch(PDOException $e){
        header("Location: grud.php?matriculaInvalida=" . $datos_formulario[0] . "");
        die($e->getMessage());

    }

}


/**
 * Actualiza un registro
 */
function actualiza_coche($enlace, $datos_formulario, $antiguaMatricula){
    try{ 
        $sql = $enlace->prepare("UPDATE coches SET matricula = :matricula, precio = :precio, marca= :marca, modelo = :modelo, n_puertas = :n_puertas, color = :color, edad = :edad WHERE matricula = :antiguaMatricula");
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
        header("Location: grud.php?matriculaInvalida=" . $datos_formulario[0] . "");
        die($e->getMessage());

    }
}



/**
 * A partir de un contador devuelve matricula
 * La he echo función porque me hace falta para
 * eliminar y actualizar
 */
function dame_una_matricula($consulta, $contador){
    $csec = 0;
    foreach($consulta as $fila){
        $csec++;
        if($csec == $contador){
            $matric = $fila['matricula'];
            break;
        }
    }
    return $fila;
}


function elimina($consulta, $contador, $enlace){
    //DELETE FROM `coches` WHERE `coches`.`matricula` = '1111111';
    try{
        
        $matric = dame_una_matricula($consulta, $contador);
        $matric = $matric['matricula'];
        echo"$matric";
        $sql = $enlace->prepare("DELETE  FROM coches WHERE coches.matricula = :matricula");
        $sql->bindParam(':matricula', $matric);
        $sql->execute(); //Preguntar si lo puedo hacer asi
    }catch(PDOException $e){
        ?>
        <!--Script para mostrar valor con la variable $_MATRICULA-->
        <script>
            alert('Datos no válidos');
            alert(<?php  echo $sql . "<br>" . $e->getMessage();?>);
        </script>
        <?php
    }
}


/**
 * Recarga la página
 * La utilizo porque header solo funciona si está arriba del documento
 */
function recarga(){
    ?>
    <script>location.reload();</script>
    <?php
}




?>




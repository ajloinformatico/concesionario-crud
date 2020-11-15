<?php
//Si se desmarca muestra erroes en el navegador
//require_once("functions.php");
//muestraErrores();
require_once("../models/Database.php");
require_once("../models/sesion_functions.php");
//Con require -> además de cargar se fuerza a que funcione

    
//Simplemente comprueba si los datos vienen por post después si recibe en el input oculto loging
// o registrar en función de uno u otro comprueba datos y registra o inicia

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Instancia el objeto Base de Datos aquí pq lo uso en las dos condiciones    
    $bd = new DataBase();
    if($_POST['oculto'] == 'loging'){

        //Creo un array con el usuatio y la contraseña
        $datos_formulario = [$_POST['nombre'], $_POST['contrasena']];
    
        //Compruebo que los usuarios existen
        if($bd->checkLoging($datos_formulario)){
            //Si existe carga la sesión y va al crud
            iniciaSesion($datos_formulario);
            
        }else{
            //Si no muestra una alerta  y carga el index
        ?>
            <script>
                alert("El usuario introducido no existe\nIntentalo de nuevo o date de alta");
                window.location.replace("http://localhost:80/index.php");
            </script>
        <?php
        }
    }else if($_POST['oculto'] == "registrar"){
        $datos_formulario = [$_POST['nombre_r'],$_POST['email_r'],$_POST['contrasena_r']];
    
        if($bd->checkRegistro($datos_formulario)){
            
            $bd->registro($datos_formulario);
            ?>
                <script>
                    alert("Usted ha sido registrado correctamente.\nInicie sesión para continuar")
                    window.location.replace("http://localhost:80/index.php");
                </script>
            <?php
        }else{
            ?>
                <script>
                    alert("El usuario que intenta registrar ya se encuentra en el sistema");
                    window.location.replace("http://localhost:80/views/registro.php");
                </script>
            <?php
        }
    }
}
?>


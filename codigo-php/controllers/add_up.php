<?php
    //require_once("functions.php");
    //muestraErrores();
    require_once("../models/Database.php");

    //Instancio objetos
    $db = new DataBase();

    //Si viene por post comienza a funcionar
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Guardo los datos porque lo voy a usar varias veces
        $datos_formulario = [$_POST['matricula'], $_POST['precio'], $_POST['marca'], $_POST['modelo'], $_POST['puertas'], $_POST['color'], $_POST['edad']];
        //Si recibe un atributo oculto con el valor en yes significa que actualizamos
        if($_POST['oculto'] == 'yes'){
            //Actualiza el coche
            $db->actualizaCoche($datos_formulario ,$_POST['anMatricula']);
            //Vuelve al inicio
            header('Location: ../views/crud.php');
        }else if($_POST['oculto'] != 'yes'){
            //Agrega los datos
            $db->ingresaCoche($datos_formulario);
            //Muestro info y vuelve al crud
            ?>
            <script>
                alert("El vehículo con matrícula <?php echo $_POST['matricula']; ?> ha sido registrado satisfactoriamente");
                window.location.replace("http://localhost:80/views/crud.php");
            </script>
            <?php
        }
    }else{
        //Si recibe por get matriculaInvalida es que algo ando mal al insertar
        if(isset($_GET['matriculaInvalida'])){
            ?>
            <script>
                alert("Error:\nDatos\nPor favor vuelva a intentarlo");
                window.location.replace("http://localhost:80/views/crud.php")
            </script>

            <?php

        }
    }




?>
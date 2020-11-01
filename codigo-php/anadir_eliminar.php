<?php
    //lÓGICA DE AÑADIR ANADIR Y EDITAR
    require_once('functions.php');
    $enlace = con();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['oculto'] == 'yes'){
            $datos_formulario = [$_POST['matricula'], $_POST['precio'], $_POST['marca'], $_POST['modelo'], $_POST['puertas'], $_POST['color'], $_POST['edad']];
            //Inserta coche
            actualiza_coche($enlace, $datos_formulario, $_POST['amatricula']);
            header('Location: grud.php');
        }else{

            $datos_formulario = [$_POST['matricula'], $_POST['precio'], $_POST['marca'], $_POST['modelo'], $_POST['puertas'], $_POST['color'], $_POST['edad']];
                //Inserta coche
            ingresaCoche($enlace, $datos_formulario);
            header('Location: grud.php');
        }
    }
    elseif(isset($_GET['eliminar'])){
        $rs = consulta($enlace, "coches");
        elimina($rs,$_GET['contador'],$enlace);
        header('Location: grud.php');
    }
   
   

?> 



<?php
    //lÓGICA DE AÑADIR ACTUALIZAR Y EDITAR
    require_once('functions.php');
    $enlace = con();

    //Si el método es post seguro que se va ha añadir o editar
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['oculto'] == 'yes'){//Si tiene un campo oculto edita
            $datos_formulario = [$_POST['matricula'], $_POST['precio'], $_POST['marca'], $_POST['modelo'], $_POST['puertas'], $_POST['color'], $_POST['edad']];
            //Inserta coche
            actualiza_coche($enlace, $datos_formulario, $_POST['amatricula']);
            header('Location: grud.php');
        }else{
            //Si no hace una insercción normal
            $datos_formulario = [$_POST['matricula'], $_POST['precio'], $_POST['marca'], $_POST['modelo'], $_POST['puertas'], $_POST['color'], $_POST['edad']];
            //Inserta coche
            ingresaCoche($enlace, $datos_formulario);
            header('Location: grud.php');
        }
    }


    /*Si se pulsa eliminar viene aquí*/
    elseif(isset($_GET['eliminar'])){
        
        //Realiza una consulta y elimina para después recargar
        $rs = consulta($enlace, "coches");
        elimina($rs,$_GET['contador'],$enlace);
        header('Location: grud.php');
    }
   
   

?> 



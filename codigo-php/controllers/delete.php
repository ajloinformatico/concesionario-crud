<?php
    //require_once("functions.php");
    //muestraErrores();
    require_once("../models/Database.php");
    require_once("../models/Datos.php");

    //Recibe los datos por GET pregunta si se desea eliminar con un confirm y si es así recarga este archivo
    //con un atributo nuevo elimina por get instancia la base de datos y entonces ya sí elimina


    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['elimina'])){
            $bd = new DataBase();
            $bd->elimina($_GET['contador']);
        }else{
            ?>
                <script>
                    if(window.confirm("¿Estás seguro de que deseas\neliminar el registro seleccionado?")){
                        window.location.replace("http://localhost:80/controllers/delete.php?elimina='si'&contador=<?php echo $_GET['contador']; ?>");
                    }else{
                        alert("El registro no se eliminará");
                        window.location.replace("http://localhost:80/views/crud.php");
                    }
                </script>
            <?php
        }
    }else{
        header('Location: ../views/crud.php');
    }


?>
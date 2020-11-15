<?php
    require_once("../models/sesion_functions.php");
    require_once("../controllers/functions.php");
    require_once("../models/Database.php");
    require_once("../models/Datos.php");

    //Control de la sesión
    controlSesion(1800);
    $bd = new DataBase();
    $datos = new Datos($bd->consulta("coches"));



    
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Concesionario Area personal</title>
        <meta name="description" content="Poniendo en práctica php"/>
        <meta name="keywords" content="php, form, require_once" />
        <meta name="author" content="Antonio José Lojo Ojeda" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css" type="text/css"/>
        <!--My Scripts-->
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <header>
            <h1>Concesionario Crud</h1>
        </header>
        <section class='info_loging'>
            <!--Este -->
            <?php
                //Muestra la información en el loging
                info_sesion();
            ?>
            <div>
                <a href="../index.php" title="Click to log out"><img alt="Log out"  src="../img/logout.png"/></a>
            </div>
        </section>
        <main>
            <h2>Area personal</h2>
            <section class="show_edit_delete">
                <p>hola</p>
                <!--Imprime la tabla con los coches y los botones-->
                <?php
                    //imprimeCoches()
                    $datos->imprimeDatos();
                ?>
                
                
                
                <br>
                <input type='checkbox' id='btn-modal'/>
                <label for='btn-modal' class='lbl-modal'><span class='far fa-plus-square fa-2x' style='color:black; cursor: pointer;' title='Agrege un nuevo coche'></span></label>

                <!--Abre el modal y carga la información del registro seleccionado-->
                <?php
                    if(isset($_GET['edita'])){
                        //Carga en un array los datos para a través del value cargarlos en el form
                        $consulta = $bd->dameUnaMatricula($bd->consulta("coches"));

                        ?>
                            <script> //Pequeño script para mostrar el modal
                                document.getElementById('btn-modal').click();
                            </script>
                        <?php
                    }else{
                        $consulta = ["","","","","","",""];//Esto lo hago para que al cargar no se imprima el error;
                    }
                ?>




                <div class='modal'>
                    <div class='contenedor'>
                        <header>
                            <h3>Añade un nuevo registro</h3>
                        <!--El label con la x se usa a modo de botón le he puesto el mismo nombre que el inoput para que cuando
                            se pulse este se cambie el valor del check box
                        -->
                        <!--<a class='enlace-ir-atras' href="grud.php">X</a>-->
                            <label  for='btn-modal'><a class='btn-salir-modal' href="crud.php">X</a></label><!--Mismo nombre del input PARA EL BOTÓN DE CERRAR-->
                        </header>
                        
                        <div class="contenido">
                            <form class='formulario' action='../controllers/add_up.php' method='POST' enctype="multipart/form-data" autocomplete="on">
                                <!--Campos ocultos para el update es el que llega por post-->
                                <input type="hidden" id="oculto" name="oculto" value="<?php echo $_GET['edita'];?>">
                                <!--Carga la antigua matricula sin modificar para hacer el update-->

                                <input type="hidden" id="anMatricula" name="anMatricula" value="<?php echo $consulta[0];?>">
                                <!--Campos normales-->
                                <label for="matricula">Matrícula: </label>
                                <input type="text" id="matricula" name="matricula"  pattern="^[0-9]{1,4}(?!.*(LL|CH))[BCDFGHJKLMNPRSTVWXYZ]{3}" value="<?php echo $consulta[0];?>" minlength="7" maxlength="7" title="Introduzca una matrícula válida" placeholder="Introduzca una matrícula" required/>
                                <br>
                                <label for="precio">Precio: </label>
                                <input type="number" step="any" id="precio" name="precio"  title="Introduzca un precio"  value="<?php echo $consulta[1];?>" placeholder="Introduzca un precio" maxlength="7" required/>
                                <br>
                                <label for="marca">Marca: </label>
                                <input type="text" id="marca" name="marca"   title="Introduce la marca" minlength="2" maxlegnth="15" value="<?php echo $consulta[2];?>" placeholder="Introduce la marca" required/>
                                <br>
                                <label for="modelo">Modelo: </label>
                                <input type="text" id="modelo" name="modelo"   title="Introduce un modelo" maxlength="15" value="<?php echo $consulta[3];?>" placeholder="Introduce un modelo" required/>
                                <br>
                                <label for="puertas">Número de puertas: </label>
                                <select name="puertas" id="puertas" title="seleccione una opción" value="<?php echo $consulta[4];?>" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option selected>4</option>
                                    <option>6</option>
                                </select>
                                <br><br>
                                <label for="color">Color: </label>
                                <input type="text" id="color" name="color"  maxlength="10" value="<?php echo $consulta[5];?>"  title="Introduzca un color" placeholder="Introduzca un color" required>
                                <br>
                                <label for="edad">Edad: </label>
                                <input type="date" id="edad" name="edad" title="Introduzca la decha de la primera matriculación" value="<?php echo $consulta[6];?>" placeholder="Señale el tiempo que tiene el coche" required/>
                                <br>
                                <button type="submit" value="enviar" title="Ingresar reguistro">Ingresar</button>
                                
                                <!--<input type="text" id="username" name="username" maxlength="10"><br><br>-->

                            </form>
                           

                        </div>

                    </div>
                </div>
            </section>

        </main>
        <footer>
        <p>page coded by <a href="https://github.com/ajloinformatico" target="_blank" title="Github page">ajloinformatico.</a>
            I´m open source.
            Copyright © 2020 INFOLOJO</p>
        </footer>
        <!--FONT AWESOME-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>
        
    </body>
</html>


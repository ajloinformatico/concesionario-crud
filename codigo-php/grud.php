<!DOCTYPE HTML>
<?php





    require('functions.php');

    session_start();

    //Establece un tiempo de sesión cambiar a 10 segundos para comprobar si funciona
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        /*
          Se espresa en segundos 1800 = 30
          Comprueba si ha pasado más de 30 minutos desde la última sesióno
          En caso de ser así, caduca la sesión y recarga la página para que tenga
          que volver a iniciar sesión.
        */
        session_unset(); // limpia $_SESSION
        session_destroy();   // elimina toda la información guardada de la sesión.
        header("Refresh: 0; url=grud.php"); // recarga la página.
        //header("Location: grud.php");
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // actualiza la última actividad
?>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>MyAPP Area personal</title>
        <meta name="description" content="Poniendo en práctica php"/>
        <meta name="keywords" content="php, form, require_once" />
        <meta name="author" content="Antonio José Lojo Ojeda" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style_grud.css" type="text/css"/>
        <!--My Scripts-->
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <header>
            <h1>My App</h1>
        </header>
        <section class='info_loging'>
            <?php
                

                //Comprueba que la sesión existe
                if(isset($_SESSION['name'])){
                    echo"<h2>";
                    print_r("Bienvenido " . $_SESSION['name'][0]);
                    echo"</h2>";
                }else{
                    echo"<section class='no_sesion'>";
                    echo"<p>No hay sesión</p>";
                    echo"<a href='index.php'><button>INICIAR SESIÓN</button></a>";
                    echo"</section>";
                    die();
                }

                //Comprueba si el coche se ha registrado o no satisfactoriamente
                if(isset($_GET['matriculaInvalida'])){
                    ?> 
                        <script>
                            error();
                        </script>
                    <?php
                
                //Confirma si se desea eliminar un elemento
                }


            ?>
            <div>
                <a href="index.php" title="Click to log out"><img alt="Log out"  src="img/logout.png"/></a>
            </div>
        </section>
        <main>
            <h2>Area personal</h2>
            <section class="show_edit_delete">
                <!--Imprime la tabla con los coches y los botones-->
                <?php
                    $enlace = con();
                    $rs = consulta($enlace, "coches");

                    //Muestra coches y botones
                    imprimeCoches($rs);                    
                ?>
                
                
                
                <br>
                <input type='checkbox' id='btn-modal'/>
                <label for='btn-modal' class='lbl-modal'><span class='far fa-plus-square fa-2x' style='color:black; cursor: pointer;' title='Agrege un nuevo coche'></span></label>
                <?php
                    //Si recibe 
                    if(isset($_GET['edita'])){
                        $rs = consulta($enlace, "coches");
                        $consulta = dame_una_matricula($rs, $_GET['contador']);
                        //Muestra el mofal
                        ?>
                            <script>
                            muestraModal();
                            </script>
                        <?php


                    //Si se pulsa el ELIMINAR
                    }elseif(isset($_GET['eliminar'])){
                        $rs =consulta($enlace, "coches");
                        $consulta = dame_una_matricula($rs, $_GET['contador']);
                        //En un confirm() de js pregunta si eliminar si se confirma envia a anadir_eliminar para eliminar si no recarga la página
                        
                        ?>
                            <script>
                                //Para asignarle un valor php a js importante las comillas arriba
                                eliminaCoche('<?php echo $consulta['matricula'];?>', '<?php echo $_GET['contador'];?>');
                              
                            </script>
                        <?php
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
                            <label  for='btn-modal'><a class='btn-salir-modal' href="grud.php">X</a></label><!--Mismo nombre del input PARA EL BOTÓN DE CERRAR-->
                        </header>
                        
                        <div class="contenido">
                            <form class='formulario' action='anadir_eliminar.php' method='POST' enctype="multipart/form-data" autocomplete="on">
                                <!--Campos ocultos para el update es el que llega por post-->
                                <input type="hidden" id="oculto" name="oculto" value="<?php echo$_GET['edita'];?>">
                                <input type="hidden" id="amatricula" name="amatricula" value="<?php echo$consulta['matricula'];?>">
                                
                                <!--Campos normales-->
                                <label for="matricula">Matrícula: </label>
                                <input type="text" id="matricula" name="matricula" value="<?php echo $consulta['matricula'];?>" minlength="7" maxlength="7" title="Introduzca una matrícula" placeholder="Introduzca una matrícula" required/>
                                <br>
                                <label for="precio">Precio: </label>
                                <input type="number" step="any" id="precio" name="precio" value="<?php echo$consulta['precio'];?>" title="Introduzca un precio" placeholder="Introduzca un precio" required/>
                                <br>
                                <label for="marca">Marca: </label>
                                <input type="text" id="marca" name="marca" value="<?php echo$consulta['marca'];?>" maxlegnth="15" title="Introduce la marca" placeholder="Introduce la marca" required/>
                                <br>
                                <label for="modelo">Modelo: </label>
                                <input type="text" id="modelo" name="modelo" value="<?php echo$consulta['modelo'];?>" maxlength="15" title="Introduce un modelo" placeholder="Introduce un modelo" required/>
                                <br>
                                <label for="puertas">Número de puertas: </label>
                                <select name="puertas" id="puertas" title="seleccione una opción" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option selected>4</option>
                                    <option>6</option>
                                </select>
                                <br><br>
                                <label for="color">Color: </label>
                                <input id="color" name="color" value="<?php echo$consulta['color'];?>"maxlength="10" title="Introduzca un color" placeholder="Introduzca un color" required>
                                <br>
                                <label for="edad">Edad: </label>
                                <input type="date" id="edad" name="edad" value="<?php echo$consulta['edad'];?>"title="Introduzca la decha de la primera matriculación" placeholder="Señale el tiempo que tiene el coche" required/>                            
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


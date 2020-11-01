<!doctype html>
<?php
    require_once('functions.php');
    //cierra sesión
    session_start();
    if(isset($_SESSION['name'])){
        session_destroy();
    }
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>MyAPP Loging</title>
        <meta name="description" content="loging"/>
        <meta name="keywords" content="php, form, require_once" />
        <meta name="author" content="Antonio José Lojo Ojeda" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style_grud.css" type="text/css">
    </head>
    <body>
        <header>
            <h1>My App</h1>
        </header>

        <main>

            <h2>Inicie sesión</h2>

            <form class="formulario" action="." method="POST" enctype="multipart/form-data" autocomplete="on">
                <label for="nombre">Nombre o Correo: </label>
                <input type="text" id="nombre" name="nombre" title="Introduzca un nombre" placeholder="Introduzca su nombre" required/>
                <br>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena" title="Introduzca su contraseña" placeholder="Introduzca su contraseña" required />
                <br>
                <button type="submit" value="enviar" title="Entrar">Iniciar sesión</button>
            </form>

            <center>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Establece enlace
                $enlace = con();
                //guardo la consulta
                $rs = consulta($enlace, "usuarios");
                //Imprime la consulta
                //imprime_usuarios($rs);
                $datos_formulario = [$_POST['nombre'], $_POST['contrasena']];
                
                if(check_loging($rs, $datos_formulario) == TRUE){
                    //todo meter en una función
                    session_cache_limiter('private');
                    $cache_limiter = session_cache_limiter();

                    /* establecer la caducidad de la caché a 30 minutos */
                    session_cache_expire(1); //MINUTOS QUE SE LIMITA LA SESION
                    $cache_expire = session_cache_expire();
                    
                    
                    session_start();
                    $_SESSION['name'] = $datos_formulario;
                    header('Location: grud.php');
                    die();
                }else{
                    echo"<p class='rojo'>Datos no válidos<br>
                    Vuelve a intentarlo o date de alta!!
                    ";
                }
            }
            ?>
            <h3>Para acceder a la página de reguistro pulsa aquí</h3>
            <a href='registro.php'><button title='regístrame'>registrarme</button></a>
        </main>
        <footer>
        <p>page coded by <a href="https://github.com/ajloinformatico" target="_blank" title="Github page">ajloinformatico.</a>
            I´m open source.
            Copyright © 2020 INFOLOJO</p>
    </footer>
    </body>
</html>



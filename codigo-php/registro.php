<!doctype html>
<?php
    require_once('functions.php');
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>MyAPP Reistro</title>
        <meta name="description" content="Registro"/>
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

            <h2>Registrarse</h2>

            <form  action="registro.php" method="POST" enctype="multipart/form-data" autocomplete="on">
                <label for="nombre_r">Nombre: </label>
                <input type="text" id="nombre_r" name="nombre_r" title="Introduzca un nombre" placeholder="Introduzca su nombre" required/>
                <br>
                <label for="email_r">Correo: </label>
                <input type="email" id="email_r" name="email_r" title="Introduzca su correo" placeholder="Introduzca su correo" required/>
                <br>
                <label for="contrasena_r">Contraseña: </label>
                <input type="password" id="contrasena_r" name="contrasena_r" title="Introduzca su contraseña" placeholder="Introduzca su contraseña" required />
                <br>
              
                <button type="submit" value="enviar" title="Entrar">Entrar</button>
            </form>
            <center>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Establece enlace
                $enlace = con();
                //guardo la consulta
                $rs = consulta($enlace, "usuarios");
                //Imprime la consulta
                //imprime_usuarios($rs);
                $datos_formulario = [$_POST['nombre_r'],$_POST['email_r'],$_POST['contrasena_r']];
                
                if(check_registro($rs, $datos_formulario)){
                    echo"<p class='verde'>Bienvenido " . $datos_formulario[0] . "</p>";
                    registro($enlace, $datos_formulario);
                    echo"<p class='verde'>Ha sido usted registrado</p>
                        <h3>Para inciar sesión pulse aquí</h3>
                        <a href='index.php'><button >Iniciar sesión</button></a>   
                    ";
                }else{
                    echo"<p class='rojo'>Los datos ya existen o no son válidos</p>";
                }
            }else{

            }
            ?>
        </main>
        <footer>
        <p>page coded by <a href="https://github.com/ajloinformatico" target="_blank" title="Github page">ajloinformatico.</a>
            I´m open source.
            Copyright © 2020 INFOLOJO</p>
        </footer>
    </body>
</html>
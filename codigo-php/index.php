<?php
require_once("models/sesion_functions.php");
//muestraErrores();
//Cierra la sesión siempre que se carge esta pagina
cierraSesion()
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Concesionario Loging</title>
        <meta name="description" content="loging"/>
        <meta name="keywords" content="php, form, require_once" />
        <meta name="author" content="Antonio José Lojo Ojeda" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styLe.css" type="text/css">
    </head>
    <body>
        <header>
            <h1>Concesionario Loging</h1>
        </header>

        <main style="text-align: center;">

            <h2>Inicie sesión</h2>

            <form class="formulario" action="controllers/loging_registro.php" method="POST" enctype="multipart/form-data" autocomplete="on">
                <input type="hidden" name="oculto" value="loging" />
                <label for="nombre">Nombre o Correo: </label>
                <input type="text" id="nombre" name="nombre" title="Introduzca un nombre"  placeholder="Introduzca su nombre" required/>
                <br>
                <label for="contrasena">Contraseña: </label>
                <input type="password" id="contrasena" name="contrasena" title="Introduzca su contraseña" placeholder="Introduzca su contraseña" required />
                <br>
                <button type="submit" value="enviar" title="Entrar">Iniciar sesión</button>
            </form>           
            <h3>Para acceder a la página de reguistro pulsa aquí</h3>
            <a href='views/registro.php'><button title='regístrame'>registrarme</button></a>

        </main>
        <footer>
        <p>page coded by <a href="https://github.com/ajloinformatico" target="_blank" title="Github page">ajloinformatico.</a>
            I´m open source.
            Copyright © 2020 INFOLOJO</p>
        </footer>
    </body>
</html>



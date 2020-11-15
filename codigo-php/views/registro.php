<?php
    //require_once("../controllers/functions.php");
    //muestraErrores();
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Concesionario Sign in</title>
        <meta name="description" content="Registro"/>
        <meta name="keywords" content="php, form, require_once" />
        <meta name="author" content="Antonio José Lojo Ojeda" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css" type="text/css">
    </head>
    <body>
        <header>
            <h1>Concesionario Sign in</h1>
        </header>

        <main>

            <h2>Concesionario Registro</h2>

            <form  action="../controllers/loging_registro.php" method="POST" enctype="multipart/form-data" autocomplete="on">
                <input type="hidden" name="oculto" value="registrar"/>
                <label for="nombre_r">Nombre: </label>
                <input type="text" id="nombre_r" name="nombre_r" title="Introduzca un nombre" placeholder="Introduzca su nombre" required/>
                <br>
                <label for="email_r">Correo: </label>
                <input type="email" id="email_r" name="email_r" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Introduzca su correo" placeholder="Introduzca su correo" required/>
                <br>
                <label for="contrasena_r">Contraseña: </label>
                <input type="password" id="contrasena_r" name="contrasena_r" title="Introduzca su contraseña" placeholder="Introduzca su contraseña" required />
                <br>
              
                <button type="submit" value="enviar" title="Entrar">Entrar</button>
            </form>
        </main>
        <footer>
        <p>page coded by <a href="https://github.com/ajloinformatico" target="_blank" title="Github page">ajloinformatico.</a>
            I´m open source.
            Copyright © 2020 INFOLOJO</p>
        </footer>
    </body>
</html>
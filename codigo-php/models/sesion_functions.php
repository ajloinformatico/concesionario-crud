<?php

/**
 * Inicia sesión
 */
function iniciaSesion($datos_formulario){
    session_start();
    $_SESSION['name'] = $datos_formulario;
    header('Location: ../views/crud.php'); 
    die();
}


/**
 * Cierra la sesión
 */
function cierraSesion(){
    session_start();
    if(isset($_SESSION['name'])){
        session_destroy();
    }
}

/**
 * Controla la sesión
 */
function controlSesion($time){
    session_start();
    //Establece un tiempo de sesión cambiar a 10 segundos para comprobar si funciona
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time)) {
        /*
          Se espresa en segundos 1800 = 30
          Comprueba si ha pasado más de 30 minutos desde la última sesióno
          En caso de ser así, caduca la sesión y recarga la página para que tenga
          que volver a iniciar sesión.
        */
        session_unset(); // limpia $_SESSION
        session_destroy();   // elimina toda la información guardada de la sesión.
        header("Refresh: 0; url=../views/crud.php"); // recarga la página.
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // actualiza la última actividad
}

/**
 * Muestra la información de la sesión en el crud
 */
function info_sesion(){
    if(isset($_SESSION['name'])){
        echo"<h2>";
        print_r("Bienvenido " . $_SESSION['name'][0]);
        echo"</h2>";
    }else{
        echo"<section class='no_sesion'>";
        echo"<p>No hay sesión</p>";
        echo"<a href='../index.php'><button>INICIAR SESIÓN</button></a>";
        echo"</section>";
        //Al final muere para no cargar nada más
        die();
    }

}





?>
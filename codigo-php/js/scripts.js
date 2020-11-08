/**
 * Muestra el modal haceindo click en su label al pulsar el icono
 */
function muestraModal(){
    document.getElementById('btn-modal').click();
}

/**
 * Muestra dialogo de confirm si se acepta carga anadir_eliminar.php para con el contador y yes como valor de eliminar
 * Si no se recarga la pagina
 * @param {string} matricula 
 * @param {string} contador 
 */
function eliminaCoche(matricula, contador){
    if(window.confirm("Estas seguro de que quieres eliminar\nel coche con matrícula: " + matricula)){
        window.location.replace("http://localhost:80/anadir_eliminar.php?contador="+ contador + "&eliminar=yes");
    }else{
        alert("El registro no será eliminado");
        window.location.replace("http://localhost:80/grud.php")
    }
}


function error(){
    alert("Error:\nDatos no válidos por favor vuelva a intentarlo");
}
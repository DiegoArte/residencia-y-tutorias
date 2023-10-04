function mostrarArchivoSeleccionado(input) {
    const button = input.parentElement;
    if (input.files.length > 0) {
        button.classList.add("archivo-seleccionado");
    } else {
        button.classList.remove("archivo-seleccionado");
    }
}

function confirmarReemplazo() {
    var respuesta = confirm("¿Desea reemplazar los datos existentes en la base de datos?");
    if (respuesta === true) {
        // Si el usuario confirma, establece el valor de un campo oculto para indicar el reemplazo
        document.getElementById("reemplazar").value = "si";
        // Envía el formulario
        document.getElementById("form_excel").submit();
    }
}

function mostrarBotonEliminar(id) {
    var fila = document.getElementById("fila-" + id);
    var botonEliminar = fila.querySelector("button.eliminar");
    if (botonEliminar) {
        botonEliminar.style.display = "block";
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var filaIdEliminar; // Variable global para almacenar el ID de la fila que se va a eliminar

function eliminarFila(id) {
    filaIdEliminar = id;
    // Muestra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "block";
}

function confirmarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
    
    // Redirige para eliminar la fila
    window.location.href = "eliminar_fila.php?id=" + filaIdEliminar;
}

function cancelarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
}

function mostrarErrorModal(mensaje) {
    document.getElementById('errorMensaje').textContent = mensaje;
    document.getElementById('errorModal').style.display = 'block';
}

function cerrarErrorModal() {
    document.getElementById('errorModal').style.display = 'none';
}
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

var filaIdEliminarDOC; // Variable global para almacenar el ID de la fila que se va a eliminar

function eliminarFilaDOC(id) {
    filaIdEliminarDOC = id;
    // Muestra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "block";
}

function confirmarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
    
    // Redirige para eliminar la fila
    window.location.href = "php/eliminar_filaDOC.php?id=" + filaIdEliminarDOC;
}

function cancelarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function mostrarErrorModal(mensaje) {
    document.getElementById('errorMensaje').textContent = mensaje;
    document.getElementById('errorModal').style.display = 'block';
}

function cerrarErrorModal() {
    document.getElementById('errorModal').style.display = 'none';
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------




// Función para obtener los elementos seleccionados
function obtenerSeleccionados() {
    const elementosSeleccionados = [];

    // Obtener casillas de verificación para Asesor
    const asesorCheckboxes = document.querySelectorAll('input[type="checkbox"][name="asesor[]"]');
    asesorCheckboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            elementosSeleccionados.push({ tipo: 'Asesor', id: checkbox.value });
        }
    });

    // Obtener botones de radio para Presidente
    const presidenteRadios = document.querySelectorAll('input[type="radio"][name="presidente"]');
    presidenteRadios.forEach((radio) => {
        if (radio.checked) {
            elementosSeleccionados.push({ tipo: 'Presidente', id: radio.value });
        }
    });

    // Obtener botones de radio para Secretaria
    const secretariaRadios = document.querySelectorAll('input[type="radio"][name="secretaria"]');
    secretariaRadios.forEach((radio) => {
        if (radio.checked) {
            elementosSeleccionados.push({ tipo: 'Secretaria', id: radio.value });
        }
    });

    // Configurar el valor del campo oculto "seleccionados"
    document.getElementById('seleccionados').value = JSON.stringify(elementosSeleccionados);

    // Enviar los datos al servidor mediante una solicitud AJAX
    $.ajax({
        url: 'RegistrarDOC.php',
        method: 'POST',
        data: { seleccionados: elementosSeleccionados },
        success: function(response) {
            alert('Elementos seleccionados guardados correctamente.');
        },
        error: function(error) {
            alert('Error al guardar elementos seleccionados.');
        }
    });
}


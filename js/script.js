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

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function abrirFormularioEdicion(id, Academia, NumerodeControl, NombredelDocente) {
    // Muestra el formulario modal
    var modal = document.getElementById('editar-modal');
    modal.style.display = 'block';

    // Llena los campos del formulario con los datos de la fila correspondiente
    document.getElementById('editar-id').value = id;
    document.getElementById('Academia').value = Academia;
    document.getElementById('NumerodeControl').value = NumerodeControl;
    document.getElementById('NombredelDocente').value = NombredelDocente;
}


function cerrarFormularioEdicion() {
    // Oculta el modal
    var modal = document.getElementById("editar-modal");
    modal.style.display = "none";
}

function validarFormulario() {
    // Obtén los valores de los campos
    var numeroControl = document.getElementById("NumerodeControl").value;
    var nombreAcademia = document.getElementById("Academia").value;
    var nombreDocente = document.getElementById("NombredelDocente").value;

    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresion = /^[a-zA-Z0-9\s]+$/;

    if (numeroControl === "" || nombreAcademia === "" || nombreDocente === "") {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A' 
        });
        return false;
    } else if (!expresion.test(numeroControl) || !expresion.test(nombreAcademia) || !expresion.test(nombreDocente)) {
        Swal.fire({
            title: 'Campo(s) inválido(s)',
            text: "Los campos no deben contener caracteres especiales",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
          })
        return false;
    }

    // Si todo está bien, el formulario se envía
    return true;
}   



//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function abrirFormularioRegistro() {
    // Muestra el formulario modal de registro
    var modal = document.getElementById('registro-modal');
    modal.style.display = 'block';
}

function cerrarFormularioRegistro() {
    // Oculta el formulario modal de registro
    var modal = document.getElementById('registro-modal');
    modal.style.display = 'none';
}

function validarFormularioRegistro() {
    // Obtén los valores de los campos
    var NuevoNumeroControl = document.getElementById("NuevoNumeroControl").value;
    var NuevoNombreCarrera = document.getElementById("NuevoNombreCarrera").value;
    var NuevoNombreDocente = document.getElementById("NuevoNombreDocente").value;


    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresión = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚ,.-]+$/;

    if (NuevoNumeroControl === "" ||NuevoNombreCarrera === ""  || NuevoNombreDocente === "") {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A'
        });
        return false;
    } else if (!expresión.test(NuevoNumeroControl) || !expresión.test(NuevoNombreCarrera) || !expresión.test(NuevoNombreDocente)) {
        Swal.fire({
            title: 'Campo(s) inválido(s)',
            text: "Los campos no deben contener caracteres especiales",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
        });
        return false;
    }

    // Si todo está bien, el formulario se envía
    return true;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function search() {
    var searchTerm = document.getElementById('searchInput').value.toUpperCase();
    var table = document.querySelector('table');
    var rows = table.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var shouldDisplay = false;
        var cells = rows[i].getElementsByTagName('td');

        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent || cells[j].innerText;

            if (cellText.toUpperCase().indexOf(searchTerm) > -1) {
                shouldDisplay = true;
                break;
            }
        }

        rows[i].style.display = shouldDisplay ? '' : 'none';
    }
}
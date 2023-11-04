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
var filaIdEliminarCarrera; // Variable global para almacenar el ID de la fila que se va a eliminar

function eliminarFilaCarrera(id) {
    filaIdEliminarCarrera = id;
    // Muestra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "block";
}

function confirmarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
    
    // Redirige para eliminar la fila
    window.location.href = "php/eliminar_filaCarrera.php?id=" + filaIdEliminarCarrera;
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

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function abrirFormularioEdicion(id, numerodeControl, nombredeCarrera, numerodeSemestres) {
    // Muestra el formulario modal
    var modal = document.getElementById('editar-modal');
    modal.style.display = 'block';

    // Llena los campos del formulario con los datos de la fila correspondiente
    document.getElementById('editar-id').value = id;
    document.getElementById('NumerodeControl').value = numerodeControl;
    document.getElementById('NombredeCarrera').value = nombredeCarrera;
    document.getElementById('NumerodeSemestres').value = numerodeSemestres;
}



function cerrarFormularioEdicion() {
    // Oculta el modal
    var modal = document.getElementById("editar-modal");
    modal.style.display = "none";
}

function validarFormulario() {
    // Obtén los valores de los campos
    var numeroControl = document.getElementById("NumerodeControl").value;
    var nombreCarrera = document.getElementById("NombredeCarrera").value;
    var numeroSemestres = document.getElementById("NumerodeSemestres").value;

    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresion = /^[a-zA-Z0-9\s]+$/;

    if (numeroControl === "" || nombreCarrera === "" || numeroSemestres === "") {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A' 
        });
        return false;
    } else if (!expresion.test(numeroControl) || !expresion.test(nombreCarrera) || !expresion.test(numeroSemestres)) {
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
    var nuevoNumeroControlAcademia = document.getElementById("NuevoNumeroControlAcademia").value;
    var nuevoNombreCarrera = document.getElementById("NuevoNombreCarrera").value;
    var nuevoUSemestres = document.getElementById("NuevoSemestres").value;

    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresión = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚ,.-]+$/;

    if (nuevoNumeroControlAcademia === "" ||nuevoNombreCarrera === ""  || nuevoUSemestres === "") {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A'
        });
        return false;
    } else if (!expresión.test(nuevoNumeroControlAcademia) || !expresión.test(nuevoNombreCarrera) || !expresión.test(nuevoUSemestres)) {
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

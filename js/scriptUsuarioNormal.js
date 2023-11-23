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

var filaIdEliminarNormal; // Variable global para almacenar el ID de la fila que se va a eliminar

function eliminarFilaNormal(id) {
    filaIdEliminarNormal = id;
    // Muestra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "block";
}

function confirmarEliminar() {
    // Cierra el modal
    var modal = document.getElementById("eliminarModal");
    modal.style.display = "none";
    
    // Redirige para eliminar la fila
    window.location.href = "php/eliminar_fila_normal.php?id=" + filaIdEliminarNormal;
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



//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function abrirFormularioEdicionEspecial(id, Academia, NumeroDeControl, NombreDelEstudiante, Numerocontrolgrupo) {
    // Muestra el formulario modal
    var modal = document.getElementById('editar-modal-especial');
    modal.style.display = 'block';

    // Llena los campos del formulario con los datos de la fila correspondiente
    document.getElementById('editar-id').value = id;
    document.getElementById('AcademiaNormal').value = Academia;
    document.getElementById('NumerodeControlNormal').value = NumeroDeControl;
    document.getElementById('NombredelEstudianteNormal').value = NombreDelEstudiante;
    document.getElementById('ControlGrupodelEstudianteNormal').value = Numerocontrolgrupo;
}


function cerrarFormularioEdicionEspecial() {
    // Oculta el modal
    var modal = document.getElementById("editar-modal-especial");
    modal.style.display = "none";
}

function validarFormularioEspecial() {
    // Obtén los valores de los campos
    var numeroControl = document.getElementById("NumerodeControlNormal").value;
    var nombreAcademia = document.getElementById("AcademiaNormal").value;
    var nombreEstudiante = document.getElementById("NombredelEstudianteNormal").value;
    var controlGrupoEstudiante = document.getElementById("ControlGrupodelEstudianteNormal").value;

    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresion = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚ]+$/;

    if (numeroControl === "" || nombreAcademia === "" || nombreEstudiante === "" || controlGrupoEstudiante === "") {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A' 
        });
        return false;
    } else if (!expresion.test(numeroControl) || !expresion.test(nombreAcademia) || !expresion.test(nombreEstudiante) || !expresion.test(controlGrupoEstudiante)) {
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

function abrirFormularioRegistroEspecial() {
    // Muestra el formulario modal de registro
    var modal = document.getElementById('registro-modal-especial');
    modal.style.display = 'block';
}

function cerrarFormularioRegistroEspecial() {
    // Oculta el formulario modal de registro
    var modal = document.getElementById('registro-modal-especial');
    modal.style.display = 'none';
}

function validarFormularioRegistroEspecial() {
    // Obtén los valores de los campos
    var NuevoNumeroControl = document.getElementById("NuevoNumeroControlNormal").value;
    var NuevoNombreCarrera = document.getElementById("NuevoNombreCarreraNormal").value;
    var NuevoNombreAlumno = document.getElementById("NuevoNombreAlumnoNormal").value;
    var NuevoNumeroGrupo = document.getElementById("NuevoControlGrupodelEstudianteNormal").value;


    // Expresión regular para validar que los campos no contengan caracteres especiales
    //var expresion = /^[a-zA-Z0-9\s]+$/;

    if (NuevoNumeroControl === "" ||NuevoNombreCarrera === ""  || NuevoNombreAlumno === "" || NuevoNumeroGrupo === "" ) {
        Swal.fire({
            title: 'Llena todos los campos',
            text: 'Asegúrate de llenar todos los campos',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#197B7A'
        });
        return false;
    } else if (!expresión.test(NuevoNumeroControl) || !expresión.test(NuevoNombreCarrera) || !expresión.test(NuevoNombreAlumno) || !expresión.test(NuevoNumeroGrupo)) {
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

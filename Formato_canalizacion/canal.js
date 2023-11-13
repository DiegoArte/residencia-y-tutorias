function loadImage(url) {
    return new Promise(resolve => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = "blob";
        xhr.onload = function (e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const res = event.target.result;
                resolve(res);
            }
            const file = this.response;
            reader.readAsDataURL(file);
        }
        xhr.send();
    });
}

window.addEventListener('load', async () => {
    const form = document.querySelector('#form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let nombre = document.getElementById('nombre').value;
        let fecha = document.getElementById('fecha').value;
        let control = document.getElementById('numeroControl').value;
        let semestre = document.getElementById('semestre').value;
        let edad = document.getElementById('edad').value;
        let tutor = document.getElementById('nombreTutor').value;
        let problematica = document.getElementById('problematica').value;
        let servicioSolicitado = document.getElementById('servicioSolicitado').value;
        let observaciones = document.getElementById('observaciones').value;
        let plan = document.getElementById('estudio').value;
        // Obtener el archivo de imagen
        const imagenInput = document.getElementById('imagen1');
        const imagenFile = imagenInput.files[0];

        const imagenInput1 = document.getElementById('imagen2');
        const imagenFile1 = imagenInput1.files[0];

        const imagenInput2 = document.getElementById('imagen3');
        const imagenFile2 = imagenInput2.files[0];

        generatePDF(nombre, fecha, control, semestre, edad, tutor, plan, problematica, servicioSolicitado, observaciones, imagenFile, imagenFile1, imagenFile2);

    });
});

async function generatePDF(nombre, fecha, control, semestre, edad, tutor, plan, problematica, servicioSolicitado, observaciones, imagenFile, imagenFile1, imagenFile2)
    {
    const image = await loadImage("formato.jpg");

    // Configurar el PDF como horizontal
    const pdf = new jsPDF({
      orientation: 'portrait', // Establece la orientación en horizontal
      unit: 'pt', // Establece la unidad de medida (puede ser pt, mm, cm, etc.)
      format: [1200, 1600] // Establece el tamaño de la página (ancho x alto)
    });

    pdf.addImage(image, 'PNG', 0, 0, 1200, 1600); // Ajusta el ancho y alto

    pdf.setFontSize(17);
    pdf.text(nombre, 300, 313); //x,y
    pdf.text(fecha, 190, 362);
    pdf.text(control, 515, 362);
    pdf.text(semestre, 210, 460);
    pdf.text(edad, 375, 460);
    pdf.text(tutor, 675, 410);
    pdf.text(plan, 625, 510);
    pdf.text(servicioSolicitado, 100, 820);

    // Agregar la imagen al PDF si se proporcionó una
    if (imagenFile) {
        const imagenBase64 = await convertImageToBase64(imagenFile);
        pdf.addImage(imagenBase64, 'JPEG', 150, 1190, 200, 60);
    }

    if (imagenFile1) {
        const imagenBase64 = await convertImageToBase64(imagenFile1);
        pdf.addImage(imagenBase64, 'JPEG', 450, 1190, 200, 60);
    }

    if (imagenFile2) {
        const imagenBase64 = await convertImageToBase64(imagenFile2);
        pdf.addImage(imagenBase64, 'JPEG', 800, 1190, 200, 60);
    }


    // Dividir la variable problematica por palabras y justificar
    var lineas = divideYJustifica(problematica, 55, pdf);

    // Agregar las palabras justificadas al PDF
    var y = 617; // Iniciar posición en y después de los datos anteriores
    lineas.forEach(function (linea) {
        pdf.text(linea, 100, y);
        y += 20; // Espaciado entre líneas
    });

    // Dividir la variable observaciones por palabras y justificar
    var lineas = divideYJustifica(observaciones, 55, pdf);

    // Agregar las palabras justificadas al PDF
    var y = 992; // Iniciar posición en y después de los datos anteriores
    lineas.forEach(function (linea) {
        pdf.text(linea, 100, y);
        y += 20; // Espaciado entre líneas
    });

    pdf.save("R-ITSZaS-8.5-18 Formato de Canalización.pdf");
}


// Función para dividir y justificar una cadena por palabras
function divideYJustifica(cadena, longitudMaxima, pdf) {
    var palabras = cadena.split(/\s+/);
    var lineas = [];
    var lineaActual = '';

    palabras.forEach(function (palabra) {
        var pruebaLinea = lineaActual + palabra + ' ';

        if (pdf.getStringUnitWidth(pruebaLinea) > longitudMaxima) {
            lineas.push(lineaActual.trim());
            lineaActual = palabra + ' ';
        } else {
            lineaActual = pruebaLinea;
        }
    });

    // Agregar la última línea si es necesario
    if (lineaActual.trim() !== '') {
        lineas.push(lineaActual.trim());
    }

    return lineas;
}


// Función para convertir la imagen a formato base64
function convertImageToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}
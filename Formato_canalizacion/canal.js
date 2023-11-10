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

        generatePDF(nombre, fecha, control);

    });
});

async function generatePDF(nombre, fecha, control)
    {
    const image = await loadImage("formato.jpg");

    // Configurar el PDF como horizontal
    const pdf = new jsPDF({
      orientation: 'portrait', // Establece la orientación en horizontal
      unit: 'pt', // Establece la unidad de medida (puede ser pt, mm, cm, etc.)
      format: [1200, 1600] // Establece el tamaño de la página (ancho x alto)
    });

    pdf.addImage(image, 'PNG', 0, 0, 1200, 1600); // Ajusta el ancho y alto

    pdf.setFontSize(15);
    pdf.text(nombre, 280, 313); //x,y
    pdf.text(fecha, 220, 362);
    pdf.text(control, 515, 362);


    pdf.save("Canalización.pdf");
}

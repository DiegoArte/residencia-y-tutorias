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
        let nombre = document.getElementById('NombredelEstudiante').value;
        let plan = document.getElementById('NombredeCarrera').value;
        const opcionesSeleccionadas1 = [];
        const opcionesSeleccionadas2 = [];
        const opcionesSeleccionadas3 = [];
        const opcionesSeleccionadas4 = [];

        const opcionesSeleccionadas5 = [];
        const opcionesSeleccionadas6 = [];
        const opcionesSeleccionadas7 = [];
        const opcionesSeleccionadas8 = [];

        const opcionesSeleccionadas9 = [];
        const opcionesSeleccionadas10 = [];
        const opcionesSeleccionadas11 = [];
        const opcionesSeleccionadas12 = [];

        const opcionesSeleccionadas13 = [];
        const opcionesSeleccionadas14 = [];
        const opcionesSeleccionadas15 = [];
        const opcionesSeleccionadas16 = [];
        const opcionesSeleccionadas17 = [];

        const opcionesSeleccionadas18 = [];
        const opcionesSeleccionadas19 = [];
        const opcionesSeleccionadas20 = [];

        const opcionesSeleccionadas21 = [];
        const opcionesSeleccionadas22 = [];
        const opcionesSeleccionadas23 = [];

        const opcionesSeleccionadas24 = [];
        const opcionesSeleccionadas25 = [];
        const opcionesSeleccionadas26 = [];
        const opcionesSeleccionadas27 = [];

        const opcionesSeleccionadas28 = [];
        const opcionesSeleccionadas29 = [];

        const opcionesSeleccionadas30 = [];


        if (document.getElementById('opcion1').checked) {
            opcionesSeleccionadas1.push('X');
        }
        if (document.getElementById('opcion2').checked) {
            opcionesSeleccionadas1.push('X');
        }
        if (document.getElementById('opcion3').checked) {
            opcionesSeleccionadas1.push('X');
        }
        if (document.getElementById('opcion4').checked) {
            opcionesSeleccionadas1.push('X');
        }

        if (document.getElementById('opcion5').checked) {
            opcionesSeleccionadas2.push('X');
        }
        if (document.getElementById('opcion6').checked) {
            opcionesSeleccionadas2.push('.');
        }
        if (document.getElementById('opcion7').checked) {
            opcionesSeleccionadas2.push('X');
        }
        if (document.getElementById('opcion8').checked) {
            opcionesSeleccionadas2.push('X');
        }

        if (document.getElementById('opcion9').checked) {
            opcionesSeleccionadas3.push('X');
        }
        if (document.getElementById('opcion10').checked) {
            opcionesSeleccionadas3.push('X');
        }
        if (document.getElementById('opcion11').checked) {
            opcionesSeleccionadas3.push('.');
        }
        if (document.getElementById('opcion12').checked) {
            opcionesSeleccionadas3.push('X');
        }

        if (document.getElementById('opcion13').checked) {
            opcionesSeleccionadas4.push('X');
        }
        if (document.getElementById('opcion14').checked) {
            opcionesSeleccionadas4.push('X');
        }
        if (document.getElementById('opcion15').checked) {
            opcionesSeleccionadas4.push('.');
        }
        if (document.getElementById('opcion16').checked) {
            opcionesSeleccionadas4.push('X');
        }

        if (document.getElementById('opcion17').checked) {
            opcionesSeleccionadas5.push('X');
        }
        if (document.getElementById('opcion18').checked) {
            opcionesSeleccionadas5.push('X');
        }
        if (document.getElementById('opcion19').checked) {
            opcionesSeleccionadas5.push('X');
        }
        if (document.getElementById('opcion20').checked) {
            opcionesSeleccionadas5.push('X');
        }
        
        if (document.getElementById('opcion21').checked) {
            opcionesSeleccionadas6.push('X');
        }
        if (document.getElementById('opcion22').checked) {
            opcionesSeleccionadas6.push('.');
        }
        if (document.getElementById('opcion23').checked) {
            opcionesSeleccionadas6.push('X');
        }
        if (document.getElementById('opcion24').checked) {
            opcionesSeleccionadas6.push('X');
        }

        if (document.getElementById('opcion25').checked) {
            opcionesSeleccionadas7.push('X');
        }
        if (document.getElementById('opcion26').checked) {
            opcionesSeleccionadas7.push('X');
        }
        if (document.getElementById('opcion27').checked) {
            opcionesSeleccionadas7.push('.');
        }
        if (document.getElementById('opcion28').checked) {
            opcionesSeleccionadas7.push('X');
        }

        if (document.getElementById('opcion29').checked) {
            opcionesSeleccionadas8.push('X');
        }
        if (document.getElementById('opcion30').checked) {
            opcionesSeleccionadas8.push('X');
        }
        if (document.getElementById('opcion31').checked) {
            opcionesSeleccionadas8.push('.');
        }
        if (document.getElementById('opcion32').checked) {
            opcionesSeleccionadas8.push('X');

        }

        if (document.getElementById('opcion33').checked) {
            opcionesSeleccionadas9.push('X');
        }
        if (document.getElementById('opcion34').checked) {
            opcionesSeleccionadas9.push('X');
        }
        if (document.getElementById('opcion35').checked) {
            opcionesSeleccionadas9.push('X');
        }
        if (document.getElementById('opcion36').checked) {
            opcionesSeleccionadas9.push('X');
        }
        if (document.getElementById('opcion37').checked) {
            opcionesSeleccionadas10.push('X');
        }
        if (document.getElementById('opcion38').checked) {
            opcionesSeleccionadas10.push('.');
        }
        if (document.getElementById('opcion39').checked) {
            opcionesSeleccionadas10.push('X');
        }
        if (document.getElementById('opcion40').checked) {
            opcionesSeleccionadas10.push('X');
        }

        if (document.getElementById('opcion41').checked) {
            opcionesSeleccionadas11.push('X');
        }
        if (document.getElementById('opcion42').checked) {
            opcionesSeleccionadas11.push('X');
        }
        if (document.getElementById('opcion43').checked) {
            opcionesSeleccionadas11.push('.');
        }
        if (document.getElementById('opcion44').checked) {
            opcionesSeleccionadas11.push('X');
        }
        if (document.getElementById('opcion45').checked) {
            opcionesSeleccionadas12.push('X');
        }
        if (document.getElementById('opcion46').checked) {
            opcionesSeleccionadas12.push('X');
        }
        if (document.getElementById('opcion47').checked) {
            opcionesSeleccionadas12.push('.');
        }
        if (document.getElementById('opcion48').checked) {
            opcionesSeleccionadas12.push('X');
        }

        if (document.getElementById('opcion49').checked) {
            opcionesSeleccionadas13.push('X');
        }
        if (document.getElementById('opcion50').checked) {
            opcionesSeleccionadas13.push('X');
        }
        if (document.getElementById('opcion51').checked) {
            opcionesSeleccionadas13.push('X');
        }
        if (document.getElementById('opcion52').checked) {
            opcionesSeleccionadas13.push('X');
        }

        if (document.getElementById('opcion53').checked) {
            opcionesSeleccionadas14.push('X');
        }
        if (document.getElementById('opcion54').checked) {
            opcionesSeleccionadas14.push('.');
        }
        if (document.getElementById('opcion55').checked) {
            opcionesSeleccionadas14.push('X');
        }
        if (document.getElementById('opcion56').checked) {
            opcionesSeleccionadas14.push('X');
        }

        if (document.getElementById('opcion57').checked) {
            opcionesSeleccionadas15.push('X');
        }
        if (document.getElementById('opcion58').checked) {
            opcionesSeleccionadas15.push('X');
        }
        if (document.getElementById('opcion59').checked) {
            opcionesSeleccionadas15.push('.');
        }
        if (document.getElementById('opcion60').checked) {
            opcionesSeleccionadas15.push('X');
        }
        if (document.getElementById('opcion61').checked) {
            opcionesSeleccionadas16.push('X');
        }
        if (document.getElementById('opcion62').checked) {
            opcionesSeleccionadas16.push('X');
        }
        if (document.getElementById('opcion63').checked) {
            opcionesSeleccionadas16.push('.');
        }
        if (document.getElementById('opcion64').checked) {
            opcionesSeleccionadas16.push('X');
        }

        if (document.getElementById('opcion65').checked) {
            opcionesSeleccionadas17.push('X');
        }
        if (document.getElementById('opcion66').checked) {
            opcionesSeleccionadas17.push('X');
        }
        if (document.getElementById('opcion67').checked) {
            opcionesSeleccionadas17.push('.');
        }
        if (document.getElementById('opcion68').checked) {
            opcionesSeleccionadas17.push('X');

        }

        if (document.getElementById('opcion69').checked) {
            opcionesSeleccionadas18.push('X');
        }
        if (document.getElementById('opcion70').checked) {
            opcionesSeleccionadas18.push('X');
        }
        if (document.getElementById('opcion71').checked) {
            opcionesSeleccionadas18.push('X');
        }
        if (document.getElementById('opcion72').checked) {
            opcionesSeleccionadas18.push('X');
        }
        if (document.getElementById('opcion73').checked) {
            opcionesSeleccionadas19.push('X');
        }
        if (document.getElementById('opcion74').checked) {
            opcionesSeleccionadas19.push('.');
        }
        if (document.getElementById('opcion75').checked) {
            opcionesSeleccionadas19.push('X');
        }
        if (document.getElementById('opcion76').checked) {
            opcionesSeleccionadas19.push('X');
        }

        if (document.getElementById('opcion77').checked) {
            opcionesSeleccionadas20.push('X');
        }
        if (document.getElementById('opcion78').checked) {
            opcionesSeleccionadas20.push('X');
        }
        if (document.getElementById('opcion79').checked) {
            opcionesSeleccionadas20.push('.');
        }
        if (document.getElementById('opcion80').checked) {
            opcionesSeleccionadas20.push('X');
        }

        if (document.getElementById('opcion81').checked) {
            opcionesSeleccionadas21.push('X');
        }
        if (document.getElementById('opcion82').checked) {
            opcionesSeleccionadas21.push('X');
        }
        if (document.getElementById('opcion83').checked) {
            opcionesSeleccionadas21.push('X');
        }
        if (document.getElementById('opcion84').checked) {
            opcionesSeleccionadas21.push('X');
        }

        if (document.getElementById('opcion85').checked) {
            opcionesSeleccionadas22.push('X');
        }
        if (document.getElementById('opcion86').checked) {
            opcionesSeleccionadas22.push('.');
        }
        if (document.getElementById('opcion87').checked) {
            opcionesSeleccionadas22.push('X');
        }
        if (document.getElementById('opcion88').checked) {
            opcionesSeleccionadas22.push('X');
        }

        if (document.getElementById('opcion89').checked) {
            opcionesSeleccionadas23.push('X');
        }
        if (document.getElementById('opcion90').checked) {
            opcionesSeleccionadas23.push('X');
        }
        if (document.getElementById('opcion91').checked) {
            opcionesSeleccionadas23.push('.');
        }
        if (document.getElementById('opcion92').checked) {
            opcionesSeleccionadas23.push('X');
        }

        if (document.getElementById('opcion93').checked) {
            opcionesSeleccionadas24.push('X');
        }
        if (document.getElementById('opcion94').checked) {
            opcionesSeleccionadas24.push('X');
        }
        if (document.getElementById('opcion95').checked) {
            opcionesSeleccionadas24.push('X');
        }
        if (document.getElementById('opcion96').checked) {
            opcionesSeleccionadas24.push('X');
        }

        if (document.getElementById('opcion97').checked) {
            opcionesSeleccionadas25.push('X');
        }
        if (document.getElementById('opcion98').checked) {
            opcionesSeleccionadas25.push('.');
        }
        if (document.getElementById('opcion99').checked) {
            opcionesSeleccionadas25.push('X');
        }
        if (document.getElementById('opcion100').checked) {
            opcionesSeleccionadas25.push('X');
        }
        
        if (document.getElementById('opcion101').checked) {
            opcionesSeleccionadas26.push('X');
        }
        if (document.getElementById('opcion102').checked) {
            opcionesSeleccionadas26.push('X');
        }
        if (document.getElementById('opcion103').checked) {
            opcionesSeleccionadas26.push('.');
        }
        if (document.getElementById('opcion104').checked) {
            opcionesSeleccionadas26.push('X');
        }
        
        if (document.getElementById('opcion105').checked) {
            opcionesSeleccionadas27.push('X');
        }
        if (document.getElementById('opcion106').checked) {
            opcionesSeleccionadas27.push('X');
        }
        if (document.getElementById('opcion107').checked) {
            opcionesSeleccionadas27.push('.');
        }
        if (document.getElementById('opcion108').checked) {
            opcionesSeleccionadas27.push('X');
        }

        if (document.getElementById('opcion109').checked) {
            opcionesSeleccionadas28.push('X');
        }
        if (document.getElementById('opcion110').checked) {
            opcionesSeleccionadas28.push('X');
        }
        if (document.getElementById('opcion111').checked) {
            opcionesSeleccionadas28.push('X');
        }
        if (document.getElementById('opcion112').checked) {
            opcionesSeleccionadas28.push('X');
        }
        
        if (document.getElementById('opcion113').checked) {
            opcionesSeleccionadas29.push('X');
        }
        if (document.getElementById('opcion114').checked) {
            opcionesSeleccionadas29.push('X');
        }
        if (document.getElementById('opcion115').checked) {
            opcionesSeleccionadas29.push('.');
        }
        if (document.getElementById('opcion116').checked) {
            opcionesSeleccionadas29.push('X');
        }

        if (document.getElementById('opcion117').checked) {
            opcionesSeleccionadas30.push('X');
        }
        if (document.getElementById('opcion118').checked) {
            opcionesSeleccionadas30.push('X');
        }
        if (document.getElementById('opcion119').checked) {
            opcionesSeleccionadas30.push('.');
        }
        if (document.getElementById('opcion120').checked) {
            opcionesSeleccionadas30.push('X');
        }
        generatePDF(nombre, plan, opcionesSeleccionadas1, opcionesSeleccionadas2,opcionesSeleccionadas3,
            opcionesSeleccionadas4,opcionesSeleccionadas5,opcionesSeleccionadas6,opcionesSeleccionadas7,
            opcionesSeleccionadas8,opcionesSeleccionadas9,opcionesSeleccionadas10,opcionesSeleccionadas11,
            opcionesSeleccionadas12,opcionesSeleccionadas13,opcionesSeleccionadas14,opcionesSeleccionadas15,
            opcionesSeleccionadas16,opcionesSeleccionadas17,opcionesSeleccionadas18,opcionesSeleccionadas19,
            opcionesSeleccionadas20,opcionesSeleccionadas21,opcionesSeleccionadas22,opcionesSeleccionadas23,
            opcionesSeleccionadas24,opcionesSeleccionadas25,opcionesSeleccionadas26,opcionesSeleccionadas27,
            opcionesSeleccionadas28,opcionesSeleccionadas29,opcionesSeleccionadas30);

    });
});

async function generatePDF(nombre, plan, opcionesSeleccionadas1, opcionesSeleccionadas2,opcionesSeleccionadas3,
    opcionesSeleccionadas4,opcionesSeleccionadas5,opcionesSeleccionadas6,opcionesSeleccionadas7,opcionesSeleccionadas8
    ,opcionesSeleccionadas9,opcionesSeleccionadas10,opcionesSeleccionadas11,opcionesSeleccionadas12,opcionesSeleccionadas13,
    opcionesSeleccionadas14,opcionesSeleccionadas15,opcionesSeleccionadas16,opcionesSeleccionadas17,opcionesSeleccionadas18,
    opcionesSeleccionadas19,opcionesSeleccionadas20,opcionesSeleccionadas21,opcionesSeleccionadas22,opcionesSeleccionadas23,
    opcionesSeleccionadas24,opcionesSeleccionadas25,opcionesSeleccionadas26,opcionesSeleccionadas27,opcionesSeleccionadas28,
    opcionesSeleccionadas29,opcionesSeleccionadas30)
    {
    const image = await loadImage("hv.jpg");

    // Configurar el PDF como horizontal
    const pdf = new jsPDF({
      orientation: 'landscape', // Establece la orientación en horizontal
      unit: 'pt', // Establece la unidad de medida (puede ser pt, mm, cm, etc.)
      format: [1000, 600] // Establece el tamaño de la página (ancho x alto)
    });

    pdf.addImage(image, 'PNG', 0, 0, 1000, 600); // Ajusta el ancho y alto

    pdf.setFontSize(12);
    pdf.text(nombre, 220, 120);
    pdf.text(plan, 700, 120);

    // Agrega las opciones seleccionadas al PDF
    pdf.setFontSize(9);
    let offsetY1 = 42;
    opcionesSeleccionadas1.forEach(opcion => {
        pdf.text(opcion, offsetY1,207);
        offsetY1 += 23;
    });

    let offsetY2 = 42;
    opcionesSeleccionadas2.forEach(opcion => {
        pdf.text(opcion, offsetY2,265);
        offsetY2 += 23;
    });
    let offsetY3 = 42;
    opcionesSeleccionadas3.forEach(opcion => {
        pdf.text(opcion, offsetY3,323);
        offsetY3 += 23;
    });

    let offsetY4 = 42;
    opcionesSeleccionadas4.forEach(opcion => {
        pdf.text(opcion, offsetY4,381);
        offsetY4 += 23;
    });

    let offsetY5 = 145;
    opcionesSeleccionadas5.forEach(opcion => {
        pdf.text(opcion, offsetY5,207);
        offsetY5 += 23;
    });

    let offsetY6 = 145;
    opcionesSeleccionadas6.forEach(opcion => {
        pdf.text(opcion, offsetY6,265);
        offsetY6 += 23;
    });
    let offsetY7 = 145;
    opcionesSeleccionadas7.forEach(opcion => {
        pdf.text(opcion, offsetY7,323);
        offsetY7 += 23;
    });

    let offsetY8 = 145;
    opcionesSeleccionadas8.forEach(opcion => {
        pdf.text(opcion, offsetY8,381);
        offsetY8 += 23;
    });

    let offsetY9 = 248;
    opcionesSeleccionadas9.forEach(opcion => {
        pdf.text(opcion, offsetY9,207);
        offsetY9 += 23;
    });

    let offsetY10 = 248;
    opcionesSeleccionadas10.forEach(opcion => {
        pdf.text(opcion, offsetY10,265);
        offsetY10 += 23;
    });

    let offsetY11 = 248;
    opcionesSeleccionadas11.forEach(opcion => {
        pdf.text(opcion, offsetY11,323);
        offsetY11 += 23;
    });
    let offsetY12 = 248;
    opcionesSeleccionadas12.forEach(opcion => {
        pdf.text(opcion, offsetY12,381);
        offsetY12 += 23;
    });

    let offsetY13 = 351;
    opcionesSeleccionadas13.forEach(opcion => {
        pdf.text(opcion, offsetY13,207);
        offsetY13 += 23;
    });

    let offsetY14 = 351;
    opcionesSeleccionadas14.forEach(opcion => {
        pdf.text(opcion, offsetY14,265);
        offsetY14 += 23;
    });

    let offsetY15 = 351;
    opcionesSeleccionadas15.forEach(opcion => {
        pdf.text(opcion, offsetY15,323);
        offsetY15 += 23;
    });

    let offsetY16 = 351;
    opcionesSeleccionadas16.forEach(opcion => {
        pdf.text(opcion, offsetY16,381);
        offsetY16 += 23;
    });

    let offsetY17 = 351;
    opcionesSeleccionadas17.forEach(opcion => {
        pdf.text(opcion, offsetY17,439);
        offsetY17 += 23;
    });


    let offsetY18 = 454;
    opcionesSeleccionadas18.forEach(opcion => {
        pdf.text(opcion, offsetY18,207);
        offsetY18 += 23;
    });

    let offsetY19 = 454;
    opcionesSeleccionadas19.forEach(opcion => {
        pdf.text(opcion, offsetY19,265);
        offsetY19 += 23;
    });

    let offsetY20 = 454;
    opcionesSeleccionadas20.forEach(opcion => {
        pdf.text(opcion, offsetY20,381);
        offsetY20 += 23;
    });


    let offsetY21 = 557;
    opcionesSeleccionadas21.forEach(opcion => {
        pdf.text(opcion, offsetY21,207);
        offsetY21 += 23;
    });

    let offsetY22 = 557;
    opcionesSeleccionadas22.forEach(opcion => {
        pdf.text(opcion, offsetY22,265);
        offsetY22 += 23;
    });

    let offsetY23 = 557;
    opcionesSeleccionadas23.forEach(opcion => {
        pdf.text(opcion, offsetY23,381);
        offsetY23 += 23;
    });

    let offsetY24 = 665;
    opcionesSeleccionadas24.forEach(opcion => {
        pdf.text(opcion, offsetY24,207);
        offsetY24 += 23;
    });

    let offsetY25 = 665;
    opcionesSeleccionadas25.forEach(opcion => {
        pdf.text(opcion, offsetY25,265);
        offsetY25 += 23;
    });

    let offsetY26 = 665;
    opcionesSeleccionadas26.forEach(opcion => {
        pdf.text(opcion, offsetY26,381);
        offsetY26 += 23;
    });

    let offsetY27 = 665;
    opcionesSeleccionadas27.forEach(opcion => {
        pdf.text(opcion, offsetY27,439);
        offsetY27 += 23;
    });

    let offsetY28 = 774;
    opcionesSeleccionadas28.forEach(opcion => {
        pdf.text(opcion, offsetY28,207);
        offsetY28 += 23;
    });

    let offsetY29 = 774;
    opcionesSeleccionadas29.forEach(opcion => {
        pdf.text(opcion, offsetY29,381);
        offsetY29 += 23;
    });


    let offsetY30 =883;
    opcionesSeleccionadas30.forEach(opcion => {
        pdf.text(opcion, offsetY30,265);
        offsetY30 += 23;
    });
    pdf.save("Hoja de vida.pdf");
}

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
        let plan = document.getElementById('plan').value;
        let semestre = document.getElementById('semestre').value;
        let fechaNacimiento = document.getElementById('fecha_nacimiento').value;
        let genero = document.querySelector('input[name="genero"]:checked').value;
        let lugarNacimiento = document.getElementById('lugar_nacimiento').value;
        let domicilio = document.getElementById('domicilio').value;
        let colonia = document.getElementById('colonia').value;
        let municipio = document.getElementById('municipio').value;
        let estado = document.getElementById('estado').value;
        let cp = document.getElementById('cp').value;
        let telParticular = document.getElementById('tel_particular').value;
        let telCelular = document.getElementById('tel_celular').value;
        let telOtro = document.getElementById('tel_otro').value;
        let emergencia = document.getElementById('emergencia').value;
        let telEmergencia = document.getElementById('tel_emergencia').value;
        let correo = document.getElementById('correo').value;
        let escuelaPrimaria = document.querySelector('input[name="escuela_primaria"]:checked').value;
        let promedioPrimaria = document.getElementById('promedio_primaria').value;
        let escuelaSecundaria = document.querySelector('input[name="escuela_secundaria"]:checked').value;
        let promedioSecundaria = document.getElementById('promedio_secundaria').value;
        let bachillerato = document.querySelector('input[name="bachillerato"]:checked').value;
        let promedioBachillerato = document.getElementById('promedio_bachillerato').value;
        let nombreBachillerato = document.getElementById('nombre_bachillerato').value;
        let motivos = document.querySelector('input[name="motivos"]:checked').value;
        let consideracion = document.querySelector('input[name="consideracion"]:checked').value;
        let repeticionPrimaria = document.querySelectorAll('input[name="repeticion_primaria[]"]:checked');
        let repeticionPrimariaValues = Array.from(repeticionPrimaria).map(input => input.value);
        let repeticionSecundaria = document.querySelectorAll('input[name="repeticion_secundaria[]"]:checked');
        let repeticionSecundariaValues = Array.from(repeticionSecundaria).map(input => input.value);
        let repeticionPreparatoria = document.querySelectorAll('input[name="repeticion_preparatoria[]"]:checked');
        let repeticionPreparatoriaValues = Array.from(repeticionPreparatoria).map(input => input.value);
        let enfermedad = document.querySelector('input[name="enfermedad"]:checked').value;
        let nombreEnfermedad = document.getElementById('nombre_enfermedad').value;
        let medicamentos = document.getElementById('medicamentos').value;
        let frecuenciaMedicamentos = document.getElementById('frecuencia_medicamentos').value;
        let tiempoTraslado = document.getElementById('tiempo_traslado').value;
        let alimento = document.querySelector('input[name="alimento"]:checked').value;
        let consumoCarne = document.getElementById('consumo_carne').value;
        let consumoPollo = document.getElementById('consumo_pollo').value;
        let consumoHuevo = document.getElementById('consumo_huevo').value;
        let consumoLeche = document.getElementById('consumo_leche').value;
        let consumoVerduras = document.getElementById('consumo_verduras').value;
        let consumoPan = document.getElementById('consumo_pan').value;
        let estadoCivil = document.querySelector('input[name="estado_civil"]:checked').value;
        let numeroHijos = document.querySelector('input[name="numero_hijos"]:checked').value;
        let trabajaConyuge = document.querySelector('input[name="trabaja_conyuge"]:checked').value;
        let lugarTrabajoConyuge = document.getElementById('lugar_trabajo_conyuge').value;
        let puestoConyuge = document.getElementById('puesto_conyuge').value;
        let telefonoConyuge = document.getElementById('telefono_conyuge').value;
        let vivesCon = document.querySelector('input[name="vives_con"]:checked').value;
        let vivirasCon = document.querySelector('input[name="vivviras_con"]:checked').value;
        let trabajas = document.querySelector('input[name="trabajas"]:checked').value;
        let lugarTrabajo = document.getElementById('lugar_trabajo').value;
        let puesto = document.getElementById('puesto').value;
        let telefonoTrabajo = document.getElementById('telefono_trabajo').value;
        let ingresoFamiliar = document.querySelector('input[name="ingreso_familiar"]:checked').value;
        let personasDependen = document.querySelector('input[name="personas_dependen"]:checked').value;
        let conviveFamilia = document.querySelector('input[name="convive_familia"]:checked').value;
        let esparcimientoLugares = document.querySelector('input[name="esparcimiento_lugares"]:checked').value;
        let comunicacionFamilia = document.querySelector('input[name="comunicacion_familia"]:checked').value;
        let mayorConfianza = document.getElementById('mayor_confianza_parentesco').value;
        let mayorConfianzaNombre = document.getElementById('mayor_confianza_nombre').value;
        let tipoCasa = document.querySelector('input[name="tipo_casa"]:checked').value;
        let materialesCasa = document.querySelector('input[name="materiales_casa"]:checked').value;
        let habitacionesCasa = document.querySelector('input[name="habitaciones_casa"]:checked').value;
        let estadoPadres = document.querySelector('input[name="estado_padres"]:checked').value;
        let apellidoPaternoPadre = document.getElementById('apellido_paterno_padre').value;
        let apellidoMaternoPadre = document.getElementById('apellido_materno_padre').value;
        let nombresPadre = document.getElementById('nombres_padre').value;
        let callePadre = document.getElementById('calle_padre').value;
        let numeroPadre = document.getElementById('numero_padre').value;
        let coloniaPadre = document.getElementById('colonia_padre').value;
        let ciudadPadre = document.getElementById('ciudad_padre').value;
        let estadoPadre = document.getElementById('estado_padre').value;
        let telefonoPadre = document.getElementById('telefono_padre').value;
        let CiudadNacimientoPadre = document.getElementById('ciudad_nacimiento_padre').value;
        let EstadoNacimientoPadre = document.getElementById('estado_nacimiento_padre').value;
        let FechaNacimientoPadre = document.getElementById('fecha_nacimiento_padre').value;
        let gradoEstudiosPadre = document.querySelector('input[name="grado_estudios_padre"]:checked').value;
        let trabajoPadre = document.querySelector('input[name="trabajo_padre"]:checked').value;
        let lugarTrabajoPadre = document.getElementById('lugar_trabajo_padre').value;
        let puestoTrabajoPadre = document.getElementById('puesto_trabajo_padre').value;
        let telefonoTrabajoPadre = document.getElementById('telefono_trabajo_padre').value;
        let servicioMedicoPadre = document.querySelector('input[name="servicio_medico"]:checked').value;
        let apellidoPaternoMadre = document.getElementById('apellido_paterno_madre').value;
        let apellidoMaternoMadre = document.getElementById('apellido_materno_madre').value;
        let nombresMadre = document.getElementById('nombres_madre').value;
        let calleMadre = document.getElementById('calle_madre').value;
        let numeroMadre = document.getElementById('numero_madre').value;
        let coloniaMadre = document.getElementById('colonia_madre').value;
        let ciudadMadre = document.getElementById('ciudad_madre').value;
        let estadoMadre = document.getElementById('estado_madre').value;
        let telefonoMadre = document.getElementById('telefono_madre').value;
        let CiudadNacimientoMadre = document.getElementById('ciudad_nacimiento_madre').value;
        let EstadoNacimientoMadre = document.getElementById('estado_nacimiento_madre').value;
        let FechaNacimientoMadre = document.getElementById('fecha_nacimiento_madre').value;
        let gradoEstudiosMadre = document.querySelector('input[name="grado_estudios_madre"]:checked').value;
        let trabajoMadre = document.querySelector('input[name="trabajo_madre"]:checked').value;
        let lugarTrabajoMadre = document.getElementById('lugar_trabajo_madre').value;
        let puestoTrabajoMadre = document.getElementById('puesto_trabajo_madre').value;
        let telefonoTrabajoMadre = document.getElementById('telefono_trabajo_madre').value;
        let servicioMedicoMadre = document.querySelector('input[name="servicio_medico_madre"]:checked').value;
        let apoyoEconomico = document.querySelector('input[name="apoyo_economico"]:checked').value;
        let institucionApoyo = document.getElementById('institucion_apoyo').value;
        let montoApoyoMensual = document.getElementById('monto_apoyo_mensual').value;
        let motivosProgramaEstudio = document.querySelectorAll('input[name="motivos_programa_estudio[]"]:checked');
        let motivosProgramaEstudioCheckboxes = Array.from(motivosProgramaEstudio).map(input => input.value);
        let metasCincoAnosTrabajo = document.getElementById('metas_cinco_anos_trabajo').value;
        let metasCincoAnosFamiliares = document.getElementById('metas_cinco_anos_familiares').value;
        let metasCincoAnosPersonales = document.getElementById('metas_cinco_anos_personales').value;
        let metasCincoAnosAcademicas = document.getElementById('metas_cinco_anos_academicas').value;
        let herramientasParaLograrMetasTrabajo = document.getElementById('herramientas_para_lograr_metas_trabajo').value;
        let herramientasParaLograrMetasFamilia = document.getElementById('herramientas_para_lograr_metas_familia').value;
        let herramientasParaLograrMetasPersonales = document.getElementById('herramientas_para_lograr_metas_personales').value;
        let herramientasParaLograrMetasAcademicas = document.getElementById('herramientas_para_lograr_metas_academicas').value;
        let obstaculosParaLograrMetasTrabajo = document.getElementById('obstaculos_para_lograr_metas_trabajo').value;
        let obstaculosParaLograrMetasFamilia = document.getElementById('obstaculos_para_lograr_metas_familia').value;
        let obstaculosParaLograrMetasPersonales = document.getElementById('obstaculos_para_lograr_metas_personales').value;
        let obstaculosParaLograrMetasAcademicas = document.getElementById('obstaculos_para_lograr_metas_academicas').value;
        let fechaAplicacion = document.getElementById('fecha_aplicacion').value;
        let nombreTutor = document.getElementById('nombre_tutor').value;
        let cubiculo = document.getElementById('cubiculo').value;
        let telefonoTutor = document.getElementById('telefono_tutor').value;
        let observacionesRecomendaciones = document.getElementById('observaciones_recomendaciones').value;

        // Obtener el archivo de imagen
        const imagenInput = document.getElementById('imagen1');
        const imagenFile = imagenInput.files[0];

        const imagenInput2 = document.getElementById('imagen2');
        const imagenFile2 = imagenInput2.files[0];



















        
       
        generatePDF(nombre, plan, semestre, fechaNacimiento, genero, lugarNacimiento, domicilio, colonia, municipio, estado, cp, telParticular, 
                    telCelular, telOtro, emergencia, telEmergencia, correo, escuelaPrimaria, promedioPrimaria, escuelaSecundaria, promedioSecundaria, 
                    bachillerato, promedioBachillerato, nombreBachillerato, motivos, consideracion, repeticionPrimariaValues, repeticionSecundariaValues, 
                    repeticionPreparatoriaValues, enfermedad, nombreEnfermedad, medicamentos, frecuenciaMedicamentos, tiempoTraslado, alimento, 
                    consumoCarne, consumoPollo, consumoHuevo, consumoLeche, consumoVerduras, consumoPan, estadoCivil, numeroHijos, trabajaConyuge, 
                    lugarTrabajoConyuge, puestoConyuge, telefonoConyuge, vivesCon, vivirasCon, trabajas, lugarTrabajo, puesto, telefonoTrabajo, 
                    ingresoFamiliar, personasDependen, conviveFamilia, esparcimientoLugares, comunicacionFamilia, mayorConfianza,mayorConfianzaNombre, tipoCasa, 
                    materialesCasa, habitacionesCasa,estadoPadres, apellidoPaternoPadre, apellidoMaternoPadre, nombresPadre, callePadre, numeroPadre, coloniaPadre, 
                    ciudadPadre, estadoPadre, telefonoPadre,CiudadNacimientoPadre, EstadoNacimientoPadre, FechaNacimientoPadre, gradoEstudiosPadre, trabajoPadre, lugarTrabajoPadre, 
                    puestoTrabajoPadre, telefonoTrabajoPadre,servicioMedicoPadre, apellidoPaternoMadre, apellidoMaternoMadre, nombresMadre, calleMadre, numeroMadre, coloniaMadre,
                    ciudadMadre, estadoMadre, telefonoMadre, CiudadNacimientoMadre, EstadoNacimientoMadre, FechaNacimientoMadre, gradoEstudiosMadre, trabajoMadre,
                    lugarTrabajoMadre, puestoTrabajoMadre ,telefonoTrabajoMadre, servicioMedicoMadre, apoyoEconomico, institucionApoyo, montoApoyoMensual, motivosProgramaEstudioCheckboxes, metasCincoAnosTrabajo, 
                    metasCincoAnosFamiliares, metasCincoAnosPersonales, metasCincoAnosAcademicas, herramientasParaLograrMetasTrabajo, 
                    herramientasParaLograrMetasFamilia, herramientasParaLograrMetasPersonales, herramientasParaLograrMetasAcademicas, 
                    obstaculosParaLograrMetasTrabajo, obstaculosParaLograrMetasFamilia, obstaculosParaLograrMetasPersonales, 
                    obstaculosParaLograrMetasAcademicas, fechaAplicacion, nombreTutor, cubiculo, telefonoTutor, observacionesRecomendaciones,imagenFile,imagenFile2
                    );
    })
});

async function generatePDF(nombre, plan, semestre, fechaNacimiento, genero, lugarNacimiento, domicilio, colonia, municipio, estado, cp, telParticular, 
                            telCelular, telOtro, emergencia, telEmergencia, correo, escuelaPrimaria, promedioPrimaria, escuelaSecundaria, promedioSecundaria, 
                            bachillerato, promedioBachillerato, nombreBachillerato, motivos, consideracion, repeticionPrimariaValues, repeticionSecundariaValues, 
                            repeticionPreparatoriaValues, enfermedad, nombreEnfermedad, medicamentos, frecuenciaMedicamentos, tiempoTraslado, alimento, 
                            consumoCarne, consumoPollo, consumoHuevo, consumoLeche, consumoVerduras, consumoPan, estadoCivil, numeroHijos, trabajaConyuge, 
                            lugarTrabajoConyuge, puestoConyuge, telefonoConyuge, vivesCon, vivirasCon, trabajas, lugarTrabajo, puesto, telefonoTrabajo, 
                            ingresoFamiliar, personasDependen, conviveFamilia, esparcimientoLugares, comunicacionFamilia, mayorConfianza,mayorConfianzaNombre, tipoCasa, 
                            materialesCasa, habitacionesCasa, estadoPadres, apellidoPaternoPadre, apellidoMaternoPadre, nombresPadre, callePadre, numeroPadre, 
                            coloniaPadre, ciudadPadre, estadoPadre, telefonoPadre,CiudadNacimientoPadre, EstadoNacimientoPadre, FechaNacimientoPadre, gradoEstudiosPadre, trabajoPadre, lugarTrabajoPadre,
                            puestoTrabajoPadre, telefonoTrabajoPadre, servicioMedicoPadre, apellidoPaternoMadre, apellidoMaternoMadre, nombresMadre, calleMadre, numeroMadre,
                            coloniaMadre, ciudadMadre, estadoMadre, telefonoMadre, CiudadNacimientoMadre, EstadoNacimientoMadre, FechaNacimientoMadre, gradoEstudiosMadre,
                            trabajoMadre, lugarTrabajoMadre, puestoTrabajoMadre ,telefonoTrabajoMadre, servicioMedicoMadre, apoyoEconomico, institucionApoyo, montoApoyoMensual, motivosProgramaEstudioCheckboxes, metasCincoAnosTrabajo, 
                            metasCincoAnosFamiliares, metasCincoAnosPersonales, metasCincoAnosAcademicas, herramientasParaLograrMetasTrabajo, 
                            herramientasParaLograrMetasFamilia, herramientasParaLograrMetasPersonales, herramientasParaLograrMetasAcademicas, 
                            obstaculosParaLograrMetasTrabajo, obstaculosParaLograrMetasFamilia, obstaculosParaLograrMetasPersonales, 
                            obstaculosParaLograrMetasAcademicas, fechaAplicacion, nombreTutor, cubiculo, telefonoTutor, observacionesRecomendaciones,imagenFile,imagenFile2) {


    const image = await loadImage("N R-ITSZaS-8.5-17 Diagnostico original_page-0001.jpg");
    const pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addImage(image, 'PNG', 0, 0, 612, 792);
    pdf.setFontSize(9);
    
    pdf.text(nombre, 96, 170); // Ajusta las coordenadas según la ubicación en tu formulario
    pdf.text(plan, 132, 180);   // Ajusta las coordenadas
    pdf.text(semestre, 415, 180);  // Ajusta las coordenadas
    pdf.text(fechaNacimiento, 148, 192);  // Ajusta las coordenadas
    pdf.text(lugarNacimiento, 148, 202);  // Ajusta las coordenadas
    pdf.text(domicilio, 103, 212);  // Ajusta las coordenadas
    pdf.text(colonia, 96, 224);  // Ajusta las coordenadas
    pdf.text(municipio, 270, 224);  // Ajusta las coordenadas
    pdf.text(estado, 95, 235);  // Ajusta las coordenadas
    pdf.text(cp, 242, 235);  // Ajusta las coordenadas
    pdf.text(telParticular, 123, 246);  // Ajusta las coordenadas
    pdf.text(telCelular, 272, 246);  // Ajusta las coordenadas
    pdf.text(telOtro, 388, 246);  // Ajusta las coordenadas
    pdf.text(emergencia, 200, 257);  // Ajusta las coordenadas
    pdf.text(telEmergencia, 402, 257);  // Ajusta las coordenadas
    pdf.text(correo, 149, 268);  // Ajusta las coordenadas
    pdf.text(promedioPrimaria, 430, 312);   // Ajusta las coordenadas
    pdf.text(promedioSecundaria, 430, 324);  // Ajusta las coordenadas
    pdf.text(promedioBachillerato, 430, 336);  // Ajusta las coordenadas  
    pdf.text(nombreBachillerato, 170, 345);  // Ajusta las coordenadas
    pdf.text(nombreEnfermedad, 90, 555);  // Ajusta las coordenadas
    pdf.text(medicamentos, 175, 568);  // Ajusta las coordenadas
    pdf.text(frecuenciaMedicamentos, 360, 568);  // Ajusta las coordenadas
    pdf.text(tiempoTraslado, 60, 605);  // Ajusta las coordenadas
    pdf.text(consumoCarne, 96, 657);  // Ajusta las coordenadas
    pdf.text(consumoPollo, 164, 657);  // Ajusta las coordenadas
    pdf.text(consumoHuevo, 230, 657);  // Ajusta las coordenadas
    pdf.text(consumoLeche, 296, 657);  // Ajusta las coordenadas
    pdf.text(consumoVerduras, 381, 657);  // Ajusta las coordenadas
    pdf.text(consumoPan, 440, 657);  // Ajusta las coordenadas
    
    if (genero === "M") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(400 - 2, 189 - 2, 400 + 2, 189 + 2); // Primera línea diagonal
        pdf.line(400 - 2, 189 + 2, 400 + 2, 189 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(448 - 2, 189 - 2, 448 + 2, 189 + 2); // Primera línea diagonal
        pdf.line(448 - 2, 189 + 2, 448 + 2, 189 - 2); // Segunda línea diagonal
    }

    if (escuelaPrimaria === "publica") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(275 - 2, 310 - 2, 275 + 2, 310 + 2); // Primera línea diagonal
        pdf.line(275 - 2, 310 + 2, 275 + 2, 310 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 310 - 2, 358 + 2, 310 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 310 + 2, 358 + 2, 310 - 2); // Segunda línea diagonal
    }

    if (escuelaSecundaria === "publica") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(276 - 2, 321 - 2, 276 + 2, 321 + 2); // Primera línea diagonal
        pdf.line(276 - 2, 321 + 2, 276 + 2, 321 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(359 - 2, 321 - 2, 359 + 2, 321 + 2); // Primera línea diagonal
        pdf.line(359 - 2, 321 + 2, 359 + 2, 321 - 2); // Segunda línea diagonal
    }

    if (bachillerato === "publica") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(277 - 2, 332 - 2, 277 + 2, 332 + 2); // Primera línea diagonal
        pdf.line(277 - 2, 332 + 2, 277 + 2, 332 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(360 - 2, 332 - 2, 360 + 2, 332 + 2); // Primera línea diagonal
        pdf.line(360 - 2, 332 + 2, 360 + 2, 332 - 2); // Segunda línea diagonal
    }

    if (motivos === "amigo") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(65 - 2, 376 - 2, 65 + 2, 376 + 2); // Primera línea diagonal
        pdf.line(65 - 2, 376 + 2, 65 + 2, 376 - 2); // Segunda línea diagonal
    } else if (motivos === "padres") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(154 - 2, 376 - 2, 154 + 2, 376 + 2); // Primera línea diagonal
        pdf.line(154 - 2, 376 + 2, 154 + 2, 376 - 2); // Segunda línea diagonal
    } else if (motivos === "plan_estudio") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(236 - 2, 376 - 2, 236 + 2, 376 + 2); // Primera línea diagonal
        pdf.line(236 - 2, 376 + 2, 236 + 2, 376 - 2); // Segunda línea diagonal
    } else if (motivos === "conviccion") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(340 - 2, 376 - 2, 340 + 2, 376 + 2); // Primera línea diagonal
        pdf.line(340 - 2, 376 + 2, 340 + 2, 376 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(65 - 2, 388 - 2, 65 + 2, 388 + 2); // Primera línea diagonal
        pdf.line(65 - 2, 388 + 2, 65 + 2, 388 - 2); // Segunda línea diagonal
    }

    if (consideracion === "excelente") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(65 - 2, 420 - 2, 65 + 2, 420 + 2); // Primera línea diagonal
        pdf.line(65 - 2, 420 + 2, 65 + 2, 420 - 2); // Segunda línea diagonal
    } else if (consideracion === "bueno") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(151 - 2, 420 - 2, 151 + 2, 420 + 2); // Primera línea diagonal
        pdf.line(151 - 2, 420 + 2, 151 + 2, 420 - 2); // Segunda línea diagonal
    } else if (consideracion === "regular") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(234 - 2, 420 - 2, 234 + 2, 420 + 2); // Primera línea diagonal
        pdf.line(234 - 2, 420 + 2, 234 + 2, 420 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(339 - 2, 420 - 2, 339 + 2, 420 + 2); // Primera línea diagonal
        pdf.line(339 - 2, 420 + 2, 339 + 2, 420 - 2); // Segunda línea diagonal
    }

    if (repeticionPrimariaValues[0] === "1") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(215 - 2, 475 - 2, 215 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(215 - 2, 475 + 2, 215 + 2, 475 - 2); // Segunda línea diagonal
    } if (repeticionPrimariaValues[1] === "2") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(248 - 2, 475 - 2, 248 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(248 - 2, 475 + 2, 248 + 2, 475 - 2); // Segunda línea diagonal
    } if (repeticionPrimariaValues[2] === "3") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(282 - 2, 475 - 2, 282 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(282 - 2, 475 + 2, 282 + 2, 475 - 2); // Segunda línea diagonal
    } if (repeticionPrimariaValues[3] === "4") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(312 - 2, 475 - 2, 312 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(312 - 2, 475 + 2, 312 + 2, 475 - 2); // Segunda línea diagonal
    } if (repeticionPrimariaValues[4] === "5") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(340 - 2, 475 - 2, 340 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(340 - 2, 475 + 2, 340 + 2, 475 - 2); // Segunda línea diagonal
    } if (repeticionPrimariaValues[5] === "6") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(370 - 2, 475 - 2, 370 + 2, 475 + 2); // Primera línea diagonal
        pdf.line(370 - 2, 475 + 2, 370 + 2, 475 - 2); // Segunda línea diagonal
    } 

    if (repeticionSecundariaValues[0] === "7") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(215 - 2, 496 - 2, 215 + 2, 496 + 2); // Primera línea diagonal
        pdf.line(215 - 2, 496 + 2, 215 + 2, 496 - 2); // Segunda línea diagonal
    } if (repeticionSecundariaValues[1] === "8") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(248 - 2, 496 - 2, 248 + 2, 496 + 2); // Primera línea diagonal
        pdf.line(248 - 2, 496 + 2, 248 + 2, 496 - 2); // Segunda línea diagonal
    } if (repeticionSecundariaValues[2] === "9") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(282 - 2, 496 - 2, 282 + 2, 496 + 2); // Primera línea diagonal
        pdf.line(282 - 2, 496 + 2, 282 + 2, 496 - 2); // Segunda línea diagonal
    } 

    if (repeticionPreparatoriaValues[0] === "10") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(215 - 2, 518 - 2, 215 + 2, 518 + 2); // Primera línea diagonal
        pdf.line(215 - 2, 518 + 2, 215 + 2, 518 - 2); // Segunda línea diagonal
    } if (repeticionPreparatoriaValues[1] === "11") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(248 - 2, 518 - 2, 248 + 2, 518 + 2); // Primera línea diagonal
        pdf.line(248 - 2, 518 + 2, 248 + 2, 518 - 2); // Segunda línea diagonal
    } if (repeticionPreparatoriaValues[2] === "12") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(282 - 2, 518 - 2, 282 + 2, 518 + 2); // Primera línea diagonal
        pdf.line(282 - 2, 518 + 2, 282 + 2, 518 - 2); // Segunda línea diagonal
    } 

    if (enfermedad === "SI") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(343 - 2, 540 - 2, 343 + 2, 540 + 2); // Primera línea diagonal
        pdf.line(343 - 2, 540 + 2, 343 + 2, 540 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(448 - 2, 189 - 2, 448 + 2, 189 + 2); // Primera línea diagonal
        pdf.line(448 - 2, 189 + 2, 448 + 2, 189 - 2); // Segunda línea diagonal
    }

    if (alimento === "SIEMPRE") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(99 - 2, 630 - 2, 99 + 2, 630 + 2); // Primera línea diagonal
        pdf.line(99 - 2, 630 + 2, 99 + 2, 630 - 2); // Segunda línea diagonal
    } else if (alimento === "CASISIEMPRE") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(213 - 2, 630 - 2, 213 + 2, 630 + 2); // Primera línea diagonal
        pdf.line(213 - 2, 630 + 2, 213 + 2, 630 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(309 - 2, 630 - 2, 309 + 2, 630 + 2); // Primera línea diagonal
        pdf.line(309 - 2, 630 + 2, 309 + 2, 630 - 2); // Segunda línea diagonal
    }

    pdf.addPage();
    const image2 = await loadImage("N R-ITSZaS-8.5-17 Diagnostico original_page-0002.jpg"); 
    pdf.addImage(image2, 'PNG', 0, 0, 612, 792);
    pdf.setFontSize(9);

    pdf.text(lugarTrabajoConyuge, 315, 155);  // Ajusta las coordenadas
    pdf.text(puestoConyuge, 320, 167);  // Ajusta las coordenadas
    pdf.text(telefonoConyuge, 445, 167);  // Ajusta las coordenadas
    pdf.text(lugarTrabajo, 315, 299);  // Ajusta las coordenadas
    pdf.text(puesto, 320, 311);  // Ajusta las coordenadas
    pdf.text(telefonoTrabajo, 445, 311);  // Ajusta las coordenadas
    pdf.text(mayorConfianza, 333, 478);  // Ajusta las coordenadas
    pdf.text(mayorConfianzaNombre, 321, 491);  // Ajusta las coordenadas
    pdf.text(apellidoPaternoPadre, 286, 637);  // Ajusta las coordenadas
    pdf.text(apellidoMaternoPadre, 377, 637);  // Ajusta las coordenadas
    pdf.text(nombresPadre, 469, 637);  // Ajusta las coordenadas
    pdf.text(callePadre, 310, 661);  // Ajusta las coordenadas
    pdf.text(numeroPadre, 495, 661);  // Ajusta las coordenadas
    pdf.text(coloniaPadre, 320, 674);  // Ajusta las coordenadas
    pdf.text(ciudadPadre, 318, 686);  // Ajusta las coordenadas
    pdf.text(estadoPadre, 434, 686);  // Ajusta las coordenadas

    if (estadoCivil === "Casado(a)") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 90 - 2, 358 + 2, 90 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 90 + 2, 358 + 2, 90 - 2); // Segunda línea diagonal
    } else if (estadoCivil === "Unión libre") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 100 - 2, 358 + 2, 100 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 100 + 2, 358 + 2, 100 - 2); // Segunda línea diagonal
    } else if (estadoCivil === "Divorciado(a)") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 115 - 2, 358 + 2, 115 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 115 + 2, 358 + 2, 115 - 2); // Segunda línea diagonal
    } else if (estadoCivil === "Viudo(a)") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(486 - 2, 90 - 2, 486 + 2, 90 + 2); // Primera línea diagonal
        pdf.line(486 - 2, 90 + 2, 486 + 2, 90 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(486 - 2, 100 - 2, 486 + 2, 100 + 2); // Primera línea diagonal
        pdf.line(486 - 2, 100 + 2, 486 + 2, 100 - 2); // Segunda línea diagonal
    }

    if (numeroHijos === "Sin hijos(as)") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 126 - 2, 358 + 2, 126 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 126 + 2, 358 + 2, 126 - 2); // Segunda línea diagonal
    } else if (numeroHijos === "1 a 2") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(358 - 2, 140 - 2, 358 + 2, 140 + 2); // Primera línea diagonal
        pdf.line(358 - 2, 140 + 2, 358 + 2, 140 - 2); // Segunda línea diagonal
    } else if (numeroHijos === "3 a 4") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(490 - 2, 126 - 2, 490 + 2, 126 + 2); // Primera línea diagonal
        pdf.line(490 - 2, 126 + 2, 490 + 2, 126 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(490 - 2, 140 - 2, 490 + 2, 140 + 2); // Primera línea diagonal
        pdf.line(490 - 2, 140 + 2, 490 + 2, 140 - 2); // Segunda línea diagonal
    }

    if (trabajaConyuge === "No") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(210 - 2, 153 - 2, 210 + 2, 153 + 2); // Primera línea diagonal
        pdf.line(210 - 2, 153 + 2, 210 + 2, 153 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(208 - 2, 165 - 2, 208 + 2, 165 + 2); // Primera línea diagonal
        pdf.line(208 - 2, 165 + 2, 208 + 2, 165 - 2); // Segunda línea diagonal
    } 

    if (vivesCon === "Ambos padres") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(365 - 2, 190 - 2, 365 + 2, 190 + 2); // Primera línea diagonal
        pdf.line(365 - 2, 190 + 2, 365 + 2, 190 - 2); // Segunda línea diagonal
    } else if (vivesCon === "Con tu cónyuge") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(365 - 2, 204 - 2, 365 + 2, 204 + 2); // Primera línea diagonal
        pdf.line(365 - 2, 204 + 2, 365 + 2, 204 - 2); // Segunda línea diagonal
    } else if (vivesCon === "Padre o Madre") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(365 - 2, 217 - 2, 365 + 2, 217 + 2); // Primera línea diagonal
        pdf.line(365 - 2, 217 + 2, 365 + 2, 217 - 2); // Segunda línea diagonal
    } else if (vivesCon === "Familiares cercanos") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(483 - 2, 190 - 2, 483 + 2, 190 + 2); // Primera línea diagonal
        pdf.line(483 - 2, 190 + 2, 483 + 2, 190 - 2); // Segunda línea diagonal
    } else if (vivesCon === "Con amigos(as)") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(483 - 2, 204 - 2, 483 + 2, 204 + 2); // Primera línea diagonal
        pdf.line(483 - 2, 204 + 2, 483 + 2, 204 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(483 - 2, 217 - 2, 483 + 2, 217 + 2); // Primera línea diagonal
        pdf.line(483 - 2, 217 + 2, 483 + 2, 217 - 2); // Segunda línea diagonal
    } 

    if (vivirasCon === "Con mi familia") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(296 - 2, 262 - 2, 296 + 2, 262 + 2); // Primera línea diagonal
        pdf.line(296 - 2, 262 + 2, 296 + 2, 262 - 2); // Segunda línea diagonal
    } else if (vivirasCon === "Con familiares cercanos") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(364 - 2, 277 - 2, 364 + 2, 277 + 2); // Primera línea diagonal
        pdf.line(364 - 2, 277 + 2, 364 + 2, 277 - 2); // Segunda línea diagonal
    } else if (vivirasCon === "Con otros estudiantes") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(434 - 2, 262 - 2, 434 + 2, 262 + 2); // Primera línea diagonal
        pdf.line(434 - 2, 262 + 2, 434 + 2, 262 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(500 - 2, 245 - 2, 500 + 2, 245 + 2); // Primera línea diagonal
        pdf.line(500 - 2, 245 + 2, 500 + 2, 245 - 2); // Segunda línea diagonal
    }

    if (trabajas === "No") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(208 - 2, 297 - 2, 208 + 2, 297 + 2); // Primera línea diagonal
        pdf.line(208 - 2, 297 + 2, 208 + 2, 297 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(208 - 2, 310 - 2, 208 + 2, 310 + 2); // Primera línea diagonal
        pdf.line(208 - 2, 310 + 2, 208 + 2, 310 - 2); // Segunda línea diagonal
    }


    if (ingresoFamiliar === "Mas de $6000") {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 320; // Posición en el eje X
        const y = 335; // Posición en el eje Y
        const lineWidth = 80; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
        
    } else if (ingresoFamiliar === "Entre $4001 y $5000") {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 335; // Posición en el eje X
        const y = 347; // Posición en el eje Y
        const lineWidth = 110; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
    } else if (ingresoFamiliar === "Entre $3001 y $4000") {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 335; // Posición en el eje X
        const y = 361; // Posición en el eje Y
        const lineWidth = 110; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
    } else if (ingresoFamiliar === "Entre $2001 y $3000") {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 440; // Posición en el eje X
        const y = 335; // Posición en el eje Y
        const lineWidth = 110; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
    } else if (ingresoFamiliar === "Menos de $2000") {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 440; // Posición en el eje X
        const y = 347; // Posición en el eje Y
        const lineWidth = 80; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
    } else {
        pdf.setLineWidth(1); // Establece el grosor de línea a 2 puntos (ajusta según lo necesites)
        const x = 412; // Posición en el eje X
        const y = 361; // Posición en el eje Y
        const lineWidth = 25; // Tamaño de la línea (ajusta la longitud según lo necesites)
        pdf.line(x - lineWidth / 2, y, x + lineWidth / 2, y); // Línea horizontal centrada en la posición (x, y)
    } 

    if (personasDependen === "1 ó 2") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 372 - 2, 354 + 2, 372 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 372 + 2, 354 + 2, 372 - 2); // Segunda línea diagonal
        
    } else if (personasDependen === "3 ó 4") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 385 - 2, 354 + 2, 385 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 385 + 2, 354 + 2, 385 - 2); // Segunda línea diagonal
        
    } else if (personasDependen === "5 ó 6") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(485 - 2, 372 - 2, 485 + 2, 372 + 2); // Primera línea diagonal
        pdf.line(485 - 2, 372 + 2, 485 + 2, 372 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(485 - 2, 385 - 2, 485 + 2, 385 + 2); // Primera línea diagonal
        pdf.line(485 - 2, 385 + 2, 485 + 2, 385 - 2); // Segunda línea diagonal
    }

    if (conviveFamilia === "En la comida") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 398 - 2, 354 + 2, 398 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 398 + 2, 354 + 2, 398 - 2); // Segunda línea diagonal
        
    } else if (conviveFamilia === "En la cena") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 411 - 2, 354 + 2, 411 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 411 + 2, 354 + 2, 411 - 2); // Segunda línea diagonal
    } else if (conviveFamilia === "Viendo TV") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(484 - 2, 398 - 2, 484 + 2, 398 + 2); // Primera línea diagonal
        pdf.line(484 - 2, 398 + 2, 484 + 2, 398 - 2); // Segunda línea diagonal
    } else {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(484 - 2, 411 - 2, 484 + 2, 411 + 2); // Primera línea diagonal
        pdf.line(484 - 2, 411 + 2, 484 + 2, 411 - 2); // Segunda línea diagonal
    }

    if (esparcimientoLugares === "Cine") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 424 - 2, 354 + 2, 424 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 424 + 2, 354 + 2, 424 - 2); // Segunda línea diagonal
        
    } else if (esparcimientoLugares === "Parque") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 436 - 2, 354 + 2, 436 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 436 + 2, 354 + 2, 436 - 2); // Segunda línea diagonal
    } else if (esparcimientoLugares === "Con otros familiares") {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(483 - 2, 424 - 2, 483 + 2, 424 + 2); // Primera línea diagonal
        pdf.line(483 - 2, 424 + 2, 483 + 2, 424 - 2); // Segunda línea diagonal
    } else {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(483 - 2, 436 - 2, 483 + 2, 436 + 2); // Primera línea diagonal
        pdf.line(483 - 2, 436 + 2, 483 + 2, 436 - 2); // Segunda línea diagonal
    }

    if (comunicacionFamilia === "Buena") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(353 - 2, 450 - 2, 353 + 2, 450 + 2); // Primera línea diagonal
        pdf.line(353 - 2, 450 + 2, 353 + 2, 450 - 2); // Segunda línea diagonal
        
    } else if (comunicacionFamilia === "Regular") {
               pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(353 - 2, 462 - 2, 353 + 2, 462 + 2); // Primera línea diagonal
        pdf.line(353 - 2, 462 + 2, 353 + 2, 462 - 2); // Segunda línea diagonal
    } else {
                pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(482 - 2, 450 - 2, 482 + 2, 450 + 2); // Primera línea diagonal
        pdf.line(482 - 2, 450 + 2, 482 + 2, 450 - 2); // Segunda línea diagonal
    }

    if (tipoCasa === "Propia") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(354 - 2, 501 - 2, 354 + 2, 501 + 2); // Primera línea diagonal
    pdf.line(354 - 2, 501 + 2, 354 + 2, 501 - 2); // Segunda línea diagonal
    
    } else if (tipoCasa === "Prestada") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(354 - 2, 513 - 2, 354 + 2, 513 + 2); // Primera línea diagonal
    pdf.line(354 - 2, 513 + 2, 354 + 2, 513 - 2); // Segunda línea diagonal
    } else if (tipoCasa === "Rentada") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(500 - 2, 501 - 2, 500 + 2, 501 + 2); // Primera línea diagonal
    pdf.line(500 - 2, 501 + 2, 500 + 2, 501 - 2); // Segunda línea diagonal
    } else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(500 - 2, 513 - 2, 500 + 2, 513 + 2); // Primera línea diagonal
    pdf.line(500 - 2, 513 + 2, 500 + 2, 513 - 2); // Segunda línea diagonal
    }    

    if (materialesCasa === "Concreto totalmente") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(405 - 2, 527 - 2, 405 + 2, 527 + 2); // Primera línea diagonal
    pdf.line(405 - 2, 527 + 2, 405 + 2, 527 - 2); // Segunda línea diagonal
    
    } else if (materialesCasa === "Concreto y otros materiales") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(405 - 2, 539 - 2, 405 + 2, 539 + 2); // Primera línea diagonal
    pdf.line(405 - 2, 539 + 2, 405 + 2, 539 - 2); // Segunda línea diagonal
    } else if (materialesCasa === "Obra negra") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(406 - 2, 552 - 2, 406 + 2, 552 + 2); // Primera línea diagonal
    pdf.line(406 - 2, 552 + 2, 406 + 2, 552 - 2); // Segunda línea diagonal
    }else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(500 - 2, 527 - 2, 500 + 2, 527 + 2); // Primera línea diagonal
    pdf.line(500 - 2, 527 + 2, 500 + 2, 527 - 2); // Segunda línea diagonal
    }

    if (habitacionesCasa === "Mas de 6") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(354 - 2, 565 - 2, 354 + 2, 565 + 2); // Primera línea diagonal
    pdf.line(354 - 2, 565 + 2, 354 + 2, 565 - 2); // Segunda línea diagonal
    
    } else if (habitacionesCasa === "Entre 4 y 5") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(354 - 2, 577 - 2, 354 + 2, 577 + 2); // Primera línea diagonal
    pdf.line(354 - 2, 577 + 2, 354 + 2, 577 - 2); // Segunda línea diagonal
    } else if (habitacionesCasa === "Entre 2 y 3") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(486 - 2, 565 - 2, 486 + 2, 565 + 2); // Primera línea diagonal
    pdf.line(486 - 2, 565 + 2, 486 + 2, 565 - 2); // Segunda línea diagonal
    } else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(486 - 2, 578 - 2, 486 + 2, 578 + 2); // Primera línea diagonal
    pdf.line(486 - 2, 578 + 2, 486 + 2, 578 - 2); // Segunda línea diagonal
    }  
    
    if (estadoPadres === "Casados") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(352 - 2, 591 - 2, 352 + 2, 591 + 2); // Primera línea diagonal
    pdf.line(352 - 2, 591 + 2, 352 + 2, 591 - 2); // Segunda línea diagonal
    
    } else if (estadoPadres === "Unión libre") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(352 - 2, 603 - 2, 352 + 2, 603 + 2); // Primera línea diagonal
    pdf.line(352 - 2, 603 + 2, 352 + 2, 603 - 2); // Segunda línea diagonal
    } else if (estadoPadres === "Separados") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(352 - 2, 616 - 2, 352 + 2, 616 + 2); // Primera línea diagonal
    pdf.line(352 - 2, 616 + 2, 352 + 2, 616 - 2); // Segunda línea diagonal
    } else if (estadoPadres === "Padre viudo") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(486 - 2, 591 - 2, 486 + 2, 591 + 2); // Primera línea diagonal
    pdf.line(486 - 2, 591 + 2, 486 + 2, 591 - 2); // Segunda línea diagonal
    }else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(485 - 2, 603 - 2, 485 + 2, 603 + 2); // Primera línea diagonal
    pdf.line(485 - 2, 603 + 2, 485 + 2, 603 - 2); // Segunda línea diagonal
    }

    pdf.addPage();
    const image3 = await loadImage("N R-ITSZaS-8.5-17 Diagnostico original_page-0003.jpg"); 
    pdf.addImage(image3, 'PNG', 0, 0, 612, 792);
    pdf.setFontSize(9);

    pdf.text(telefonoPadre, 322, 66);  // Ajusta las coordenadas
    pdf.text(CiudadNacimientoPadre, 318, 87);  // Ajusta las coordenadas
    pdf.text(EstadoNacimientoPadre, 430, 87);  // Ajusta las coordenadas
    pdf.text(FechaNacimientoPadre, 374, 100);  // Ajusta las coordenadas
    pdf.text(lugarTrabajoPadre, 313, 163);  // Ajusta las coordenadas
    pdf.text(puestoTrabajoPadre, 318, 176);  // Ajusta las coordenadas
    pdf.text(telefonoTrabajoPadre, 455, 176);  // Ajusta las coordenadas
    pdf.text(apellidoPaternoMadre, 286, 231);  // Ajusta las coordenadas
    pdf.text(apellidoMaternoMadre, 377, 231);  // Ajusta las coordenadas
    pdf.text(nombresMadre, 469, 231);  // Ajusta las coordenadas
    pdf.text(calleMadre, 312, 256);  // Ajusta las coordenadas
    pdf.text(numeroMadre, 434, 256);  // Ajusta las coordenadas
    pdf.text(coloniaMadre, 320, 268);  // Ajusta las coordenadas
    pdf.text(ciudadMadre, 318, 281);  // Ajusta las coordenadas
    pdf.text(estadoMadre, 430, 281);  // Ajusta las coordenadas
    pdf.text(telefonoMadre, 323, 294);  // Ajusta las coordenadas
    pdf.text(CiudadNacimientoMadre, 318, 308);  // Ajusta las coordenadas
    pdf.text(EstadoNacimientoMadre, 426 , 308);  // Ajusta las coordenadas
    pdf.text(FechaNacimientoMadre, 374, 320);  // Ajusta las coordenadas
    pdf.text(lugarTrabajoMadre, 313, 371);  // Ajusta las coordenadas
    pdf.text(puestoTrabajoMadre, 318, 384);  // Ajusta las coordenadas
    pdf.text(telefonoTrabajoMadre, 455, 384);  // Ajusta las coordenadas

    const textoLargoApoyo = institucionApoyo;
    const anchoMaximoApoyo = 115; // Ancho máximo de la línea en puntos
    const coordenadaXApoyo = 423; // Coordenada X donde quieres que comience el texto
    const coordenadaYApoyo = 448; // Coordenada Y donde quieres que comience el texto

    const lineasDivididasApoyo = pdf.splitTextToSize(textoLargoApoyo, anchoMaximoApoyo);

    // Ahora, puedes iterar a través de las líneas divididas y agregarlas al PDF
    lineasDivididasApoyo.forEach((lineaApoyo, indiceApoyo) => {
        pdf.text(lineaApoyo, coordenadaXApoyo, coordenadaYApoyo + (indiceApoyo * 10)); // Ajusta el espacio vertical entre líneas según sea necesario
    });

    const textoLargoMonto = montoApoyoMensual;
    const anchoMaximoMonto = 80; // Ancho máximo de la línea en puntos
    const coordenadaXMonto = 457; // Coordenada X donde quieres que comience el texto
    const coordenadaYMonto = 486; // Coordenada Y donde quieres que comience el texto

    const lineasDivididasMonto = pdf.splitTextToSize(textoLargoMonto, anchoMaximoMonto);

    // Ahora, puedes iterar a través de las líneas divididas y agregarlas al PDF
    lineasDivididasMonto.forEach((lineaMonto, indiceMonto) => {
        pdf.text(lineaMonto, coordenadaXMonto, coordenadaYMonto + (indiceMonto * 10)); // Ajusta el espacio vertical entre líneas según sea necesario
    });

    pdf.text(metasCincoAnosTrabajo, 340, 540);  // Ajusta las coordenadas
    pdf.text(metasCincoAnosFamiliares, 337, 553);  // Ajusta las coordenadas
    pdf.text(metasCincoAnosPersonales, 340, 565);  // Ajusta las coordenadas
    pdf.text(metasCincoAnosAcademicas, 342, 577);  // Ajusta las coordenadas
    pdf.text(herramientasParaLograrMetasTrabajo, 346, 590);  // Ajusta las coordenadas
    pdf.text(herramientasParaLograrMetasFamilia, 345, 603);  // Ajusta las coordenadas
    pdf.text(herramientasParaLograrMetasPersonales, 340, 616);  // Ajusta las coordenadas
    pdf.text(herramientasParaLograrMetasAcademicas, 344 , 629);  // Ajusta las coordenadas
    pdf.text(obstaculosParaLograrMetasTrabajo, 345, 642);  // Ajusta las coordenadas
    pdf.text(obstaculosParaLograrMetasFamilia, 344, 655);  // Ajusta las coordenadas
    pdf.text(obstaculosParaLograrMetasPersonales, 339, 667);  // Ajusta las coordenadas
    pdf.text(obstaculosParaLograrMetasAcademicas, 342, 680);  // Ajusta las coordenadas

    if (gradoEstudiosPadre === "Licenciatura") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(378 - 2, 122 - 2, 378 + 2, 122 + 2); // Primera línea diagonal
        pdf.line(378 - 2, 122 + 2, 378 + 2, 122 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosPadre === "Bachillerato") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(378 - 2, 134 - 2, 378 + 2, 134 + 2); // Primera línea diagonal
        pdf.line(378 - 2, 134 + 2, 378 + 2, 134 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosPadre === "Técnico ó comercio") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(379 - 2, 147 - 2, 379 + 2, 147 + 2); // Primera línea diagonal
        pdf.line(379 - 2, 147 + 2, 379 + 2, 147 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosPadre === "Secundaria") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(489 - 2, 121 - 2, 489 + 2, 121 + 2); // Primera línea diagonal
        pdf.line(489 - 2, 121 + 2, 489 + 2, 121 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosPadre === "Primaria") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(489 - 2, 134 - 2, 489 + 2, 134 + 2); // Primera línea diagonal
        pdf.line(489 - 2, 134 + 2, 489 + 2, 134 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(488 - 2, 147 - 2, 488 + 2, 147 + 2); // Primera línea diagonal
        pdf.line(488 - 2, 147 + 2, 488 + 2, 147 - 2); // Segunda línea diagonal
    } 
    
    if (trabajoPadre === "No") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(195 - 2, 160 - 2, 195 + 2, 160 + 2); // Primera línea diagonal
        pdf.line(195 - 2, 160 + 2, 195 + 2, 160 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(195 - 2, 73 - 2, 195 + 2, 73 + 2); // Primera línea diagonal
        pdf.line(195 - 2, 73 + 2, 195 + 2, 73 - 2); // Segunda línea diagonal
    }

    if (servicioMedicoPadre === "Particular") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(349 - 2, 185 - 2, 349 + 2, 185 + 2); // Primera línea diagonal
    pdf.line(349 - 2, 185 + 2, 349 + 2, 185 - 2); // Segunda línea diagonal
    
    } else if (servicioMedicoPadre === "ISSSTE") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(350 - 2, 198 - 2, 350 + 2, 198 + 2); // Primera línea diagonal
    pdf.line(350 - 2, 198 + 2, 350 + 2, 198 - 2); // Segunda línea diagonal
    } else if (servicioMedicoPadre === "IMSS") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(350 - 2, 211 - 2, 350 + 2, 211 + 2); // Primera línea diagonal
    pdf.line(350 - 2, 211 + 2, 350 + 2, 211 - 2); // Segunda línea diagonal
    } else if (servicioMedicoPadre === "Seguro Popular") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(489 - 2, 185 - 2, 489 + 2, 185 + 2); // Primera línea diagonal
    pdf.line(489 - 2, 185 + 2, 489 + 2, 185 - 2); // Segunda línea diagonal
    }else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(489 - 2, 198 - 2, 489 + 2, 198 + 2); // Primera línea diagonal
    pdf.line(489 - 2, 198 + 2, 489 + 2, 198 - 2); // Segunda línea diagonal
    }

    if (gradoEstudiosMadre === "Licenciatura") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(380 - 2, 329 - 2, 380 + 2, 329 + 2); // Primera línea diagonal
        pdf.line(380 - 2, 329 + 2, 380 + 2, 329 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosMadre === "Bachillerato") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(380 - 2, 342 - 2, 380 + 2, 342 + 2); // Primera línea diagonal
        pdf.line(380 - 2, 342 + 2, 380 + 2, 342 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosMadre === "Técnico ó comercio") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(381 - 2, 355 - 2, 381 + 2, 355 + 2); // Primera línea diagonal
        pdf.line(381 - 2, 355 + 2, 381 + 2, 355 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosMadre === "Secundaria") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(470 - 2, 329 - 2, 470 + 2, 329 + 2); // Primera línea diagonal
        pdf.line(470 - 2, 329 + 2, 470 + 2, 329 - 2); // Segunda línea diagonal
    } else if (gradoEstudiosMadre === "Primaria") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(470 - 2, 342 - 2, 470 + 2, 342 + 2); // Primera línea diagonal
        pdf.line(470 - 2, 342 + 2, 470 + 2, 342 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(472 - 2, 355 - 2, 472 + 2, 355 + 2); // Primera línea diagonal
        pdf.line(472 - 2, 355 + 2, 472 + 2, 355 - 2); // Segunda línea diagonal
    }
    
    if (trabajoMadre === "No") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(197 - 2, 368 - 2, 197 + 2, 368 + 2); // Primera línea diagonal
        pdf.line(197 - 2, 368 + 2, 197 + 2, 368 - 2); // Segunda línea diagonal
    } else {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(197 - 2, 381 - 2, 197 + 2, 381 + 2); // Primera línea diagonal
        pdf.line(197 - 2, 381 + 2, 197 + 2, 381 - 2); // Segunda línea diagonal
    }

    if (servicioMedicoMadre === "Particular") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(345 - 2, 394 - 2, 345 + 2, 394 + 2); // Primera línea diagonal
    pdf.line(345 - 2, 394 + 2, 345 + 2, 394 - 2); // Segunda línea diagonal
    
    } else if (servicioMedicoMadre === "ISSSTE") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(346 - 2, 406 - 2, 346 + 2, 406 + 2); // Primera línea diagonal
    pdf.line(346 - 2, 406 + 2, 346 + 2, 406 - 2); // Segunda línea diagonal
    } else if (servicioMedicoMadre === "IMSS") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(346 - 2, 419 - 2, 346 + 2, 419 + 2); // Primera línea diagonal
    pdf.line(346 - 2, 419 + 2, 346 + 2, 419 - 2); // Segunda línea diagonal
    } else if (servicioMedicoMadre === "Seguro Popular") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(489 - 2, 394 - 2, 489 + 2, 394 + 2); // Primera línea diagonal
    pdf.line(489 - 2, 394 + 2, 489 + 2, 394 - 2); // Segunda línea diagonal
    }else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(489 - 2, 406 - 2, 489 + 2, 406 + 2); // Primera línea diagonal
    pdf.line(489 - 2, 406 + 2, 489 + 2, 406 - 2); // Segunda línea diagonal
    }

    if (apoyoEconomico === "Crédito educativo") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(381 - 2, 432 - 2, 381 + 2, 432 + 2); // Primera línea diagonal
    pdf.line(381 - 2, 432 + 2, 381 + 2, 432 - 2); // Segunda línea diagonal
    
    } else if (apoyoEconomico === "Beca") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(380 - 2, 445 - 2, 380 + 2, 445 + 2); // Primera línea diagonal
    pdf.line(380 - 2, 445 + 2, 380 + 2, 445 - 2); // Segunda línea diagonal
    } else if (apoyoEconomico === "De una empresa") {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(380 - 2, 485 - 2, 380 + 2, 485 + 2); // Primera línea diagonal
    pdf.line(380 - 2, 485 + 2, 380 + 2, 485 - 2); // Segunda línea diagonal
    } else if (apoyoEconomico === "Ninguno") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(380 - 2, 470 - 2, 380 + 2, 470 + 2); // Primera línea diagonal
    pdf.line(380 - 2, 470 + 2, 380 + 2, 470 - 2); // Segunda línea diagonal
    }else {
            pdf.setLineWidth(0.5); // Establece el grosor de línea
    pdf.line(380 - 2, 483 - 2, 380 + 2, 483 + 2); // Primera línea diagonal
    pdf.line(380 - 2, 483 + 2, 380 + 2, 483 - 2); // Segunda línea diagonal
    }

    if (motivosProgramaEstudioCheckboxes[0] === "Padres") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(355 - 2, 509 - 2, 355 + 2, 509 + 2); // Primera línea diagonal
        pdf.line(355 - 2, 509 + 2, 355 + 2, 509 - 2); // Segunda línea diagonal
    } if (motivosProgramaEstudioCheckboxes[1] === "Amigos(as)") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(354 - 2, 521 - 2, 354 + 2, 521 + 2); // Primera línea diagonal
        pdf.line(354 - 2, 521 + 2, 354 + 2, 521 - 2); // Segunda línea diagonal
    } if (motivosProgramaEstudioCheckboxes[2] === "Vocación") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(466 - 2, 509 - 2, 466 + 2, 509 + 2); // Primera línea diagonal
        pdf.line(466 - 2, 509 + 2, 466 + 2, 509 - 2); // Segunda línea diagonal
    } if (motivosProgramaEstudioCheckboxes[3] === "Otros") {
        pdf.setLineWidth(0.5); // Establece el grosor de línea
        pdf.line(467 - 2, 521 - 2, 467 + 2, 521 + 2); // Primera línea diagonal
        pdf.line(467 - 2, 521 + 2, 467 + 2, 521 - 2); // Segunda línea diagonal
    }
    
    pdf.addPage();
    const image4 = await loadImage("N R-ITSZaS-8.5-17 Diagnostico original_page-0004.jpg"); 
    pdf.addImage(image4, 'PNG', 0, 0, 612, 792);
    pdf.setFontSize(9);

    pdf.text(fechaAplicacion, 229 , 93);  // Ajusta las coordenadas
    pdf.text(nombreTutor, 237, 103);  // Ajusta las coordenadas
    pdf.text(cubiculo, 102, 116);  // Ajusta las coordenadas
    pdf.text(telefonoTutor, 293, 116);  // Ajusta las coordenadas
    pdf.text(observacionesRecomendaciones, 206, 143);  // Ajusta las coordenadas


    // Agregar la imagen al PDF si se proporcionó una
    if (imagenFile) {
        const imagenBase64 = await convertImageToBase64(imagenFile);
        pdf.addImage(imagenBase64, 'JPEG', 206, 174, 200, 60);
        pdf.text(cubiculo, 102, 116);  // Ajusta las coordenadas
    }

    if (imagenFile2) {
        const imagenBase64 = await convertImageToBase64(imagenFile);
        pdf.addImage(imagenBase64, 'JPEG', 206, 350, 200, 60);
        pdf.text(cubiculo, 102, 116);  // Ajusta las coordenadas
    }


    pdf.save("N R-ITSZaS-8.5-17 Diagnostico original.pdf");
}

// Función para convertir un archivo a base64
function fileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
    });
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
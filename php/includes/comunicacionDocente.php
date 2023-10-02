<div class="col">
    <form class="checklist" method="POST" action="">
        <input type="text" name="iddocente" style="display: none" value="<?php echo $id; ?>">
        <input type="text" name="idalumno" style="display: none" value="<?php echo $idsec; ?>">
        <input value="1" name="nombreProyecto" type="checkbox" id="01">
        <label for="01">Nombre del proyecto</label>
        <textarea name="comnombreProyecto" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <input value="1" name="empresa" type="checkbox" id="02">
        <label for="02">Empresa</label>
        <textarea name="comempresa" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <input value="1" name="objetivos" type="checkbox" id="03">
        <label for="03">Objetivos</label>
        <textarea name="comobjetivos" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <input value="1" name="justificacion" type="checkbox" id="04">
        <label for="04">Justificación</label>
        <textarea name="comjustificacion" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <input value="1" name="cronograma" type="checkbox" id="05">
        <label for="05">Cronograma de act.</label>
        <textarea name="comcronograma" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <input value="1" name="descripcion" type="checkbox" id="06">
        <label for="06">Descripción de act.</label>
        <textarea name="comdescripcion" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
        <button id="enviarFormulario">
            <div class="svg-wrapper-1">
                <div class="svg-wrapper">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                </svg>
                </div>
            </div>
            <span>Enviar</span>
        </button>
    </form>
</div>

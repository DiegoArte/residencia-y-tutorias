<?php

$revision=Revision::find("idalumno='$idsec' and iddocente='$id'");

$chats=Chat::find("(idinput='$id' and idaoutput='$idsec') or (idinput='$idsec' and idaoutput='$id')");

if(sizeof($revision)>0){
    $revision=$revision[0];
}

?>

<div class="col">
    <form class="checklist cajaRevision" method="POST" action="">
        <input type="text" name="iddocente" style="display: none" value="<?php echo $id; ?>">
        <input type="text" name="idalumno" style="display: none" value="<?php echo $idsec; ?>">
        <input value="1" name="nombreProyecto" type="checkbox" id="01" <?php if($revision->nombreProyecto==1){echo "checked";} ?>>
        <label for="01">Nombre del proyecto</label>
        <textarea name="comnombreProyecto" id="" cols="20" rows="2" placeholder="Escribe un comentario" ><?php echo $revision->comnombreProyecto ?></textarea>
        <input value="1" name="empresa" type="checkbox" id="02" <?php if($revision->empresa==1){echo "checked";} ?>>
        <label for="02">Empresa</label>
        <textarea name="comempresa" id="" cols="20" rows="2" placeholder="Escribe un comentario" ><?php echo $revision->comempresa ?></textarea>
        <input value="1" name="objetivos" type="checkbox" id="03" <?php if($revision->objetivos==1){echo "checked";} ?>>
        <label for="03">Objetivos</label>
        <textarea name="comobjetivos" id="" cols="20" rows="2" placeholder="Escribe un comentario" > <?php echo $revision->comobjetivos ?></textarea>
        <input value="1" name="justificacion" type="checkbox" id="04" <?php if($revision->justificacion==1){echo "checked";} ?>>
        <label for="04">Justificación</label>
        <textarea name="comjustificacion" id="" cols="20" rows="2" placeholder="Escribe un comentario" > <?php echo $revision->comjustificacion ?></textarea>
        <input value="1" name="cronograma" type="checkbox" id="05" <?php if($revision->cronograma==1){echo "checked";} ?>>
        <label for="05">Cronograma de act.</label>
        <textarea name="comcronograma" id="" cols="20" rows="2" placeholder="Escribe un comentario" ><?php echo $revision->comcronograma ?></textarea>
        <input value="1" name="descripcion" type="checkbox" id="06" <?php if($revision->descripcion==1){echo "checked";} ?>>
        <label for="06">Descripción de act.</label>
        <textarea name="comdescripcion" id="" cols="20" rows="2" placeholder="Escribe un comentario" ><?php echo $revision->comdescripcion ?></textarea>
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
        <?php if($revision->nombreProyecto==1 && $revision->empresa==1 && $revision->objetivos==1 && $revision->justificacion==1 && $revision->cronograma==1 && $revision->descripcion==1){
            ?>

            

            <?php
        } ?>
    </form>
</div>

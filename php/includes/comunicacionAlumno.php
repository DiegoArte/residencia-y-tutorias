<?php

$revision=Revision::find("idalumno='$id'");

$chats=Chat::find("idinput='$id' or idaoutput='$id'");
if(sizeof($revision)>0){
    $revision=$revision[0];
?>

<div class="col">
    <form class="checklist" method="POST" action="">
        <input name="nombreProyecto" type="checkbox" id="01" disabled <?php if($revision->nombreProyecto==1){echo "checked";} ?>>
        <label for="01">Nombre del proyecto</label>
        <textarea name="comnombreProyecto" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comnombreProyecto ?></textarea>
        <input name="empresa" type="checkbox" id="02" disabled <?php if($revision->empresa==1){echo "checked";} ?>>
        <label for="02">Empresa</label>
        <textarea name="comempresa" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comempresa ?></textarea>
        <input name="objetivos" type="checkbox" id="03" disabled <?php if($revision->objetivos==1){echo "checked";} ?>>
        <label for="03">Objetivos</label>
        <textarea name="comobjetivos" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comobjetivos ?></textarea>
        <input name="justificacion" type="checkbox" id="04" disabled <?php if($revision->justificacion==1){echo "checked";} ?>>
        <label for="04">Justificación</label>
        <textarea name="comjustificacion" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comjustificacion ?></textarea>
        <input name="cronograma" type="checkbox" id="05" disabled <?php if($revision->cronograma==1){echo "checked";} ?>>
        <label for="05">Cronograma de act.</label>
        <textarea name="comcronograma" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comcronograma ?></textarea>
        <input name="descripcion" type="checkbox" id="06" disabled <?php if($revision->descripcion==1){echo "checked";} ?>>
        <label for="06">Descripción de act.</label>
        <textarea name="comdescripcion" id="" cols="20" rows="2" placeholder="Escribe un comentario" disabled><?php echo $revision->comdescripcion ?></textarea>
    </form>
</div>

<?php
}
?>
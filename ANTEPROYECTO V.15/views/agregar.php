<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">
                    <?php
                    $consulta = mysqli_query($conexion, "SELECT * FROM alumnos WHERE NumerodeControl='$id'");
                    $alumno = mysqli_fetch_assoc($consulta);

                    $consulta_carreras = mysqli_query($conexion, "SELECT NombredeCarrera FROM carrera");


                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="idalumno" class="form-label">Id Alumno</label>
                                <input type="text" id="idalumno" name="idalumno" class="form-control" required readonly
                                    value="<?php echo $id; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombrealumno" class="form-label">Nombre alumno</label>
                                <input type="text" id="nombrealumno" name="nombrealumno" class="form-control" required
                                    readonly value="<?php echo $alumno['NombredelEstudiante']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombreproyecto" class="form-label">Nombre proyecto</label>
                                <input type="text" id="nombreproyecto" name="nombreproyecto" class="form-control"
                                    required readonly value="<?php echo $alumno['NombredelAnteproyecto']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="empresa" class="form-label">Empresa</label>
                            <input type="text" id="empresa" name="empresa" class="form-control">
                        </div>
                    </div>



                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Archivo (PDF)</label>
                        <input type="file" name="archivo" id="archivo" class="form-control">
                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editarSub<?php echo $data['idSubreceptor'];?>" tabindex="-1" aria-labelledby="editarSubLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editarSubLabel"> EDITAR SUBRECEPTOR </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 11px;">
                <form name="editarSub" id="editarSub" action="javascript: editarSubreceptor();" method="GET">
                    <div class="row">
                    <?php
                            $id = $data['idSubreceptor'];
                            $sql2 = "SELECT * FROM subreceptor WHERE idSubreceptor = $id";
                            $consulta2 = mysqli_query($enlace,$sql2);
                            while ($fila = mysqli_fetch_assoc($consulta2)){
                            ?>
                        <div class="form-group input-group-sm col-sm-4">
                            <label class="form-label">Codigo:</label>
                            <input type="text" name="ecodigo" id="ecodigo" value="<?php echo $fila['codigo'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-8">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="enombre" id="enombre" value="<?php echo $fila['nombre'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon natural:</label>
                            <input type="number" min="0" name="ecnatural" id="ecnatural" value="<?php echo $fila['enatural'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon sabor:</label>
                            <input type="number" min="0" name="ecsabor" id="ecsabor" value="<?php echo $fila['esabor'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Condon femenino:</label>
                            <input type="number" min="0" name="ecfemenino" id="ecfemenino" value="<?php echo $fila['efemenino'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">Lubricante:</label>
                            <input type="number" min="0" name="elubricante" id="elubricante" value="<?php echo $fila['elubricante'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="epruebavih" id="epruebavih" value="<?php echo $fila['ppvih'];?>" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label">% Auto-prueba VIH:</label>
                            <input type="number" min="0" max="1" step="0.01" name="eautoprueba" id="eautoprueba" value="<?php echo $fila['pautoprueba'];?>" class="form-control form-control-sm" required>
                        </div>
                        <?php }?>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Guardar" class="btn btn-outline-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
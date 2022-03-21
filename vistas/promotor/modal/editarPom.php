<div class="modal fade" id="modalEditarPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:dodgerblue;">
                <h5 class="modal-title">Editar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <form name="editarPom" id="editarPom" action="javascript: editarPOM();" method="POST">

                            <input type="hidden" name="esubreceptor" id="esubreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                            <input type="hidden" name="eusuario" id="eusuario" value="<?php echo $ID; ?>">
                            <input type="hidden" name="epom" id="epom">
                            <input type="hidden" name="epoa" id="epoa">

                            <div class="card text-dark">
                                <div class="text-white text-center" style="background-color:dodgerblue;">DATOS PRINCIPALES</div>
                                <div class="card-body" style="font-size: 11px; background-color:aliceblue;">
                                    <div class="row">
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Periodo:</label>
                                            <input type="text" id="eperiodo" name="eperiodo" class="form-control" disabled>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Mes:</label>
                                            <input type="hidden" name="emes" id="emes">
                                            <input type="text" name="rmes" id="rmes" class="form-control" disabled>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-6">
                                            <label class="form-label">Municipio:</label>
                                            <input type="hidden" name="emunicipio" id="emunicipio">
                                            <input type="text" name="rmunicipio" id="rmunicipio" class="form-control" disabled>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-6">
                                            <label class="form-label">Fecha:</label>
                                            <input type="date" name="efecha" id="efecha" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Inicio:</label>
                                            <input type="time" name="einicio" id="einicio" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-3">
                                            <label class="form-label">Fin:</label>
                                            <input type="time" name="efin" id="efin" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="form-group input-group-sm col-sm-12">
                                            <label class="form-label">Lugar:</label>
                                            <input type="text" name="elugar" id="elugar" class="form-control form-control-sm" style="font-size:12px;" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card text-dark">
                            <div class="text-white text-center" style="background-color:dodgerblue;">PROYECCIÓN DE INSUMOS</div>
                            <div class="card-body" style="font-size: 11px; background-color:aliceblue;">
                                <div class="row">

                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label" style="font-size: 12px;">Promotor responsable:</label>
                                        <?php
                                        $consultaPro = "SELECT DISTINCT t2.nombre AS nombres, t2.apellido AS apellidos, t3.idPromotor FROM usuario t1 
                                        LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id 
                                        LEFT JOIN promotor t3 ON t3.persona_id = t1.persona_id
                                        WHERE t1.idUsuario = $ID";
                                        $resultadoPro = $enlace->query($consultaPro);
                                        while ($promotor = $resultadoPro->fetch_assoc()) {
                                        ?>
                                            <input type="hidden" name="epromotores" id="epromotores" value="<?php echo $promotor['idPromotor']; ?>">
                                            <input type="text" value="<?php echo $promotor['nombres'] . ' ' . $promotor['apellidos']; ?>" class="form-control form-control-sm" disabled>
                                        <?php }
                                        $resultadoPro->close(); ?>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Nuevos</label>
                                        <input type="number" min="0.00" step="0.01" name="enuevo" id="enuevo" oninput="sumarPomEditar();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Recurrentes</label>
                                        <input type="number" min="0.00" step="0.01" name="erecurrente" id="erecurrente" oninput="sumarPomEditar();" onchange="obtenerReactivoEditar();" class="form-control form-control-sm" style="font-size: 12px;" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Total</label>
                                        <input type="text" name="etotal" id="etotal" class="form-control form-control-sm" disabled style="color:orangered;">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Proyeccion</label> <br>
                                        <button type="button" class="btn btn-outline-info" onclick="calcularPomEditar();"><em class="bi bi-calculator-fill"></em> Calcular</button>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon natural</label>
                                        <input type="text" name="ecnatural" id="ecnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon sabor</label>
                                        <input type="text" name="ecsabor" id="ecsabor" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Condon femenino</label>
                                        <input type="text" name="ecfemenino" id="ecfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Lubricante</label>
                                        <input type="text" name="elubricante" id="elubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Prueba VIH</label>
                                        <input type="text" name="epruebaVIH" id="epruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Autoprueba VIH</label>
                                        <input type="text" name="eautoPrueba" id="eautoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Reactivo esperado
                                        </label>
                                        <input type="hidden" name="ereactivo" id="ereactivo">
                                        <div class="position-relative">
                                            <input type="text" name="ereactivoEs" id="ereactivoEs" class="form-control form-control-sm" style="color:blue" disabled>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="eporcentaje">
                                        </div>
                                        </span>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Prueba sifilis</label>
                                        <input type="text" name="esifilis" id="esifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Observaciones / otros</label>
                                        <input type="text" name="eobservacion" id="eobservacion" class="form-control form-control-sm">
                                    </div>
                                    <input type="hidden" name="esupervisado" id="esupervisado" value="0">
                                    <input type="hidden" name="esupervisor" id="esupervisor" value="">
                                    <input type="hidden" name="emovil" id="emovil" value="0">

                                    <div class="form-group input-group-sm col-sm-5">
                                        <br>
                                        <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Está seguro que desea editar el POM?')">
                                            <em class="bi bi-arrow-clockwise"></em> Actualizar</button>
                                        <button type="reset" class="btn btn-sm btn-outline-danger">
                                            <em class="bi bi-x-circle"></em> Cancelar</button>
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-dismiss="modal">
                                            <em class="bi bi-x"></em> Cerrar</button>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
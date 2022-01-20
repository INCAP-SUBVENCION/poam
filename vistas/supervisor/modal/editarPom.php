<div class="modal fade" id="modalEditarPom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:dodgerblue;">
                <h5 class="modal-title">Editar POM</h5>
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
                                        <label class="form-label">Promotor responsable:</label>
                                        <select name="epromotores" id="epromotores" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            <option value="">Seleccionar..</option>
                                            <?php
                                            $resultado = $enlace->query("SELECT DISTINCT t3.idPromotor, t4.nombre, t4.apellido FROM asignacion t1 
                                                LEFT JOIN cobertura t2 ON t2.idCobertura=t1.cobertura_id 
                                                LEFT JOIN promotor t3 ON t3.idPromotor=t1.promotor_id
                                                LEFT JOIN persona t4 ON t4.idPersona=t3.persona_id 
                                                WHERE t2.subreceptor_id = $SUBRECEPTOR 
                                                GROUP BY t3.idPromotor, t4.nombre, t4.apellido");
                                            while ($prom = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $prom['idPromotor']; ?>"><?php echo $prom['nombre'] . ' ' . $prom['apellido']; ?></option>
                                            <?php }
                                            $resultado->close();
                                            ?>
                                        </select>
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
                                    <div class="form-group input-group-sm col-sm-1 text-center">
                                        <label class="form-label" style="font-size: 9px;">Supervisado</label>
                                        <select name="esupervisado" id="esupervisado" class="form-select" style="font-size: 10px;">
                                            <option value="0">NO</option>
                                            <option value="1">SI</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Nombre del Supervisor:</label>
                                        <input type="text" name="esupervisor" id="esupervisor" style="font-size: 10px;" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-1 text-center">
                                        <label class="form-label" style="font-size: 10px;">Unidad</label>
                                        <select name="emovil" id="emovil" class="form-select" style="font-size: 10px;">
                                            <option value="0">NO</option>
                                            <option value="1">SI</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Está seguro que desea editar el POM?')">
                                    <em class="bi bi-arrow-clockwise"></em> Actualizar </button>
                                <button type="reset" class="btn btn-sm btn-outline-danger">
                                    <em class="bi bi-x-circle"></em> Cancelar</button>
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-dismiss="modal">
                                    <em class="bi bi-x"></em> Cerrar</button>
                            </div>
                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
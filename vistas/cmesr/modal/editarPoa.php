<div class="modal fade" id="modalEditarPoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center">Editar POA</h5>
                <table class="table table-hover table-bordered" aria-describedby="">
                    <thead class="text-center" style="font-size: 10px;">
                        <th scope="">Mes</th>
                        <th scope="">Municipio</th>
                        <th scope="">Nuevos</th>
                        <th scope="">Recurrentes</th>
                        <th scope="">Total</th>
                        <th scope="">Condon natural</th>
                        <th scope="">Condon sabor</th>
                        <th scope="">Condon femenino</th>
                        <th scope="">Lubricantes</th>
                        <th scope="">Tamizaje</th>
                        <th scope="">Reactivos esperados</th>
                        <th scope="">Prueba Sifilis</th>
                    </thead>
                    <tbody class="text-center bg-light" style="font-size: 12px; color:brown;">
                        <td><strong id="_mes"></strong></td>
                        <td><strong id="_municipio"></strong></td>
                        <td><strong id="_nuevo"></strong></td>
                        <td><strong id="_recurrente"></strong></td>
                        <td><strong id="_total"></strong></td>
                        <td><strong id="_natural"></strong></td>
                        <td><strong id="_sabor"></strong></td>
                        <td><strong id="_femenino"></strong></td>
                        <td><strong id="_lubricante"></strong></td>
                        <td><strong id="_prueba"></strong></td>
                        <td><strong id="_reactivo"></strong></td>
                        <td><strong id="_sifilis"></strong></td>
                    </tbody>

                </table>
                <div class="row">
                    <form name="agregarPoas_1" id="agregarPoas_1" action="javascript: editarPoa();" method="POST">

                        <!--ID POA E INSUMOS--->
                        <input type="hidden" name="poa" id="poa">
                        <input type="hidden" name="insumo" id="insumo">
                        
                        <input type="hidden" name="esubreceptor" id="esubreceptor" value="<?php echo $SUBRECEPTOR; ?>">
                        <input type="hidden" name="eusuario" id="eusuario" value="<?php echo $ID; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card text-dark">
                                    <div class="text-white text-center" style="background-color:darkblue;">DATOS PRINCIPALES</div>
                                    <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                        <div class="row">
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Periodo:</label>
                                                <select name="eperiodo" id="eperiodo" class="form-select" style="font-size: 12px;" onchange="periodo_mes_editar();" required>
                                                    <option value="">Seleccionar ...</option>
                                                    <option value="3">Periodo III</option>
                                                    <option value="4">Periodo IV</option>
                                                    <option value="5">Periodo V</option>
                                                    <option value="6">Periodo VI</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Mes:</label>
                                                <select name="emes" id="emes" class="form-select" style="font-size: 12px;" required>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Departamento:</label>
                                                <select name="edepartamento" id="edepartamento" onchange="llenarMunicipioCobertura_editar();" class="form-select" style="font-size: 12px;" required>
                                                    <option value="">Seleccionar...</option>
                                                    <?php
                                                    $cd = "SELECT t2.codigo as id, t2.nombre as departamento FROM cobertura t1
                                                            LEFT JOIN catalogo t2 ON t2.codigo = t1.departamento
                                                            LEFT JOIN catalogo t3 ON t3.codigo = t1.municipio
                                                            LEFT JOIN subreceptor t4 ON t4.idSubreceptor = t1.subreceptor_id
                                                            WHERE t1.subreceptor_id = $SUBRECEPTOR GROUP BY t1.departamento";
                                                    $rd = $enlace->query($cd);
                                                    while ($departamento = $rd->fetch_assoc()) { ?>
                                                        <option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['departamento'] ?></option>
                                                    <?php }
                                                    $rd->close(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-4">
                                                <label class="form-label">Municipio:</label>
                                                <select id="emunicipio" name="emunicipio" class="form-select" onchange="calculos_editar();" style="font-size: 12px;" required></select>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Nuevos</label>
                                                <input type="text" name="enuevo" id="enuevo" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Recurrentes</label>
                                                <input type="text" name="erecurrente" id="erecurrente" class="form-control form-control-sm" style="font-size: 12px;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Proyeccion</label>
                                                <button type="button" class="btn btn-outline-info" onclick="calcularProyeccionPOA_editar();">Calcular</button>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Total</label>
                                                <input type="text" name="etotal" id="etotal" class="form-control form-control-sm" disabled style="color:orangered;" required>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-4">
                                                <label for="exampleFormControlTextarea1" class="form-label">Observaciones / otros</label>
                                                <input type="text" name="eobservacion" id="eobservacion" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-dark">
                                    <div class="text-white text-center" style="background-color:darkblue;">PROYECCION DE INSUMOS</div>
                                    <div class="card-body" style="font-size: 12px; background-color:aliceblue;">
                                        <div class="row">
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Condon natural</label>
                                                <input type="text" name="ecnatural" id="ecnatural" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Condon sabor</label>
                                                <input type="text" name="ecsabor" id="ecsabor" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Condon femenino</label>
                                                <input type="text" name="ecfemenino" id="ecfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Lubricante</label>
                                                <input type="text" name="elubricante" id="elubricante" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Tamizaje</label>
                                                <input type="text" step="0.0000" name="epruebaVIH" id="epruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                                <input type="hidden" step="0.0000" name="eautoPrueba" id="eautoPrueba">
                                            <div class="form-group input-group-sm col-sm-3">
                                                <label class="form-label">Reactivo esperado
                                                </label>
                                                <input type="hidden" name="ereactivo" id="ereactivo">
                                                <div class="position-relative">
                                                    <input type="text" step="0.0000" step="0.01" name="ereactivoEs" id="ereactivoEs" class="form-control form-control-sm" disabled>
                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="eporcentaje">
                                                </div>
                                                </span>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2">
                                                <label class="form-label">Prueba sifilis</label>
                                                <input type="text" name="esifilis" id="esifilis" class="form-control form-control-sm" style="color:blue" disabled>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2 text-center">
                                                <br>
                                                <button type="submit" class="btn btn-outline-info" onclick="return confirm('¿Está seguro que desea guardar?')">
                                                    Actualizar</button>
                                            </div>
                                            <div class="form-group input-group-sm col-sm-2 text-center">
                                                <br>
                                                <button type="reset" class="btn btn-sm btn-outline-danger">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>
</div>
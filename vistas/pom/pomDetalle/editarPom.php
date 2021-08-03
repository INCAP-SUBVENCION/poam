<div class="row">
    <div class="col-md-4">
        <?php
        $sqlEdit = "SELECT DISTINCT t2.idPom, t2.periodo, t3.nombre AS mes, t4.nombre AS municipio, t2.lugar, t2.fecha, t2.horaInicio, t2.horaFin, t5.codigo,
                    CONCAT(t6.nombre, ' ', t6.apellido) as nombres, t2.pNuevo, t2.pRecurrente, (t2.pNuevo + t2.pRecurrente) as total, t2.cnatural, t2.csabor,
                    t2.cfemenino, t2.lubricante, t2.pruebaVIH, t2.autoprueba, t2.reactivo, t2.sifilis, t2.observacion, t1.estado, t7.subreceptor_id FROM estado t1
                    LEFT JOIN pom t2 ON t2.idPom = t1.pom_id
                    LEFT JOIN catalogo t3 ON t3.codigo = t2.mes
                    LEFT JOIN catalogo t4 ON t4.codigo = t2.municipio
                    LEFT JOIN promotor t5 ON t5.idPromotor = t2.promotor_id
                    LEFT JOIN persona t6 ON t6.idPersona = t5.persona_id
                    LEFT JOIN poa t7 ON t7.idPoa = t1.poa_id
                    WHERE t2.periodo=1 AND t7.subreceptor_id = 1 AND t2.idPom =1";
        $edita = $enlace->query($sqlEdit);
        while ($editar = $edita->fetch_assoc()) {
        ?>
            <form name="agregarPom" id="agregarPom" action="javascript: abc();" method="GET">
                <input type="hidden" name="subreceptor" id="subreceptor" value="<?php echo $editar['subreceptor_id']; ?>">
                <input type="hidden" name="descripcion" id="descripcion" value="El Plan Operativo Mensual ha sido creado con exito">
                <div class="card text-dark">
                    <div class="bg-info text-center">DATOS PRINCIPALES</div>
                    <div class="card-body bg-light-warning" style="font-size: 12px; ">
                        <div class="row">
                            <div class="form-group input-group-sm col-sm-3">
                                <label class="form-label">Periodo:</label>
                                <input type="text" name="periodo" id="periodo" class="form-control" value="<?php echo $editar['periodo']; ?>" disabled>
                            </div>
                            <div class="form-group input-group-sm col-sm-3">
                                <label class="form-label">Mes:</label>
                                <input type="text" name="nombreMes" id="nombreMes" class="form-control" value="<?php echo $editar['mes']; ?>" disabled>
                                <input type="hidden" name="mes" id="mes">
                            </div>
                            <div class="form-group input-group-sm col-sm-6">
                                <label class="form-label">Municipio:</label>
                                <input type="text" name="nombreMunicipio" id="nombreMunicipio" class="form-control" value="<?php echo $editar['municipio']; ?>" disabled>
                                <input type="hidden" name="municipio" id="municipio">
                            </div>
                            <div class="form-group input-group-sm col-sm-6">
                                <label class="form-label">Fecha:</label>
                                <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" value="<?php echo $editar['fecha']; ?>" required>
                            </div>
                            <div class="form-group input-group-sm col-sm-3">
                                <label class="form-label">Inicio:</label>
                                <input type="time" name="inicio" id="inicio" class="form-control form-control-sm" value="<?php echo $editar['horaInicio']; ?>" required>
                            </div>
                            <div class="form-group input-group-sm col-sm-3">
                                <label class="form-label">Fin:</label>
                                <input type="time" name="fin" id="fin" class="form-control form-control-sm" value="<?php echo $editar['horaFin']; ?>" required>
                            </div>
                            <div class="form-group input-group-sm col-sm-12">
                                <label class="form-label">Lugar:</label>
                                <input type="text" name="lugar" id="lugar" class="form-control form-control-sm" style="font-size:12px;" value="<?php echo $editar['lugar']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-md-8">
        <div class="card text-dark">
            <div class="bg-info text-center">PROYECCIÓN DE INSUMOS</div>
            <div class="card-body bg-light-warning" style="font-size: 12px;">
                <div class="row">
                    <div class="form-group input-group-sm col-sm-4">
                        <label for="exampleFormControlTextarea1" class="form-label" style="font-size: 12px;">Promotor responsable:</label>
                        <select name="promotor" id="promotor" class="form-control" style="font-size: 12px;" required>
                            <option value="<?php echo $editar['codigo']; ?>"><?php echo $editar['nombres']; ?></option>
                            <?php
                            $consultaS = "SELECT DISTINCT t1.idPromotor, concat(t2.nombre, ' ', t2.apellido) as nombre FROM promotor t1
                                            LEFT JOIN persona t2 ON t2.idPersona = t1.persona_id
                                            LEFT JOIN cobertura t3 ON t3.idCobertura=t1.cobertura_id
                                            WHERE t3.subreceptor_id = $SUBRECEPTOR";
                            $resultadoS = $enlace->query($consultaS);
                            while ($subreceptor = $resultadoS->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $subreceptor['idPromotor'] ?>"><?php echo $subreceptor['nombre'] ?></option>
                            <?php
                            }
                            $resultadoS->close();
                            ?>
                        </select>
                    </div>

                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Nuevos</label>
                        <input type="number" min="0.00" step="0.0001" name="nuevo" id="nuevo" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" value="<?php echo $editar['pNuevo']; ?>" required>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Recurrentes</label>
                        <input type="number" min="0" step="0.0001" name="recurrente" id="recurrente" oninput="sumarPom();" class="form-control form-control-sm" style="font-size: 12px;" value="<?php echo $editar['pRecurrente']; ?>" required>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Total</label>
                        <input type="text" name="total" id="total" class="form-control form-control-sm" disabled style="color:orangered;">
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Proyeccion</label>
                        <button type="button" class="btn btn-outline-info" onclick="calcularPom();"><i class="bi bi-calculator-fill"></i> Calcular</button>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Condon natural</label>
                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Condon sabor</label>
                        <input type="text" name="csabor" id="csabor" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Condon femenino</label>
                        <input type="text" name="cfemenino" id="cfemenino" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Lubricante</label>
                        <input type="text" name="lubricante" id="lubricante" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Prueba VIH</label>
                        <input type="text" name="pruebaVIH" id="pruebaVIH" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Autoprueba VIH</label>
                        <input type="text" name="autoPrueba" id="autoPrueba" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Reactivo esperado
                        </label>
                        <input type="hidden" name="reactivo" id="reactivo">
                        <div class="position-relative">
                            <input type="text" name="reactivoEs" id="reactivoEs" class="form-control form-control-sm" style="color:blue" disabled>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="porcentaje">
                        </div>
                        </span>
                    </div>
                    <div class="form-group input-group-sm col-sm-2">
                        <label class="form-label">Prueba sifilis</label>
                        <input type="text" name="sifilis" id="sifilis" class="form-control form-control-sm" style="color:blue" disabled>
                    </div>
                    <div class="form-group input-group-sm col-sm-5">
                        <label class="form-label">Observaciones / otros</label>
                        <input type="text" name="observacion" id="observacion" class="form-control form-control-sm" value="<?php echo $editar['observacion']; ?>">
                    </div>
                    <div class="form-group input-group-sm col-sm-3">
                        <br>
                        <button type="submit" class="btn btn-outline-success" onclick="return confirm('¿Está seguro que desea guardar?')">
                            <i class="bi bi-check-square-fill"></i> Guardar</button>
                        <button type="reset" class="btn btn-outline-danger"> <i class="bi bi-x-square-fill"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
<?php } ?>


</div>
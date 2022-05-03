<div class="modal fade" id="modalSupervisar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Supervisar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered" aria-describedby="">
                    <thead class="text-center" style="font-size: 11px;">
                        <th scope="">Periodo</th>
                        <th scope="">Mes</th>
                        <th scope="">Municipio</th>
                        <th scope="">Lugar</th>
                        <th scope="">Fecha</th>
                        <th scope="">Inicia</th>
                        <th scope="">Finaliza</th>
                        <th scope="">Nuevos</th>
                        <th scope="">Recurrentes</th>
                        <th scope="">Total</th>
                        <th scope="">Promotor</th>
                    </thead>
                    <tbody class="text-center bg-light" style="font-size: 12px; color:darkblue;">
                        <td><strong id="_periodo"></strong></td>
                        <td><strong id="_mes"></strong></td>
                        <td><strong id="_municipio"></strong></td>
                        <td><strong id="_lugar"></strong></td>
                        <td><strong id="_fecha"></strong></td>
                        <td><strong id="_inicia"></strong></td>
                        <td><strong id="_finaliza"></strong></td>
                        <td><strong id="_nuevo"></strong></td>
                        <td><strong id="_recurrente"></strong></td>
                        <td><strong id="_total"></strong></td>
                        <td><strong id="_promotor"></strong></td>
                    </tbody>

                </table>

                <form name="agregarSupervision" id="agregarSupervision" action="javascript: supervisarActividad();" method="POST">
                    <div class="row">
                        <input type="hidden" id="pom">
                        <input type="hidden" id="sup" value="<?php echo $ID; ?>">
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label" style="font-size: 12px;">Tipo de supervision:</label>
                            <select id="tipo" class="form-control form-control-sm">
                                <option value="">Seleccionar</option>
                                <option value="1">Presencial</option>
                                <option value="0">Remota</option>
                            </select>
                        </div>
                        <div class="form-group input-group-sm col-sm-2">
                            <label class="form-label" style="font-size: 12px;">Hora:</label>
                            <input type="time" id="hora" class="form-control form-control-sm">
                        </div>
                        <div class="form-group input-group-sm col-sm-8">
                            <label class="form-label" style="font-size: 12px;">Observacion:</label>
                            <textarea id="obs" cols="3" rows="1" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary btn-sm">Cancelar</button>
                <button type="submit" class="btn btn-info btn-sm">Supervisar</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
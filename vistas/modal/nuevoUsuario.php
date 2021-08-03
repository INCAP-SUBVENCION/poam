<div class="modal fade" id="nuevoUsuario" tabindex="-1" aria-labelledby="nuevoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="nuevoUsuarioLabel">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="agregarPoa" id="agregarPoa" action="prog.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card-header">DATOS PRINCIPALES</div>
                            <div class="card-body" style="font-size: 12px;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Tipo documento:</label>
                                        <select name="documento" id="documento" class="form-control form-control-sm">
                                            <option value="">Seleccionar...</option>
                                            <option value="1">DPI</option>
                                            <option value="0">Pasaporte</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label"># Documento:</label>
                                        <input type="text" name="numero" id="numero" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Primer nombre:</label>
                                        <input type="text" name="pnombre" id="pnombre" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Segundo nombre:</label>
                                        <input type="text" name="snombre" id="snombre" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Primer apellido:</label>
                                        <input type="text" name="papellido" id="papellido" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Segundo apellido:</label>
                                        <input type="text" name="sapellido" id="sapellido" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-6">
                                        <label class="form-label">Direccion:</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Telefono:</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-5">
                                        <label class="form-label">Correo:</label>
                                        <input type="text" name="correo" id="correo" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Rol:</label>
                                        <select name="rol" id="rol" class="form-control form-control-sm" required>
                                            <option value="">Seleccionar..</option>
                                            <?php
                                            $resultado = $enlace->query("SELECT codigo, nombre FROM catalogo WHERE codigo NOT IN(SELECT codigo FROM catalogo WHERE codigo = 'R007') AND categoria='rol'");
                                            while ($rol = $resultado->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rol['codigo'] ?>"><?php echo $rol['nombre'] ?></option>
                                            <?php
                                            }
                                            $resultado->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card-header">PERMISOS</div>
                            <div class="card-body" style="font-size: 10px;">
                                <div class="row">
                                    <table class="table-sm">
                                        <tr>
                                            <td><label>Agregar</label></td>
                                            <td> <select name="agregar" id="agregar">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                            <td><label>Gestionar Usuarios</label></td>
                                            <td> <select name="metas" id="metas">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Editar</label></td>
                                            <td> <select name="editar" id="editar">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                            <td><label>Gestionar POA</label></td>
                                            <td> <select name="poas" id="poas">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Gestionar Subreceptores</label></td>
                                            <td> <select name="subreceptores" id="subreceptores">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                            <td><label>Gestionar POM</label></td>
                                            <td> <select name="poms" id="poms">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Gestionar Coberturas</label></td>
                                            <td> <select name="coberturas" id="coberturas">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                            <td><label>Gestionar Promotores</label></td>
                                            <td> <select name="promotores" id="promotores">
                                                    <option value="1">Permitido</option>
                                                    <option value="0">No permitido</option>
                                                </select> </td>
                                        </tr>

                                    </table>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-plus-circle-fill"></i> Guardar</button>
                        <button type="reset" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
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
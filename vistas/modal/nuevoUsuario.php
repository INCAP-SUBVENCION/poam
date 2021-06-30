<div class="modal fade" id="nuevoUsuario" tabindex="-1" aria-labelledby="nuevoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="nuevoUsuarioLabel">Nuevo usuario - <?php echo $anio = date("Y") ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="agregarPoa" id="agregarPoa" action="javascript: agregarPoa();" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card-header">DATOS PRINCIPALES</div>
                            <div class="card-body" style="font-size: 12px;">
                                <div class="row">
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Tipo documento:</label>
                                        <select name="documento" id="documento" class="form-control form-control-sm">
                                            <option value="">Seleccionar...</option>
                                            <option value="1">DPI</option>
                                            <option value="0">Pasaporte</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label"># Documento:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-4">
                                        <label class="form-label">Nombre:</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Apellido:</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-5">
                                        <label class="form-label">Direccion:</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-2">
                                        <label class="form-label">Telefono:</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-5">
                                        <label class="form-label">Correo:</label>
                                        <input type="text" name="cnatural" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Rol:</label>
                                        <select name="rol" id="rol" class="form-control form-control-sm" required>
                                            <option value="">Seleccionar..</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Subreceptor:</label>
                                        <select name="rol" id="rol" class="form-control form-control-sm" required>
                                            <option value="">Seleccionar..</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Contraseña:</label>
                                        <input type="password" name="pass1" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group input-group-sm col-sm-3">
                                        <label class="form-label">Confirmar:</label>
                                        <input type="password" name="pass2" id="cnatural" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-header">PERMISOS</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invitado" name="invitado">
                                        <label class="form-check-label" for="invitado">Solo invitado</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="usuario" name="usuario">
                                        <label class="form-check-label" for="usuario">Gestionar usuarios</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="subreceptor" name="subreceptor">
                                        <label class="form-check-label" for="subreceptor">Gestionar subreceptores</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="promotor" name="promotor">
                                        <label class="form-check-label" for="promotor">Gestionar de promotores</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="poa" name="poa">
                                        <label class="form-check-label" for="poa">Gestionar POA</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="pom" name="pom">
                                        <label class="form-check-label" for="pom">Gestionar POM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="catalogo" name="catalogo">
                                        <label class="form-check-label" for="catalogo">Gestionar Catalogo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="reset" value="Cancelar" class="btn btn-outline-danger">
                        <input type="submit" value="Guardar" class="btn btn-outline-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper" style="min-height: 579.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Clientes: <button type="button" data-toggle="modal" data-target="#modal-cliente"
                            class="btn btn-primary btn-flat">Nuevo cliente</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Clientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section>
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class='fas fa-tag fa-lg'></i> <b>Registro total de clientes</b></h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="text" id="buscar_cliente" class="form-control float-right"
                                placeholder="Buscar por nombre">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <table class="table dt-responsive nowrap table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th rowspan="2" class="align-middle">Nombre</th>
                                        <th colspan="2">INFORMACIÓN</th>
                                        <th colspan="4" class='text-center'>CONTACTO</th>
                                    </tr>
                                    <tr>
                                        <th>DNI</th>
                                        <th>EDAD</th>
                                        <th>TELÉFONO</th>
                                        <th>CORREO ELECTRÓNICO</th>
                                        <th>REGISTRADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id='tbl_cliente'>



                                </tbody>

                            </table>

                        </div><!-- end col-->
                    </div>

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
</div>



<div class="modal fade" id="modal-cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form_clientes' method='POST'>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" placeholder="Ingrese nombre" id='clt_nombre'
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" placeholder="Ingrese apllidos"
                                    id='clt_apellidos' required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" class="form-control" placeholder="Ingrese DNI" id='clt_dni'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" placeholder="Ingresar teléfono"
                                    id='clt_telefono'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <input type="text" class="form-control" placeholder="Ingrese Correo Electrónico"
                                    id='clt_email'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>F. Nacimiento</label>
                                <input type="date" class="form-control" id='clt_nacimiento' required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Género</label>
                                <select class="form-control" id='clt_sexo'>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Adicional</label>
                                <textarea class="form-control" rows="3" placeholder="Información adicional"
                                    id='clt_adicional'></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modal-edit_cliente">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EDITAR CLIENTE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form_edit_cliente' method='POST'>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" id='cli_edit_tel'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <input type="text" class="form-control" id='cli_edit_correo'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Adicional</label>
                                <textarea class="form-control" rows="3" id='cli_edit_adicional'></textarea>
                                <input type="hidden" id="cli_id_cliente">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
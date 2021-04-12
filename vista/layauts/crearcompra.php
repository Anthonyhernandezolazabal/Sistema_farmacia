<div class="content-wrapper" style="min-height: 1592.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Compra</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Crear Compra</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-shopping-bag fa-lg"></i>
                    Nueva Compra
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <div class="card card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="codigo_c">Código</label>
                                    <input type="text" class="form-control" id="codigo_c" placeholder="Enter email">
                                    <span id="alert_c_codigo" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_codigo_text"></span></span>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_compra_c">Fecha de Compra</label>
                                    <input type="date" class="form-control" id="fecha_compra_c" placeholder="Password" readonly>
                                    <span id="alert_c_fcompra" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_fcompra_text"></span></span>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_entrega_c">Fecha de entrega</label>
                                    <input type="date" class="form-control" id="fecha_entrega_c" placeholder="Password">
                                    <span id="alert_c_fventa" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_fventa_text"></span></span>
                                </div>


                                <label for="total_c">Total</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>S/.</b></span>
                                    </div>
                                    <input type="number" class="form-control" id="total_c" value='0' onmousedown="return false;">
                                    <span id="alert_c_total" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_c_total_text"></span></span>
                                </div>


                                <div class="form-group">
                                    <label>Estado de Pago</label>
                                    <select class="custom-select select2" id='sl_estado_compra'>

                                    </select>
                                    <span id="alert_c_estado" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_estado_text"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select class="custom-select select2" id='sl_proveedor_compra'>

                                    </select>
                                    <span id="alert_c_proveedodr" class="error invalid-feedback"
                                        style="display: none;"><i class="fas fa-times-circle"></i> <span
                                            id="alert_c_proveedodr_text"></span></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- text input -->
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="custom-select select2" id='sl_producto_compra'>

                                    </select>
                                    <span id="alert_c_producto" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_producto_text"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Código</label>
                                    <input type="text" class="form-control" placeholder="Ingrese código"
                                        id='codigo_lote_c'>
                                    <span id="alert_c_codigo" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_codigo_text"></span></span>
                                </div>
                                <!-- text input -->
                                <div class="form-group bd_rgcant">
                                    <label>Cantidad</label>
                                    <input type="number" class="form-control" placeholder="Ingrese cantidad"
                                        id='cantidad_c'>
                                    <span id="alert_c_cantidad" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_cantidad_text"></span></span>
                                </div>
                                <!-- text input -->
                                <div class="form-group bd_rgtot">
                                    <label>Precio</label>
                                    <input type="number" class="form-control" placeholder="Ingrese precio"
                                        id='precio_compra_c'>
                                    <span id="alert_c_precio" class="error invalid-feedback" style="display: none;"><i
                                            class="fas fa-times-circle"></i> <span
                                            id="alert_c_precio_text"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Vencimiento</label>
                                    <input type="date" class="form-control" id='vencimiento_c'>
                                    <span id="alert_c_vencimiento" class="error invalid-feedback"
                                        style="display: none;"><i class="fas fa-times-circle"></i> <span
                                            id="alert_c_vencimiento_text"></span></span>
                                </div>
                                <hr style='margin-top: 46px;'>
                                <button type="button"
                                    class="agregar_producto_compra btn btn-outline-primary float-right"><i
                                        class="fa fa-bell"></i> Agregar</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="card">
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 291px;">
                        <table class="table table-head-fixed table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>CÓDIGO</th>
                                    <th>CANTIDAD</th>
                                    <th>VENCIMIENTO</th>
                                    <th>P. COMPRA</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id='tabla_registro_compra'>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-2 float-right" id='crear_compra_c'>
                    <div class="btn btn-primary btn-lg btn-flat">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                Crear compra
                            </font>
                        </font>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
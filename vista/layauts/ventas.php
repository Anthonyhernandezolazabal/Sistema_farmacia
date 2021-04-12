<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section>
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Consultas</h3>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 cst_vnt">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="venta_diaria">0</h3>

                                    <p>Venta Diária</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <a href="consultas" class="small-box-footer">
                                    Más información <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="venta_mensual">0</h3>

                                    <p>Venta Mensual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <a href="consultas" class="small-box-footer">
                                    Más información <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="venta_anual">0</h3>
                                    <p>Venta Anual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-signal"></i>
                                </div>
                                <a href="consultas" class="small-box-footer">
                                    Más información <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 cst_vnt2">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="venta_dia_vendedor">0</h3>

                                    <p>Venta del día por Vendedor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="consultas" class="small-box-footer">
                                    Más información <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                  
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 id="id_ganancia_mensual">0</h3>
                                    <p>Ganancia Mensual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <a href="consultas" class="small-box-footer">
                                    Más información <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Buscar Ventas</h3>
                </div>
                <div class="card-body">
                    <table id="tabla_venta"
                        class="display table table table-striped table-bordered table-hover text-nowrap"
                        style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>DNI.</th>
                                <th>Total</th>
                                <th>Vendedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>






<!--======================= 
        REGISTRO DE VENTAS
============================-->
<div class="modal fade" id="vista-venta">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-tasks"></i> REGISTROS DE VENTA
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <br>
                                        <b>Código de venta:</b> <span id='codigo_venta'></span><br>
                                        <b>Cliente:</b> <span id='cliente'></span><br>
                                        <b>DNI</b>: <span id='dni'></span><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <address><br>
                                        <b>Fecha de registro:</b> <span id='fecha'></span><br>
                                        <b>Hora de registro</b>: <span id='hora'></span><br>
                                        <b>Vendedor</b>: <span id='vendedor'></span>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-center" scope="col">CANTIDAD</th>
                                                <th class="text-center" scope="col">PRECIO</th>
                                                <th class="text-center" scope="col">PRODUCTO</th>
                                                <th class="text-center" scope="col">CONCENTRACION</th>
                                                <th class="text-center" scope="col">ADICIONAL</th>
                                                <th class="text-center" scope="col">LABORATORIO</th>
                                                <th class="text-center" scope="col">PRESENTACIÓN</th>
                                                <th class="text-center" scope="col">TIPO</th>
                                                <th class="text-center" scope="col">SUBTOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody id="registros">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row float-right">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Total:</th>
                                                <td id='total'></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br><br><hr>
                            <!-- float-right  -->

                                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
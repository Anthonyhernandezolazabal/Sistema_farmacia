<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="animate__animated animate__shakeY">CATÁLAGO</h1>
                        <input type="hidden" id="cat-carrito" value='mostrar_carrito_compra'>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                            <li class="breadcrumb-item active">Catálago</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- ============================
        LOTES EN RIESGOS
        ============================= -->
        <section>


        <div class="container-fluid">
            <div class="card card-outline card-danger">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="header-title" style='color: #f53d4e;'><b>LOTES EN RIESGO</b></h4>
                            <p class="text-muted font-13 mb-4">
                                <b style='color:#ebb81d'>Lotes por vencer</b> / <b style='color:#ed969e'>Lotes Vencidos</b>
                            </p>

                                <table id="lotes_riesgo_tbl" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Cód.</th>
                                            <th>Producto</th>
                                            <th>Stock</th>
                                            <th>Estado</th>
                                            <th>Laboratorio</th>
                                            <th>Presentación</th>
                                            <th>Proveedor</th>
                                            <th>Mes</th>
                                            <th>Días</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- <div class="container-fluid">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><code><b>LOTES EN RIESGO</b></code></h3>
                        
                    </div>
                    <div class="card-body p-0 table-responsive" style='height: 300px;'>

                        <table class="animate__animated animate__fadeIn table table-hover text-nowrap">
                            <thead class="table-success">
                                <tr>
                                    <th>Cód.</th>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                    <th>Laboratorio</th>
                                    <th>Presentación</th>
                                    <th>Proveedor</th>
                                    <th>Mes</th>
                                    <th>Días</th>
                                </tr>
                            </thead>
                            <tbody id="lotes_riesgo" class="table-active">

                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div> -->
        </section>
        



        <!-- ============================
        AGREGAR EL PRODUCTO AL CARRITO DE COMPRA
        ============================= -->
        <section>
            <div class="container-fluid">

                <div class="callout callout-info">
                    <h5> Buscar producto:</h5>
                    <div class="input-group">
                        <input type="text" id="buscar-producto" placeholder="Ingrese nombre de producto" class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card card-blue card-outline">
                    
                    <div class="card-body">
                        <div id="productos_catalago" class="row d-flex align-items-stretch">

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
</div>
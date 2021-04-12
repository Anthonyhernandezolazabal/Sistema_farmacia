<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Gestión Producto
                        <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto"
                            class="nuevoprod btn bg-gradient-primary ml-2">Crear producto</button>
                        <button type="button" data-toggle="modal" data-target="#modal-sm" class="btn btn-success"
                            style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generar Reportes</button>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">

            <div class="callout callout-info">
                <h5> Buscar producto:
                </h5>
                <div class="input-group">
                    <input type="text" id="buscar-producto" placeholder="Ingrese nombre de producto"
                        class="form-control float-left">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h3 class="card-title"><i class='fas fa-lg fa-archive'></i> <b>Vista general de los productos</b>
                    
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class='fas fa-filter'></i> Filtrar</button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" id='diez_pdt'>10</a>
                      <a class="dropdown-item" href="#" id='venticinco_pdt'>25</a>
                      <a class="dropdown-item" href="#" id='cien_pdt'>100</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" id='todo_pdt'>Todo</a>
                    </div>
                    <input type="hidden" id='almacenar_filtro' name='almacenar_filtro' value='6'>

                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <div id="productos" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<!--======================= 
        CREAR PRODUCTO
============================-->
<div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc8f;color:white">
                <h3 class="card-title"><i>GUARDAR PRODUCTO</i></h3>

                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form id="form-crear-producto">
                    <div class="form-group">
                        <label for="nombre-producto">Nombres</label>
                        <input id="nombre-producto" type="text" class="form-control" placeholder="Ingrese nombre">
                        <span id="alert_lg_nombre_prod" class="error invalid-feedback" style="display: none;"><i
                                class="fas fa-times-circle"></i> <span id="alert_lg_nombre_prod_text"></span></span>
                    </div>

                    <div class="row mb-3">

                        <div class="col-4">
                            <label for="concentracion">Concenetración</label>
                            <input id="concentracion" type="text" class="form-control" placeholder="Concentraciòn">
                            <span id="alert_lg_concentracion_prod" class="error invalid-feedback"
                                style="display: none;"><i class="fas fa-times-circle"></i> <span>Campo
                                    obligatorio</span></span>
                        </div>

                        <div class="col-4">
                            <label for="adicional">Adicional</label>
                            <input id="adicional" type="text" class="form-control" placeholder="Adicional">
                            <span id="alert_lg_adicional_prod" class="error invalid-feedback" style="display: none;"><i
                                    class="fas fa-times-circle"></i> <span>Campo obligatorio</span></span>
                        </div>

                        <div class="col-4">
                            <label for="precio">Precio</label>
                            <input id="precio" type="number" step="any" class="form-control" value="1"
                                placeholder="Precio">
                            <span id="alert_lg_precio_prod" class="error invalid-feedback" style="display: none;"><i
                                    class="fas fa-times-circle"></i> <span>Campo obligatorio</span></span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="laboratorio">Laboratorio</label>
                        <select name="laboratorio" id="laboratorio" class="form-control select2"
                            style="width:100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control select2" style="width:100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="presentacion">Presentación</label>
                        <select name="presentacion" id="presentacion" class="form-control select2"
                            style="width:100%"></select>
                    </div>
                    <input type="hidden" id="id_edit_prod">
            </div>
            <div class="modal-footer">

                <button type="button" data-dismiss="modal"
                    class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--======================= 
        CAMBIAR LOGO 
============================-->
<div class="modal fade" id="cambiarlogo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17a2b8;">
                <h5 class="modal-title" id="staticBackdropLabel"><b><i>CAMBIAR LOGO</i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id='logoactual_prod' src="img/prod/anonymous.png"
                        class="previsualizar_prod profile-user-img img-fluid img-circle">
                    <div class="text-center">
                        <b id="nombre_logo"></b>
                    </div><br>
                    <form id="form-logo_produ" enctype="multipart/form-data">
                        <!--AVATAR-->
                        <div class="input-group mb-3">
                            <input type="file" name="photo" id="photo_view" class="nuevaFoto_prod input-group">
                            <input type="hidden" name="id_logo_prod" id="id_logo_prod" value="">
                            <input type="hidden" name="funcion" id="funcion" value="">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--======================= 
        CREAR LOTE
============================-->
<!-- <div class="modal fade" id="crearlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff ;color:white">
                <h3 class="card-title"><i>GUARDAR LOTE</i></h3>

                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form id="form-crear-lote">
                    <div class="form-group">
                        <label for="nombre_producto_nombre">Producto:</label>
                        <label id="nombre_producto_nombre">Nombre de producto</label>
                    </div>
                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <select name="proveedor" id="proveedor" class="form-control select2"
                            style="width:100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input id="stock" type="number" class="form-control" placeholder="Ingrese stock">
                    </div>
                    <div class="form-group">
                        <label for="vencimiento">Vencimiento</label>
                        <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese vencimiento"
                            required>
                    </div>
                    <input type="hidden" id="id_lote_prod">
            </div>
            <div class="modal-footer">

                <button type="button" data-dismiss="modal"
                    class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div> -->






<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">


            <div class="modal-body card-outline card-primary">
                <button type="button" class="btn btn-tool float-right" data-dismiss="modal"><i
                        class="fas fa-lg fa-times"></i>
                </button>

                <p>
                    <i class="far fa-hand-point-right"></i>
                    Elija <code>formato</code> de reporte</p>
                <center>
                    <div>
                        <button type="button" id='button_reportes'
                            class="btn btn-block btn-outline-secondary btn-lg">PDF <i
                                class="far fa-file-pdf"></i></button>

                        <button type="button" id='button_reportes_excel'
                            class="btn btn-block btn-outline-success btn-lg"><i class="far fa-file-excel"></i>
                            EXCEL</button>
                    </div>
                </center>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
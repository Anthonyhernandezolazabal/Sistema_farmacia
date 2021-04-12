<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>COMPRA</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Compra</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- ============================
    PROCESAR COMPRAS
    ============================= -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary" style='padding: 0px 15px 0px 15px;'>
                        <div class="card-body p-0">
                            <header>
                                <div class="logo_cp">
                                    <img src="img/plantilla/logo.png" width="100" height="100">
                                </div>
                                <h1 class="titulo_cp">SOLICITUD DE COMPRA</h1>

                            </header>

                            <p class='mb-0'><code><b>BUSCAR CLIENTE:</b></code> <a href="clientes"><button type="button" class="btn btn-info btn-xs">Agregar Nuevo cliente</button></a></p>
                            

                            <div class="row formulariocompra">
                                <div class="col-xl-6 col-lg-6 col-md-12">

                                    <div class="row">

                                        <div class="col-xl-6">

                                            <div class="txtb">
                                                <label style='color:#3f00ff'>DNI :</label>
                                                <input type="text" class='text-center'maxlength='8' placeholder="Buscar por DNI" id='txt_dni'>
                                            </div>

                                        </div>

                                        <div class="col-xl-6">

                                            <div class="txtb">

                                                <label>Cliente:</label>
                                                <input type="text" class='text-center' id='nombre_cliente' readonly placeholder="Nombre de Cliente">
                                                <input type="hidden" id='id_cliente_hide'>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">

                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="txtb" style="height: 84px;">
                                                <label style='color:#3f00ff'>Seleccionar Cliente :</label>
                                                <select id='sl_cliente' class="sel_cliente form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="txtb">
                                                <label>Vendedor:</label>
                                                <input type="email" class='text-center text-uppercase'
                                                    value="<?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'];?>">
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>









                            <button id="actualizar" class="btn btn-success mb-1">Actualizar</button>
                            <div id="cp" class="card-body p-0">

                                <div class='table-responsive'>
                                    <table class="compra table table-hover text-nowrap mb-2">
                                        <thead class='table-success'>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Stock</th>
                                                <th>Precio</th>
                                                <th>Concentracion</th>
                                                <th>Adicional</th>
                                                <th>Laboratorio</th>
                                                <th>Presentacion</th>
                                                <th>Cantidad</th>
                                                <th>Sub Total</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lista-compra" class='table-active'>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-outline card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-dollar-sign"></i>
                                                    Calculo 1
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="info-box mb-3 bg-warning p-0">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">SUB TOTAL</span>
                                                        <span class="info-box-number" id="subtotal">10</span>
                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-warning">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">IGV</span>
                                                        <span class="info-box-number" id="con_igv">2</span>
                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">SIN DESCUENTO</span>
                                                        <span class="info-box-number" id="total_sin_descuento">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-outline card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-bullhorn"></i>
                                                    Calculo 2
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="info-box mb-3 bg-danger">
                                                    <span class="info-box-icon"><i
                                                            class="fas fa-comment-dollar"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">DESCUENTO</span>
                                                        <input id="descuento" type="number" min="1"
                                                            placeholder="Ingrese descuento" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon"><i
                                                            class="ion ion-ios-cart-outline"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">TOTAL</span>
                                                        <span class="info-box-number" id="total">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-cash-register"></i>
                                                    Cambio
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="info-box mb-3 bg-success">
                                                    <span class="info-box-icon"><i
                                                            class="fas fa-money-bill-alt"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">INGRESO</span>
                                                        <input type="number" id="pago" min="1"
                                                            placeholder="Ingresa Dinero" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-info">
                                                    <span class="info-box-icon"><i
                                                            class="fas fa-money-bill-wave"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">VUELTO</span>
                                                        <span class="info-box-number" id="vuelto">3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-3">
                                <a href="catalago">
                                    <div class="btn btn-default btn-lg btn-flat mr-2">
                                        <i class="fas fa-cart-plus fa-lg mr-2"></i> Seguir comprando
                                    </div>
                                </a>
                                <div id="procesar-compra" class="btn btn-primary btn-lg btn-flat">
                                    <i class="fas fa-check-double fa-lg mr-2"></i> Realizar compra
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
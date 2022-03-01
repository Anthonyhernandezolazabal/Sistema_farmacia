<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item dropdown" id='carr_none' style="display:none;">
            <img src="img/plantilla/carrito.png" style='cursor: pointer;'
                class="nav-link dropdown-toggle imagen-carrito" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </img>
            <div id="contar" class="contador badge badge-danger"></div>
            <div class="dropdown-menu d_m" aria-labelledby="navbarDropdown">
                <h5>
                    <i class="fas fa-shopping-basket"></i> Carrito
                    <p class="float-right" id='fecha_actual'></p>
                </h5>
                <table class="carro table table-hover table-striped text-nowrap p-0">
                    <thead class="table-success">
                        <tr>
                            <th>código</th>
                            <th>Nombre</th>
                            <th>Concentración</th>
                            <th>Adicional</th>
                            <th>Precio</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="listar_car">

                        <!-- <h5>No hay productos en el carrito</h5> -->

                    </tbody>
                </table>
                <button type="button" id="procesar-pedido" class="btn btn-success float-right mb-2"><i class="fas fa-shopping-bag"></i> Procesar Compra </button>
                <button type="button" id="vaciar-carrito" class="btn btn-primary float-right" style="margin-right: 5px;"> <i class="fas fa-times-circle"></i> Vaciar carrito </button>
            </div>
        </li>



    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown" id='mostrar_ntf_hd'>
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id='cont_ntf'></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right direct-chat-messages"
                style="left: inherit; right: 0px;height: 446px;">
                <div>
                    <span class="dropdown-item dropdown-header"><b>Notificaciones</b> <br>
                    </span>
                    <div id="ntf_compras_pe">

                       <a href="#" class="dropdown-item">
                            <i class="far fa-bell mr-2"></i> <i>Se ha hecho modificaciones en un <br> <b>producto</b>. Al momento de realizar una<br>  venta no olvide precionar el <b>boton</b> de <br></i>
                                <span class="right badge badge-success">Actualizar</span>
                        </a>


                    </div>
                    <a href="#" style='display:none;margin-top: 64px;' id='sin_ntf'
                        class="dropdown-item dropdown-footer">No hay notificaciones recientes</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <img src="img/usuario/default.png" id='avatar5' class="img-circle" height="30px">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header" id='us_tipobeader'></span>

                <div class="dropdown-divider"></div>
                <center> <a href="salir" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </a></center>
            </div>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="catalago" class="brand-link">
        <img src="img/plantilla/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Farmacia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img id="avatar4" src="img/usuario/default.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nombre'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <!-- PERFIL DE USUARIO -->
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">USUARIO</li>

                <li class="nav-item">
                    <a href="datospersonales" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Datos personales
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['us_tipo'] ==3  || $_SESSION['us_tipo'] ==1) { ?>

                  <li id="gestion_usuario" class="nav-item">
                      <a href="usuarios" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Gestión usuarios
                          </p>
                      </a>
                  </li>

                <?php } ?>

                <li id="gestion_clientes" class="nav-item">
                    <a href="clientes" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Gestión clientes
                        </p>
                    </a>
                </li>

                <li class="nav-header">VENTAS</li>

                <li class="nav-item">
                    <a href="ventas" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>
                            Listar Ventas
                        </p>
                    </a>
                </li>
                
                <?php if ($_SESSION['us_tipo'] ==3 || $_SESSION['us_tipo'] ==1) {?>        
                <li id="almacen" class="nav-header">ALMACÉN</li>

                <li id="gestion_producto" class="nav-item">
                    <a href="productos" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Gestionar producto
                        </p>
                    </a>
                </li>
                <li id="gestion_atributo" class="nav-item">
                    <a href="atributos" class="nav-link">
                        <i class="nav-icon fas fa-vials"></i>
                        <p>
                            Gestión atributo
                        </p>
                    </a>
                </li>
                <?php } ?>
                <?php if ($_SESSION['us_tipo'] ==3) {?>
                <li id="gestion_lote" class="nav-item">
                    <a href="lotes" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Gestión lote
                        </p>
                    </a>
                </li>
                <?php } ?>
                <?php if ($_SESSION['us_tipo'] == 3) {?>
                    <li id="compras" class="nav-header">COMPRAS</li>

                    <li id="gestion_proveedor" class="nav-item">
                        <a href="proveedores" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Gestión proveedor
                            </p>
                        </a>
                    </li>
                    <li id="gestion_compras" class="nav-item">
                        <a href="gestioncompras" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Gestión compras
                            </p>
                        </a>
                    </li>
                <?php } ?>  
            </ul>
        </nav>
    </div>
</aside>
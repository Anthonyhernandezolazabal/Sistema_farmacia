

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Gestión Usuarios<button type="button" data-toggle="modal" data-target="#crearusuario"
                            class="btn bg-gradient-primary ml-2">Crear usuario</button></h1> -->
                    <h1>Gestión Usuarios<button id="button-crear" type="button" data-toggle="modal"
                            data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear usuario</button></h1>
                    <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION["us_tipo"] ?>">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">


            <div class="callout callout-info">
                <h5> Buscar usuario:</h5>
                <div class="input-group">
                    <input type="text" id="buscar" placeholder="Ingrese nombre de usuario"
                        class="form-control float-left">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        
            <div class="card card-primary">


                <div class="card-body">
                    <div id="usuarios" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!--======================= 
GUARDAR USUARIO
============================-->
<div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc8f;color:white">
                <h3 class="card-title"><i>CREAR USUARIO</i></h3>
                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form id="form-crear">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre">
                        <span id="alert_lg_nombre" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_nombre_text"></span></span>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" type="text" class="form-control" placeholder="Ingrese apellido">
                        <span id="alert_lg_apellidos" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_apellidos_text"></span></span>
                    </div>
                    <div class="form-group">
                        <label for="edad">Nacimiento</label>
                        <input id="edad" type="date" class="form-control" placeholder="Ingrese nacimiento">
                        <span id="alert_lg_nacimiento" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_nacimiento_text"></span></span>
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input id="dni" type="text" class="form-control" placeholder="Ingrese DNI">
                        <span id="alert_lg_dni" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_dni_text"></span></span>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input id="pass" type="password" class="form-control" placeholder="Ingrese contraseña">
                        <span id="alert_lg_pass" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_pass_text"></span></span>
                    </div>
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
CONFIRMAR CONTRASEÑA
============================-->
<div class="modal fade" id="confirmar" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #08acd542;">
                <h5 class="modal-title" id="staticBackdropLabel"><b><i>CONFIRMAR ACCIÓN</i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="avatar6" src="img/usuario/default.png" class="profile-user-img img-fluid img-circle">
                </div>
                <div class="text-center">
                    <b>
                        <?php echo $_SESSION['nombre']; ?>
                    </b>
                </div>
                <span>Necesitamos su contraseña para confirmar</span>
                <form id="form-confirmar">
                    <!-- CONTRASEÑA ACTUAL -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-unlock-alt"></i>
                            </span>
                        </div>
                        <input id="oldpass" type="password" class="form-control" placeholder="Ingrese contraseña actual"
                            required>
                        <input type="hidden" id="id_user">
                        <input type="hidden" id="avatar">
                        <input type="hidden" id="funcion">
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
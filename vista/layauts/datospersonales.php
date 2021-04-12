<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Datos Personales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Datos personales</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-4">
                    <div class="card card-blue card-outline">
                        <!-- Linea -->
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img id="avatar2" src="img/usuario/default.png"
                                    class="profile-user-img img-fluid img-circle">
                            </div>
                            <div class="text-center mt-1">
                                <!-- CAMBIAR AVATAR -->
                                <button type="button" data-toggle="modal" data-target="#cambiophoto"
                                    class="btn btn-primary btn-sm ">Cambiar avatar</button>
                            </div>
                            <h3 id="nombre_us" class="profile-username text-center text-blue">Nombre</h3>
                            <p id="apellidos_us" class="text-muted text-center">Apellidos</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b style="color:#007bff">Edad</b><a id="edad" class="float-right">12</a>
                                </li>
                                <li class="list-group-item">
                                    <b style="color:#007bff">DNI</b><a id="dni_us" class="float-right">12</a>
                                </li>
                                <li class="list-group-item">
                                    <b style="color:#007bff">Tipo Usuario</b>
                                    <span id="us_tipo" class="float-right">Tipo de usuario</span>
                                </li><br>
                                <button type="button" class="btn btn-block btn-outline-warning btn-sm"
                                    data-toggle="modal" data-target="#cambiocontra">Cambiar contraseña</button>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-blue">
                        <div class="card-header">
                            <h3 class="card-title">Sobre mi</h3>
                        </div>
                        <div class="card-body">
                            <strong style="color:#007bff">
                                <i class="fas fa-phone mr-1"></i>Teléfono
                            </strong>
                            <p id="telefono_us" class="text-muted"></p>
                            <strong style="color:#007bff">
                                <i class="fas fa-map-marker-alt mr-1"></i>Recidencia
                            </strong>
                            <p id="residencia_us" class="text-muted"></p>
                            <strong style="color:#007bff">
                                <i class="fas fa-at mr-1"></i>Correo
                            </strong>
                            <p id="correo_us" class="text-muted"></p>
                            <strong style="color:#007bff">
                                <i class="fas fa-smile-wink mr-1"></i>Sexo
                            </strong>
                            <p id="sexo_us" class="text-muted"></p>
                            <strong style="color:#007bff">
                                <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                            </strong>
                            <p id="adicional_us" class="text-muted"></p>
                            <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                        </div>
                        <div class="card-footer">
                            <p class="text-muted"><i class='fas fa-hand-point-right'></i> Click en el boton si desea editar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-blue">
                        <div class="card-header">
                            <h3 class="card-title">Editar datos personales</h3>
                        </div>
                        <div class="card-body">

                            <form id="form-usuario" class="form-forizonal">
                                <div class="form-group row">
                                    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="telefono" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="residencia" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="correo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="sexo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <fiv class="form-group row">
                                    <div class="offset-sm-2 col-sm-10 float-right">
                                        <button class="btn btn-block btn-outline-primary"
                                            style="border-radius:20px">Guardar</button>

                                    </div>
                                </fiv>
                            </form>

                        </div>
                        <div class="card-footer">
                            <p class="text-muted"><i>Cuidado con ingresar datos erroneos</i></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>






<!--======================= 
MODAL DE CAMBIAR CONTRASEÑA
============================-->
<div class="animate__animated animate__zoomInDown modal fade" id="cambiocontra" data-backdrop="static"
    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ff9c9a80;">
                <h5 class="modal-title" id="staticBackdropLabel"><b><i>CAMBIAR CONTRASEÑA</i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="avatar3" src="img/usuario/default.png" class="profile-user-img img-fluid img-circle">
                    <div class="text-center">
                        <b>
                            <?php echo $_SESSION['nombre']; ?>
                        </b>
                    </div><br>
                    <form id="form-pass">
                        <!-- CONTRASEÑA ACTUAL -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock-alt"></i>
                                </span>
                            </div>
                            <input id="oldpass" type="password" class="form-control" placeholder="Ingrese contraseña actual" required>
                        </div>
                        <hr>
                        <!-- NUEVA CONTRASEÑA -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input id="newpass" type="password" class="form-control" placeholder="Ingrese nueva actual" required>
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
        CAMBIAR FOTO 
============================-->
<div class="animate__animated animate__jackInTheBox modal fade" id="cambiophoto" data-backdrop="static"
    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00bcd429;">
                <h5 class="modal-title" id="staticBackdropLabel"><b><i>CAMBIAR AVATAR</i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="avatar1" src="img/usuario/default.png" class="previsualizar_datospersonales profile-user-img img-fluid img-circle">
                    <div class="text-center">
                        <b>
                            <?php echo $_SESSION['nombre']; ?>
                        </b>
                    </div><br>
                    <form id="form-photo" enctype="multipart/form-data">
                        <!--AVATAR-->
                        <div class="input-group mb-3">
                            <input type="file" name="photo" id="photo" class="input-group nuevaFoto_datospersonales">
                            <input type="hidden" name="funcion" value="cambiar_foto">
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Proveedor<button id="button-crear" type="button" data-toggle="modal" data-target="#crearproveedor" class="nuevoprov btn bg-gradient-primary ml-2">Crear Proveedor</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Proveedor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="callout callout-info">
                <h5> Buscar proveedor:</h5>
                <div class="input-group">
                    <input type="text" id="buscar-proveedor" placeholder="Ingrese nombre de proveedor"
                        class="form-control float-left">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-body">
                    <div id="proveedores" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
</div>

<!--======================= 
        CREAR PROVEEDOR 
============================-->
<div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc8f;color:white">
                <h3 class="card-title"><i>GUARDAR PROVEEDOR</i></h3>
                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-crear-proveedor" method='POST'>
                <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre">
                            <span id="alert_lg_nombre_prov" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_nombre_prov_text"></span></span>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" type="text" class="form-control" placeholder="Ingrese telefono">
                            <span id="alert_lg_tel_prov" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_tel_prov_text"></span></span>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input id="correo" type="text" class="form-control" placeholder="Ingrese correo">
                            <span id="alert_lg_email_prov" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_email_prov_text"></span></span>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input id="direccion" type="text" class="form-control" placeholder="Ingrese dirección">
                            <span id="alert_lg_dir_prov" class="error invalid-feedback" style="display: none;"><i class="fas fa-times-circle"></i> <span id="alert_lg_dir_prov_text"></span></span>
                        </div>
                        <input type="hidden" id="id_edit_prov">
                </div>
                <div class="modal-footer">

                    <button type="button" data-dismiss="modal"
                        class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--======================= 
        CAMBIAR LOGO 
============================-->
<div class="modal fade" id="cambiarlogo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <img id="logoactual_prov" src="img/prov/prov_default.png" class="previsualizar_proov profile-user-img img-fluid img-circle">
            <div class="text-center">
                <b id="nombre_logo"></b>
            </div><br>
            <form id="form-logo_prove" enctype="multipart/form-data">
                <!--AVATAR-->
                <div class="input-group mb-3">
                    <input type="file" name="photo" id="photo" class="nuevaFoto_proov input-group">
                    <input type="hidden" name="id_logo_prov" id="id_logo_prov" value="">
                    <input type="hidden" name="funcion" id="funcion" value="">
                </div>
                <hr>
                <!-- EDITADO  -->
                <div class="alert alert-success text-center" id="edit_avatar" style='display:none;'>
                    <span><i class="fas fa-check"> Se cambió el logo</i></span>
                </div>

                <!-- NO EDITADO -->
                <div class="alert alert-danger text-center" id="noedit_avatar" style='display:none;'>
                    <span><i class="fas fa-times"> Formato no compatible</i></span>
                </div>

                <!-- NO EDITADO -->
                <div class="alert alert-danger text-center" id="vacio_avatar" style='display:none;'>
                    <span><i class="fas fa-times"> ¡Debe seleccionar una imagen!</i></span>
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
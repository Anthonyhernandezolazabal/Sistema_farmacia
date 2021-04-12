<div class="invoice p-3 mb-3">
    <div class="callout callout-info">
        <h5>Buscar Laboratorio:
            <button id='nuevolab' class="btn bg-gradient-success btn-sm" type="button" data-toggle="modal"
                data-target="#crear-laboratorio">Crear Laboratorio</button>
        </h5>
        <div class="input-group">
            <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese nombre">
            <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table id="example2"  class="table table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Acciones</th>
                        <th>Logo</th>
                        <th>Laboratorio</th>
                    </tr>
                </thead>
                <tbody id='laboratorios_tabla'>
                    
                </tbody>
            </table>
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
            <img id="logoactual_lab" src="img/lab/lab_default.jpg" class="previsualizar_laboratorio profile-user-img img-fluid img-circle">
            <div class="text-center">
                <b id="nombre_logo"></b>
            </div><br>
            <form id="form-logo_labo" enctype="multipart/form-data">
                <!--AVATAR-->
                <div class="input-group mb-3">
                    <input type="file" name="photo" id="photo" class="nuevaFoto_laboratorio input-group">
                    <input type="hidden" name="id_logo" id="id_logo">
                    <input type="hidden" name="funcion" id="funcion">
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


<!-- ============================
CREAR LABORATORIO
============================= -->
<div class="modal fade" id="crear-laboratorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff8f;color:white">
                <h3 class="card-title"><i>GUARDAR LABORATORIO</i></h3>
                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
              
                <form id="form-crear-laboratorio">
                    <div class="form-group">
                        <label for="nombre-laboratorio">Nombres</label>
                        <input id="nombre-laboratorio" type="text" class="form-control"
                            placeholder="Ingrese nombre de laboratorio">
                        <input type="hidden" id="id_editar_lab">
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
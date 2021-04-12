<div class="invoice p-3 mb-3">
    <div class="callout callout-info">
        <h5>Buscar Tipo:
            <button class="nuevotip btn bg-gradient-success btn-sm" type="button" data-toggle="modal" data-target="#crear-tipo">Crear Tipo</button>
        </h5>
        <div class="input-group">
            <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese nombre">
            <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Acciones</th>
                        <th scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody id='tipos_tabla'>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ============================
CREAR TIPO
============================= -->
<div class="modal fade" id="crear-tipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff8f;color:white">
                <h3 class="card-title"><i>GUARDAR TIPO</i></h3>
                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">


                <form id="form-tipo">
                    <div class="form-group">
                        <label for="nombre-tipo">Nombres</label>
                        <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre del tipo">
                        <input type="hidden" id="id_tip">
                        <input type="hidden" id="nombre_tip">
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
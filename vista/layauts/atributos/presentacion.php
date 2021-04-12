<div class="invoice p-3 mb-3">
    <div class="callout callout-info">
        <h5>Buscar Presentación:
            <button class="nuevopres btn bg-gradient-success btn-sm" type="button" data-toggle="modal" data-target="#crear-presentacion">Crear Presentación</button>
        </h5>
        <div class="input-group">
            <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese nombre">
            <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Acciones</th>
                        <th>Presentación</th>
                    </tr>
                </thead>
                <tbody id='presentacion_tabla'>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ============================
CREAR PRESENTACIÓN
============================= -->
<div class="modal fade" id="crear-presentacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff8f;color:white">
                <h3 class="card-title"><i>GUARDAR PRESENTACIÓN</i></h3>
                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form id="form-presentacion">
                    <div class="form-group">
                        <label for="nombre-presentacion">Nombres</label>
                        <input id="nombre-presentacion" type="text" class="form-control"
                            placeholder="Ingrese nombre de presentación" >
                        <input type="hidden" id="id_pres">
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
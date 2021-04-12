
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Lote</h1>                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Lote</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">

            <div class="callout callout-info">
                <h5> Buscar Lotes:</h5>
                <div class="input-group">
                    <input type="text" id="buscar-producto" placeholder="Ingrese nombre de producto"
                        class="form-control float-left">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <div id="lotes" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
</div>


<!--======================= 
        EDITAR LOTE
============================-->
<div class="modal fade" id="editarlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc8f ;color:white">
                <h3 class="card-title"><i>EDITAR LOTE</i></h3>

                <button data-dismiss="modal" arial-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
              
                <form id="form-editar-lote">
                    <div class="form-group">
                        <label for="codigo_lote">Código lote:</label>
                        <label id="codigo_lote">Código lote</label>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input id="stock" type="number" class="form-control" placeholder="Ingrese stock">
                    </div>
                    <input type="hidden" id="id_lote">
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
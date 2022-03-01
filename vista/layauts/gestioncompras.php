<div class="content-wrapper" style="min-height: 1592.4px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestión Compra:
            <a href="crearcompra"><button type="button" class="btn btn-primary btn-flat">Nueva
                compra</button></a>

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="catalago">Home</a></li>
            <li class="breadcrumb-item active">Gestión Compra</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">



    <!-- <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Striped Full Width Table</h3>
            </div>
 
            <div class="card-body p-0">
                <table id='tbl_compra_c' class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID | Código</th>
                            <th>Fecha de Compra</th>
                            <th>Fecha de Entrega</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Proveedor</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                    </tbody>
                </table>
            </div>

        </div> -->


    <div class="card card-outline card-primary">
      <div class="card-header">
        <h3 class="card-title">Vista general de toda las compras</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id='tbl_compra_c' class="table table-bordered table-striped" style='width: 100%;'>
          <thead>
            <tr>
              <th>#</th>
              <th>ID | Código</th>
              <th>Fecha de Compra</th>
              <th>Fecha de Entrega</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Proveedor</th>
              <th>Estado</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <tbody>


          </tbody>

        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- /.error-page -->
  </section>
  <!-- /.content -->
</div>

<div class="modal fade" id="modal-cambiar_estado">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CAMBIAR ESTADO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='form_cambiar_estado'>
        <div class="modal-body">

          <div class="form-group">
            <label>Estado</label>
            <select class="form-control" id='estado_compra_c'>

            </select>
            <input type="hidden" id='idddd_compr'>
          </div>

          <!-- <div class="form-group" >
                        <label>Estado de entrega</label>
                        <select class="form-control" id='estado_entrega_c'>
                            <option disabled="" selected="">Seleccionar un estado</option>
                            <option value="E">Entregado</option>
                            <option value="PE">Por Entregar</option>
                        </select>
                    </div> -->

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--======================= 
        REGISTRO DE COMPRAS
============================-->
<div class="modal fade" id="vista-compraaaas">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-tasks"></i> DETALLE COMPRA
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <address>
                  <br>
                  <b>Código Compra:</b> <span id='codigo_cmp'></span><br>
                  <b>Fecha de Compra:</b> <span id='fecha_compra'></span><br>
                  <b>Fecha de Entrega</b>: <span id='fecha_entrega'></span><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <address><br>
                  <b>Estado:</b> <span id='estado_cmp'></span><br>
                  <b>Proveedor</b>: <span id='proveedor_cmp'></span><br>
                </address>
              </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive" style='height: 291px;'>
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center" scope="col">#</th>
                      <th class="text-center" scope="col">CÓDIGO</th>
                      <th class="text-center" scope="col">CANTIDAD</th>
                      <th class="text-center" scope="col">VENCIMIENTO</th>
                      <th class="text-center" scope="col">P.COMPRA</th>
                      <th class="text-center" scope="col">PRODUCTO</th>
                      <th class="text-center" scope="col">LABORATORIO</th>
                      <th class="text-center" scope="col">PRESENTACIÓN</th>
                      <th class="text-center" scope="col">TIPO</th>
                    </tr>
                  </thead>
                  <tbody id="detalles_compras">

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row float-right">
              <div class="col-12">
                <table class="table">
                  <tbody>
                    <tr>
                      <th>Total:</th>
                      <td id='total_cmp'></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <br><br>
            <hr>
            <!-- float-right  -->

            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
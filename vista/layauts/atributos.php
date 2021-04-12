<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión atributo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="catalago">Home</a></li>
                        <li class="breadcrumb-item active">Gestión atributo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                
                <div class="row mt-0">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Laboratorio</a>
                            <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Tipo</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Presentación</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent" style='width: 100%'>
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                                
                            <!-- ============================
                                        LABORATORIO
                            ============================= -->
                            <?php
                                include 'vista/layauts/atributos/laboratorio.php';
                            ?>

                        </div>
                        <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                            <!-- ============================
                                        TIPO PRODUCTO
                            ============================= -->
                            <?php
                                include 'vista/layauts/atributos/tipo.php';
                            ?> 
                        </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                            <!-- ============================
                                        TIPO PRODUCTO
                            ============================= -->
                            <?php
                                include 'vista/layauts/atributos/presentacion.php';
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
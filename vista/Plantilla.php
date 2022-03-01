<?php

    session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="js/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="css/dist/adminlte.css">
    <link rel="stylesheet" href="js/plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="css/dist/plantilla.css">


    <!-- DataTables -->
    <link rel="stylesheet" href="js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="js/plugins/select2/select2.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">  
<input type="hidden" id="id_usuario" value="<?php echo $_SESSION["usuario"]?>">
<input type="hidden" id="usuario_tipo_u" value="<?php echo $_SESSION["us_tipo"]?>">
    
        <?php
        if(isset($_SESSION["iniciarSesion"]) && ($_SESSION["iniciarSesion"] == "ok")){
            
            echo '<div class="wrapper">';
        
                include 'vista/layauts/header.php';
                include 'vista/layauts/nav.php';

                
                /* === CONTENIDO === */
                if(isset($_GET["ruta"])){

                    if($_GET["ruta"] == "catalago" ||
                        $_GET["ruta"] == "datospersonales" ||
                        $_GET["ruta"] == "usuarios" ||
                        $_GET["ruta"] == "atributos" ||
                        $_GET["ruta"] == "proveedores" ||
                        $_GET["ruta"] == "productos" ||
                        $_GET["ruta"] == "lotes" ||
                        $_GET["ruta"] == "compra" ||
                        $_GET["ruta"] == "ventas" ||
                        $_GET["ruta"] == "consultas" ||
                        $_GET["ruta"] == "clientes" ||
                        $_GET["ruta"] == "gestioncompras" ||
                        $_GET["ruta"] == "crearcompra" ||
                        $_GET["ruta"] == "salir"){

                        include 'vista/layauts/'.$_GET["ruta"].".php";
            
                    }else{
            
                        include "vista/layauts/404.php";
            
                    }
            
                }else{
            
                    include "vista/layauts/catalago.php";
            
                }


                include 'vista/layauts/footer.php';
            
            echo '</div>';

        }else{
            /* === LOGIN === */
            include 'vista/layauts/acceso.php';

        }
        ?>

    
    <script src="js/plugins/jquery/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="js/dist/adminlte.js"></script>
    <script src="js/plugins/select2/select2.js"></script>

    <!-- DataTables -->
    <script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="js/plugins/Chart/Chart.min.js"></script>
    <script src="js/plantilla.js"></script>
    <script src="js/Login.js"></script>
    <script src="js/usuario.js"></script>
    <script src="js/gestion_usuario.js"></script>
    <script src="js/laboratorio.js"></script>
    <script src="js/Tipos.js"></script>
    <script src="js/presentacion.js"></script>
    <script src="js/proveedor.js"></script>
    <script src="js/productos.js"></script>
    <script src="js/Lote.js"></script>
    <script src="js/catalago.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/ventas.js"></script>
    <script src="js/consultas.js"></script>
    <script src="js/recuperar.js"></script>
    <script src="js/clientes.js"></script>
    <script src="js/ingresarcompra.js"></script>
    <script src="js/Compras.js"></script>
</body>

</html>
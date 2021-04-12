<?php
include_once '../modelo/Compras.php';
include_once '../modelo/Lote.php';
require_once('../vendor/autoload.php');
$lote = new Lote(); 
$compras = new Compras();
    
    if ($_POST["funcion"] =='registrar_compra_c') {
        $descripcion = json_decode($_POST['descripcionString']);
        $productos = json_decode($_POST['productosString']);

        // $f_c = $descripcion->fecha_compra;
        // $f_e = $descripcion->fecha_entrega;

        // date_default_timezone_set('America/Lima');
        // $fec_comp = new DateTime($f_c);
        // $fec_entr = new DateTime($f_e);

        // $diferencia = $fec_entr->diff($fec_comp);
        // $mes = $diferencia->m;
        // $dia = $diferencia->d;

        // if ($mes == 0 && $dia == 0) {
        //     $estado = 'E'; //entregado
        // }else{
        //     $estado = 'PE'; //Por entregar
        // }
        // $compras->crear($descripcion->codigo,$f_c,$f_e,$descripcion->total,$descripcion->estado,$descripcion->proveedor,$estado);
        
        $estado = 'PE'; //Por entregar
        $compras->crear($descripcion->codigo,$descripcion->fecha_compra,$descripcion->fecha_entrega,$descripcion->total,$descripcion->estado,$descripcion->proveedor,$estado);
        /*Capturar la ultima compra */
        $compras->ultima_compra();
        foreach ($compras->objetos as $objeto) {
            $id_compra = $objeto->ultima_compra;
        }
        foreach ($productos as $prod) {
            $lote -> crear_lote($prod->codigo,$prod->cantidad,$prod->vencimiento,$prod->precio,$id_compra,$prod->id);
        }
        echo 'agregado';
    }
    
    if ($_POST["funcion"] =='listar_compras') {
        $compras->listar_compras();
        $cont = 0;
        foreach ($compras->objetos as $objeto) {
            $cont ++;
            $json[] = array(
                'numeracion'=>$cont,
                'codigo'=>$objeto->codigo,
                'fecha_compra'=>$objeto->fecha_compra,
                'fecha_entrega'=>$objeto->fecha_entrega,
                'total'=>'S/ '.$objeto->total,
                'estado'=>$objeto->estado,
                'proveedor'=>$objeto->proveedor,
                'estado_pedido'=>$objeto->estado_pedido
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
   
    }
    
    if ($_POST["funcion"] =='edit_est') {
        $id_compra = $_POST['id_compra'];
        $id_estado = $_POST['id_estado'];
        $compras->editar_estado($id_compra,$id_estado);
        echo 'edit';
    }
    
    if ($_POST["funcion"] =='cambiar_Estado_compra') {
        $id = $_POST['id'];
        $id_estado = $_POST['estado_entrega'];
        $compras->cambiar_Estado_compra($id,$id_estado);
        echo 'edit';
    }
    
    if ($_POST["funcion"] =='imprimir_cmp') {
        $id_compra = $_POST['id'];
        $compras -> obtenerDatos($id_compra);
        foreach ($compras->objetos as $objeto) {
            $codigo=$objeto->codigo;
            $fecha_compra=$objeto->fecha_compra;
            $fecha_entrega=$objeto->fecha_entrega;
            $total=$objeto->total;
            $estado=$objeto->estado;
            $proveedor=$objeto->proveedor;
            $telefono=$objeto->telefono;
            $correo=$objeto->correo;
            $direccion=$objeto->direccion;
            $avatar='../img/prov/'.$objeto->avatar;
        }
        $lote ->ver_cmp($id_compra);
        $plantilla='
                <body>
                <header class="clearfix">
                <div id="logo">
                    <img src="'.$avatar.'" width="60" height="60">
                </div>
                <h1>COMPRA N. '.$codigo.'</h1>
                <div id="company" class="clearfix">
                    <div id="negocio">'.$proveedor.'</div>
                    <div>'.$direccion.'</div>
                    <div>'.$telefono.'</div>
                    <div><a href="mailto:company@example.com">'.$correo.'</a></div>
                </div>';
                $plantilla.='
                
                <div id="project">
                    <div><span>Codigo de compra: </span>'.$codigo.'</div>
                    <div><span>Fecha compra: </span>'.$fecha_compra.'</div>
                    <div><span>Fecha entrega: </span>'.$fecha_entrega.'</div>
                    <div><span>Estado: </span>'.$estado.'</div>
                </div>';
                
                $plantilla.='
                </header>
                <main>
                <table>
                    <thead>
                    <tr>
                    
                        <th class="service">#</th>
                        <th class="service">Codigo</th>
                        <th class="service">Cantidad</th>
                        <th class="service">Vencimiento</th>
                        <th class="service">Precio de compra</th>
                        <th class="service">Producto</th>
                        <th class="service">Laboratorio</th>
                        <th class="service">Presentacion</th>
                        <th class="service">Tipo</th>
                    </tr>
                    </thead>
                    <tbody>';
                    foreach ($lote->objetos as $objeto) {
                    
                    $plantilla.='<tr>
                        
                        <td class="servic">'.$objeto->producto.'</td>
                        <td class="servic">'.$objeto->codigo.'</td>
                        <td class="servic">'.$objeto->cantidad.'</td>
                        <td class="servic">'.$objeto->vencimiento.'</td>
                        <td class="servic">'.$objeto->precio_compra.'</td>
                        <td class="servic">'.$objeto->producto.'|'.$objeto->concentracion.'|'.$objeto->adicional.'</td>
                        <td class="servic">'.$objeto->laboratorio.'</td>
                        <td class="servic">'.$objeto->presentacion.'</td>
                        <td class="servic">'.$objeto->tipo.'</td>
                    </tr>';
                    }
            
                    $igv=$total*0.18;
                    $sub=$total-$igv;
                    
                    $plantilla.='
                    <tr>
                        <td colspan="8" class="grand total">SUBTOTAL</td>
                        <td class="grand total">S/.'.$sub.'</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="grand total">IGV(18%)</td>
                        <td class="grand total">S/.'.$igv.'</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="grand total">TOTAL</td>
                        <td class="grand total">S/.'.$total.'</td>
                    </tr>';
            
            
                $plantilla.='
                    </tbody>
                </table>
                <div id="notices">
                    <div>NOTICE:</div>
                    <div class="notice">*.</div>
            
                </div>
                </main>
                <footer>
                Created by Warpiece (Juan Diego Polo Cosme) Ingeniero Informatico y Analista desarrollador.
                </footer>
            </body>';
        $css = file_get_contents('../css/dist/pdf_cmp.css');
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output('../pdf/pdf-compra-'.$id_compra.'.pdf','F');
    }
    
    /*============================
    NOTIFICACIONES
    =============================*/
    if ($_POST['funcion'] == 'mostrar_ntf') { /*Si esta petición que estamos haciendo se llama buscar_usuario */
        $json = array();
        $compras->mostrar_ntf();
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        $fecha_actual = new DateTime($fecha);
        foreach ($compras->objetos as $objeto) {
            $vencimiento = new DateTime($objeto->fecha_entrega);
            $diferencia = $vencimiento->diff($fecha_actual);
            $anio = $diferencia->y;
            $mes = $diferencia->m;
            $dia = $diferencia->d;
            $verificado = $diferencia->invert;
            $estado = 'light';
            if ($verificado == 0) {
                $estado = 'danger';
                $mes = $mes * (-1);
                $dia = $dia * (-1);
                if ($mes == 0 && $dia==0) {
                    $estado = 'warning';
                }
                if ($mes > 0 && $dia>0) {
                    $estado = 'danger';
                }
            }else{

                if ($mes > 0 && $dia > 1) {
                    $estado = 'warning';
                }
                if($mes == 0 && $dia==0){
                    $estado = 'light';
                }
            }
            $json[] = array(
                'id'=>$objeto->id,
                'codigo'=>$objeto->codigo,
                'fecha_entrega'=>$objeto->fecha_entrega,
                'mes'=>$mes,
                'dia'=>$dia,
                'estado'=>$estado,
                'verificado'=>$verificado
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
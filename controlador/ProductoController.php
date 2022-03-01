<?php
include '../modelo/Producto.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\XLsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Fill;
use PhpOffice\PhpSpreadsheet\Border;
$producto = new Producto();
    /*===========================
    REGISTRAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"] == 'crear') {
        $nombre = $_POST["nombre"];
        $concentracion = $_POST["concentracion"];
        $adicional = $_POST["adicional"];
        $precio = $_POST["precio"];
        $laboratorio = $_POST["laboratorio"];
        $tipo = $_POST["tipo"];
        $presentacion = $_POST["presentacion"];
        $avatar = 'anonymous.png';
        $producto -> crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar);
    }
    /*===========================
    EDITAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"] == 'editar') {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $concentracion = $_POST["concentracion"];
        $adicional = $_POST["adicional"];
        $precio = $_POST["precio"];
        $laboratorio = $_POST["laboratorio"];
        $tipo = $_POST["tipo"];
        $presentacion = $_POST["presentacion"];
        $producto -> editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion);
    }
    /*===========================
    BUSCAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"] == 'buscar') {
        $producto -> buscar();
        $json = array();
        foreach ($producto->objetos as $objeto) {
            /*==========STOCK EN TOTAL==========*/
            $id_producto = $objeto->id_producto;
            // $producto -> stock_producto($id_producto);
            // foreach ($producto->objetos as $obj) {
            //         $total = $obj->total;
            // }

            if (!empty($producto -> stock_producto($id_producto))) {
                
                foreach ($producto->objetos as $obj) {
                        $total = $obj->total;
                }

            }else{
                $total = 'Sin stock';
            }

            $json[] = array(
                'id'=>$objeto->id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>$total,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion,
                'laboratorio_id'=>$objeto->prod_lab,
                'tipo_id'=>$objeto->prod_tip_prod,
                'presentacion_id'=>$objeto->prod_present,
                // 'estado_pedido'=>$objeto->estado_pedido,
                'avatar'=>$objeto->avatar
            );
        }
            $jsonstring = json_encode($json);
            echo $jsonstring;
    }
    /*===========================
    BUSCAR PRODUCTO EN CATALAGO
    =============================*/
    if ($_POST["funcion"] == 'buscar_catalago') {
        $producto -> buscar_catalago();
        $json = array();
        foreach ($producto->objetos as $objeto) {
            /*==========STOCK EN TOTAL==========*/
            $id_producto = $objeto->id_producto;
            // $producto -> stock_producto($id_producto);
            // foreach ($producto->objetos as $obj) {
            //         $total = $obj->total;
            // }
            if (!empty($producto -> stock_producto($id_producto))) {
                
                foreach ($producto->objetos as $obj) {
                        $total = $obj->total;
                }
                
            }else{
                $total = 'Sin stock';
            }
            $json[] = array(
                'id'=>$objeto->id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>$total,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion,
                'laboratorio_id'=>$objeto->prod_lab,
                'tipo_id'=>$objeto->prod_tip_prod,
                'presentacion_id'=>$objeto->prod_present,
                'avatar'=>$objeto->avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*===========================
    EDITAR AVATAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"]=='cambiar_avatar') {
        $id = $_POST["id_logo_prod"];
        $nombre = uniqid().'-'.$_FILES["photo"]["name"];
        $ruta = '../img/prod/'.$nombre;
        move_uploaded_file($_FILES["photo"]["tmp_name"],$ruta);
        $producto -> cambiar_avatar($id,$nombre);
        foreach ($producto->objetos as $objeto) {
            if ($objeto->avatar != 'anonymous.png') {
                unlink('../img/prod/'.$objeto->avatar);
            }
        }
        $json = array();
        $json[] = array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    /*===========================
    ELIMINAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"] == 'eliminar') {
        $id = $_POST["id"];
        $avatar = $_POST["avatar"];
        $producto -> eliminar_producto($id,$avatar);
    }
    /*===========================
    BUSCAR PRODUCTO POR ID
    =============================*/
    if ($_POST["funcion"] == 'buscar_id') {
        $id = $_POST["id_producto"];
        $producto -> buscar_id($id);
        $json = array();
        foreach ($producto->objetos as $objeto) {
            /*==========STOCK EN TOTAL==========*/
            $id_producto = $objeto->id_producto;
            $producto -> stock_producto($id_producto);
            foreach ($producto->objetos as $obj) {
                    $total = $obj->total;
            }
            $json[] = array(
                'id'=>$objeto->id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>$total,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion,
                'laboratorio_id'=>$objeto->prod_lab,
                'tipo_id'=>$objeto->prod_tip_prod,
                'presentacion_id'=>$objeto->prod_present,
                'avatar'=>'../img/prod/'.$objeto->avatar
            );
        }
        $jsonstring = json_encode($json[0]);/*Porque enviamos 1 por 1 */
        echo $jsonstring;
    }
    /*===========================
    VALIDAR SI HAY STOCK DEL PRODUCTO
    =============================*/
    if ($_POST["funcion"] =='verificar_stock') {
        $error = 0;
        $productos = json_decode($_POST['productos']);
        foreach ($productos as $objeto) {
            $producto->stock_producto($objeto->id);
            foreach ($producto->objetos as $obj) {
                $total = $obj->total;
            }
            if ($total>=$objeto->cantidad && $objeto->cantidad>0) {
                $error=$error+0;
            }else{
                $error=$error+1;
            }
        }
        echo $error;
    }
    /*===========================
    RECUPERAR LOCALSTORAGE AL CARRITO COMPRA
    =============================*/
    if ($_POST["funcion"] =='traer_productos') {
        $html = "";
        $productos = json_decode($_POST['productos']);
        foreach ($productos as $resultado) {
            $producto->buscar_id($resultado->id);
            foreach ($producto->objetos as $objeto) {
                $subtotal = $objeto->precio * $resultado->cantidad;
                $producto->stock_producto($objeto->id_producto);
                foreach ($producto->objetos as $obj) {
                    $stock = $obj->total;
                }
                $subtales = number_format($subtotal, 2);
                $html .= "
                    <tr prodId='$objeto->id_producto' prodPrecio='$objeto->precio'>
                        <td>$objeto->nombre</td>
                        <td>$stock</td>
                        <td class='precio'>$objeto->precio</td>
                        <td>$objeto->concentracion</td>
                        <td>$objeto->adicional</td>
                        <td>$objeto->laboratorio</td>
                        <td>$objeto->presentacion</td>
                        <td>
                            <input type='number' class='form-control cantidad_producto' min='1' value='$resultado->cantidad'>
                        </td>
                        <td class='subtotales'>
                            <h5>$/$subtales</h5>
                        </td>
                        <td>
                            <button class='borrar_producto btn btn-danger'><i class='fas fa-times-circle'></i></button>
                        </td>
                    </tr>
                
                ";
            }
           
        }
        echo $html;
    }

    /*===========================
    REPORTES DE PRODUCTOS EN PDF 
    =============================*/
    if ($_POST["funcion"] =='reporte_productos') {

        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');

        $html = '
        
            <header>

                <div id="logo">

                    <img src="../img/plantilla/logo.png" width="60" height="60">
                
                </div>

                <h1>REPORTE DE PRODUCTOS</h1>
                <div id="project">
                    <div>
                        <span>Fecha y Hora: </span>'.$fecha.'

                    </div>
                </div>

            </header>

            <table>

                <thead>

                    <tr>
                        <th>N°</th>
                        <th>Producto</th>
                        <th>Concentración</th>
                        <th>Adicional</th>
                        <th>Laboratorio</th>
                        <th>Presentación</th>
                        <th>Tipo</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>

                </thead>

                <tbody> 
        ';
        $producto->reporte_productos();
        $contador = 0;
        foreach ($producto->objetos as $objeto) {
            $contador ++;
            $producto -> stock_producto($objeto->id_producto);
            if (!empty($producto->objetos)) {
                foreach ($producto->objetos as $obj) {
                    $stock = $obj->total;
                    // $estado_pedido = $obj->estado_pedido;
                }
            }else{
                $stock = 0;
            }
            $html.='
            
                <tr>
                    <td class="servic">'.$contador.'</td>
                    <td class="servic">'.$objeto->nombre.'</td>
                    <td class="servic">'.$objeto->concentracion.'</td>
                    <td class="servic">'.$objeto->adicional.'</td>
                    <td class="servic">'.$objeto->laboratorio.'</td>
                    <td class="servic">'.$objeto->presentacion.'</td>
                    <td class="servic">'.$objeto->tipo.'</td>';
                    // if ($stock == NULL && $estado_pedido == NULL) {
                    //     $html.='<td class="servic">0</td>';
                    // }else if ($stock != NULL && $estado_pedido == 'PE') {
                    //     $html.='<td class="servic">0</td>';
                    // }else{
                    //     $html.='<td class="servic">'.$stock.'</td>';
                    // }
                    $html.='<td class="servic">'.$stock.'</td>';
         
        $html.='<td class="servic"> S/ '.$objeto->precio.'</td>
                </tr>
            
            ';
        }

        $html.='
                </tbody>

                            
            </table>
        
        ';
        $css = file_get_contents('../css/dist/pdf.css');
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output('../pdf/pdf-'.$_POST["funcion"].'.pdf','F');
           
    }

    /*===========================
    REPORTES DE PRODUCTOS EN PDF 
    =============================*/
    if ($_POST["funcion"] =='button_reportes_excel') {
        $nombre_archivo = 'reporte_productos.xlsx';
        $producto->reporte_productos();
        $contador = 0;
        $stok_total = '';
        foreach ($producto->objetos as $objeto) {
            $contador ++;
            $producto -> stock_producto($objeto->id_producto);
            if (!empty($producto->objetos)) {
                foreach ($producto->objetos as $obj) {
                    $stock = $obj->total;
                }
            }else{
                $stock = 0;
            }
            // foreach ($producto->objetos as $obj) {
            //         $stock = $obj->total;
            //         $estado_pedido = $obj->estado_pedido;
            // }
            
            // if ($stock == NULL && $estado_pedido == NULL) {
            //     $stok_total = 0;
            // }else if ($stock != NULL && $estado_pedido == 'PE') {
            //     $stok_total = 0;
            // }else{
            //     $stok_total = $stock;
            // }

            $json[] = array(
                'N°'=>$objeto->id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'laboratorio'=>$objeto->laboratorio,
                'presentacion'=>$objeto->presentacion,
                'tipo'=>$objeto->tipo,
                'stock'=>$stock,
                'precio'=>$objeto->precio
            );
        }
        $spreadsheet = new Spreadsheet();
        $Sheet = $spreadsheet->getActiveSheet();
        $Sheet->setTitle('Reporte de productos');
        $Sheet->setCellValue('A1','Reporte de productos en Excel');
        $Sheet->getStyle('A1')->getFont()->setSize(17); //Estilo del titulo
        $Sheet->fromArray(array_keys($json[0]),NULL,'A4');
        $Sheet->getStyle('A4:I4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('2D9F39');
            $Sheet->getStyle('A4:I4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            /*LENADO DE LAS TABLAS */
            foreach ($json as $key => $producto) {
                $celda = (int)$key+5;//Distancia entre celdas
                /*======= PRODUCTOS SIN STOCK ======= */
                if ($producto['stock'] =='') {
                    $Sheet->getStyle('A'.$celda.':I'.$celda)
                    ->getFont()
                    ->getColor()
                    ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                }
                $Sheet -> setCellValue('A'.$celda,$producto['N°']);
                $Sheet -> setCellValue('B'.$celda,$producto['nombre']);
                $Sheet -> setCellValue('C'.$celda,$producto['concentracion']);
                $Sheet -> setCellValue('D'.$celda,$producto['adicional']);
                $Sheet -> setCellValue('E'.$celda,$producto['laboratorio']);
                $Sheet -> setCellValue('F'.$celda,$producto['presentacion']);
                $Sheet -> setCellValue('G'.$celda,$producto['tipo']);
                $Sheet -> setCellValue('H'.$celda,$producto['stock']);
                $Sheet -> setCellValue('I'.$celda,$producto['precio']);
            }
            foreach (range('B','I') as $col) {

                $Sheet->getColumnDimension($col)->setAutoSize(true);
            }
        $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
        $writer->save('../excel/'.$nombre_archivo);
    }
    /*===========================
    RELLENAR PRODUCTO 
    =============================*/
    if ($_POST["funcion"] == 'rellenar_producto') {
        $producto -> rellenar_producto();
        foreach ($producto->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_producto,
                'nombre'=>$objeto->id_producto.' | '.$objeto->nombre.' | '.$objeto->concentracion.' | '.$objeto->adicional.' | '.$objeto->laboratorio.' | '.$objeto->presentacion
            );
        }
        $jsonstring = json_encode($json);/*Va ver muchos usuarios */
        echo $jsonstring;
     
    }
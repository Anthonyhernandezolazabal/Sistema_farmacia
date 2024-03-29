$(document).ready(function(){
    recuperarLS_carrito();
    contar_producto();
    recuperarLS_compra();
    calcularTotal();
    fecha_actual();
    /*===========================
    AGREGAR LOS PRODUCTOS AL CARRITO
    =============================*/
    $(document).on('click','.agregar-carrito',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        let id = $(elemento).attr('prodId');
        let stock = $(elemento).attr('prod_stock');
        let nombre = $(elemento).attr('proNombre');
        let concentracion = $(elemento).attr('prodConcentracion');
        let adicional = $(elemento).attr('prodAdicional');
        let precio = $(elemento).attr('prodPrecio');
        let laboratorio = $(elemento).attr('laboratorio');
        let tipo = $(elemento).attr('prodTipo');
        let presentacion = $(elemento).attr('presentacion');
        let avatar = $(elemento).attr('prodAvatar');
        const producto = {
            'id':id,
            'stock':stock,
            'nombre':nombre,
            'concentracion':concentracion,
            'adicional':adicional,
            'precio':precio,
            'laboratorio':laboratorio,
            'tipo':tipo,
            'presentacion':presentacion,
            'avatar':avatar,
            'cantidad':1
        }
        let id_producto;
        let productos;
        productos = recuperarLS();
        productos.forEach(prod => {
            if (prod.id === producto.id) {
                id_producto = prod.id;
            }
        });
        if (id_producto == producto.id) {

            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Oops...',
                text: 'El producto ya fué agregado!',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            template = `
            <tr prodId="${producto.id}">
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.concentracion}</td>
                <td>${producto.adicional}</td>
                <td>${producto.precio}</td>
                <td>
                    <button class="quitar btn btn-danger"><i class="fas fa-times-circle"></i></button>
                </td>
            </tr>
        `;
        $("#listar").append(template);
        agregarLS(producto);
        contar_producto();
        }
    })
    /*===========================
    QUITAR PRODUCTOS DEL CARRO
    =============================*/
    $(document).on("click",'.quitar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr("prodId");
        elemento.remove();
        eleminar_producto_lS(id);
        contar_producto();
        calcularTotal();
    })
     /*===========================
    QUITAR TODO LOS PRODUCTOS DEL CARRO
    =============================*/
    $(document).on("click",'#vaciar-carrito',(e)=>{
        $("#listar").empty();/*selecciona el elemento y borra todo los elementos que contienen*/
        eliminarLS();
        contar_producto();
        calcularTotal();
    })
    /*===========================
    PROCESAR PEDIDO
    =============================*/
    $(document).on('click','#procesar-pedido',(e)=>{
        procesar_pedido();
    })
    /*===========================
    REALIZAR COMPRA
    =============================*/
    $(document).on('click','#procesar-compra',(e)=>{
        procesar_compra();
    })

    /*===========================
    RECUPERAR LOS PRODUCTOS AL LOCAL STORAGE
    =============================*/
    function recuperarLS(){
        let productos; /*variables va ser retornada */
        if (localStorage.getItem('productos')===null/*hace una comparación mas estricta entre tipo de datos */) { /*verificar si hay informacion con el nombre productos*/
            productos = [];
        }else{/*contiene algo */
            /*asignarle a productos todo los productos asignados al localstorage*/
            productos=JSON.parse(localStorage.getItem("productos"));
        }
        return productos;

        /*CON ESTA FUNCIÓN VOY A SABER SI EL LOCALSTORAGE NO CONTIENE PRODUCTOS O YA LOS TIENE */
    }
    /*===========================
    AGREGAR LOS PRODUCTOS AL LOCAL STORAGE
    =============================*/
    function agregarLS(producto){
        let productos = recuperarLS(); /*tengo productos como objetos */
        productos.push(producto)/*introduzco un objeto dentro de una lista de objetos */
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    /*===========================
    RECUPERAR LOCALSTORAGE AL CARRITO
    =============================*/
    function recuperarLS_carrito(){
        let productos,id_producto;
        productos = recuperarLS();
        funcion = 'buscar_id';
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('controlador/ProductoController.php',{funcion,id_producto},(response)=>{
                let template_carrito = '';
                const json = JSON.parse(response);
                template_carrito = `
                <tr prodId="${producto.id}">
                    <td>${json.id}</td>
                    <td>${json.nombre}</td>
                    <td>${json.concentracion}</td>
                    <td>${json.adicional}</td>
                    <td>$/${json.precio}</td>
                    <td>
                        <button class="quitar btn btn-danger"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>`;
                
            $("#listar").append(template_carrito);
            })
        });
    }
    /*===========================
    ELIMINAR EL PRODUCTO DEL LOCASLTORAGE
    =============================*/
    function eleminar_producto_lS(id){
        let productos;
        productos = recuperarLS();
        productos.forEach(function(producto,indice) {
            if(producto.id === id){
                productos.splice(indice,1);
                /*splice= elimina elemento mediante su indice
                Queremos que ns elimine solo ese elemento */
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    /*===========================
    VACIAR TODO LOS PRODUCTO DEL LOCASLTORAGE
    =============================*/
    function eliminarLS(){
        localStorage.clear(); /*Elimina todo del localstorage */
    }
    /*===========================
    CONTARDOR EN EL LOCALSTORAGE
    =============================*/
    function contar_producto(){
        let productos;
        let contador = 0;
        productos = recuperarLS();
        productos.forEach(producto => {
           contador ++
        });
        $("#contar").html(contador);
    }
    /*===========================
    FUNCION PROCESAR PEDIDO
    =============================*/
    function procesar_pedido(){
        /*SI ESTÁ VACIÓ EL CARRO NO PODRÁ PASAR A LA SIGUIENTE PÁGINA */
        let productos;
        productos = recuperarLS(); /*Contiene todo los porductos en el localstorage */
        if (productos.length===0) { /*Vemos si productos está vacíos */
            
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Oops...',
                text: 'El carrito está vacío!',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            location.href='compra';
        }
    }
    /*===========================
    MOSTRAR DATOS EN LA TABLA PROCESAR COMPRA
    =============================*/
    function recuperarLS_compra(){
        let productos,id_producto;
        productos = recuperarLS();
        funcion = 'buscar_id';
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('controlador/ProductoController.php',{funcion,id_producto},(response)=>{
                let template_compra = '';
                const json = JSON.parse(response);
                
                console.log('json2',json);
               
                template_compra = `
                    <tr prodId="${producto.id}" prodPrecio="${json.precio}">
                        <td>${json.nombre}</td>
                        <td>${json.stock}</td>
                        <td class="precio">${json.precio}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.laboratorio}</td>
                        <td>${json.presentacion}</td>
                        <td>
                            <input type="number" class="form-control cantidad_producto" min="1" value="${producto.cantidad}">
                        </td>
                        <td class="subtotales">
                            <h5>$/${json.precio * producto.cantidad}</h5>
                        </td>
                        <td>
                            <button class="quitar btn btn-danger"><i class="fas fa-times-circle"></i></button>
                        </td>
                    </tr>`;
               
            $("#lista-compra").append(template_compra);
            })
        });
    }

    /*===========================
    BOTON ACTUALIZAR 
    =============================*/
    $(document).on("click","#actualizar",(e)=>{
        let productos,precios;
        precios=document.querySelectorAll('.precio');
        productos= recuperarLS();
        productos.forEach(function(prod,indice) {
            prod.precio = precios[indice].textContent;
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    })
    /*===========================
    OPERACIÒN DE PRECIO * CANTIDAD
    =============================*/
    $("#cp").keyup((e)=>{
        let id,cantidad,producto,productos,monto,precio;
        producto = $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr("prodId");
        precio = $(producto).attr("prodPrecio");
        cantidad = producto.querySelector('input').value;
        monto = document.querySelectorAll('.subtotales');
        productos = recuperarLS();
        productos.forEach(function(prod,indice) {
            if (prod.id === id) {
                prod.cantidad = cantidad;
                prod.precio = precio;
                monto[indice].innerHTML = `<h5>$/${cantidad*precio}</h5>`;
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    })
    /*===========================
    CALCULAR TOTAL
    =============================*/
    function calcularTotal(){
        let productos,subtotal,con_igv,total_sin_descuento,pago,vuelto,descuento;
        let total=0,igv=0.18;
        productos=recuperarLS();
        productos.forEach(producto=>{
            let subtotal_producto = Number(producto.precio*producto.cantidad);
            total=total+subtotal_producto;
        });
        pago=$('#pago').val();
        descuento=$('#descuento').val();

        total_sin_descuento=total.toFixed(2);
        con_igv=parseFloat(total*igv).toFixed(2);
        subtotal=parseFloat(total-con_igv).toFixed(2);

        total=total-descuento;
        vuelto=pago-total;

        $("#subtotal").html(subtotal);
        $("#con_igv").html(con_igv);
        $("#total_sin_descuento").html(total_sin_descuento);
        $("#total").html(total);
        $("#vuelto").html(vuelto);
    }
    /*===========================
    PROCESAR COMPRA
    =============================*/
    function procesar_compra(){
        let nombre,dni;
        nombre = $("#cliente").val();
        dni = $("#dni").val();
        /*======= VALIDAR SI EL CARRITO TIENE PRODUCTO ========*/
        if (recuperarLS().length == 0) {

            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Oops...',
                text: 'No hay productos, seleccione algunos',
                showConfirmButton: false,
                timer: 1800
            }).then(function(){
                location.href = 'catalago';
            });
        }else 
        /*======= VALIDAR SI HEMOS REGISTRADO AL CLIENTE ========*/
        if(nombre==""){
             Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Oops...',
                text: 'Necesitamos un nombre de cliente',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            /*======= VALIDAR SI HAY STOCK DEL PRODUCTO ========*/
            verificar_stock().then(error=>{
                if (error==0) {
                    /*======= REGISTRAR COMPRA ========*/
                    registrar_compra(nombre,dni);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se realizó la compra',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        eliminarLS();
                        location.href = 'catalago';
                    })
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Hay conflico en el stock de algún producto',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
    }
    /*======= VALIDAR SI HAY STOCK DEL PRODUCTO ========*/
        // SOLUCIÓN SINCRONA
    // function verificar_stock(){
    //     let productos,id,cantidad;
    //     let error=0;
    //     funcion = 'verificar_stock';
    //     productos = recuperarLS();
    //     productos.forEach(producto => {
    //         id = producto.id;
    //         cantidad = producto.cantidad;  
    //         $.ajax({
    //             url: '../controlador/ProductoController.php',
    //             data: {funcion,id,cantidad},
    //             type: 'POST',
    //             async: false,
    //             success: function(response){
    //                 error = error + Number(response);
    //             }
    //         })
    //     });
    //     return error;
    // }
        // SOLUCIÓN OPTIMA
    async function verificar_stock(){ /*El await funciona solo con funciones asincronas */
        let productos;
        funcion = 'verificar_stock';
        productos = recuperarLS();
        const response = await fetch('controlador/ProductoController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let error = await response.text(); /*nos envien solamente texto. */
        return error;
    }
    /*===========================
    REGISTRAR VENTA
    =============================*/
    function registrar_compra(nombre,dni){
        funcion = 'registrar_compra'
        /*======= OBTENER EL TOTAL DE LA VENTA ========*/
        let total = $('#total').get(0).textContent; /*voy a escoger el primer dato que es 0 y voy acceder a su contenido */
        let productos=recuperarLS();
        let json = JSON.stringify(productos);
        $.post('controlador/CompraController.php',{funcion,total,nombre,dni,json},(response)=>{
            
        })
    }
    function fecha_actual() {

        let fecha = new Date();
        let f = fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear();
        $('#fecha_actual').html(f);
        
    }
})
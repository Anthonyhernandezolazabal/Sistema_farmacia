$(document).ready(function () {
  mostrar_ntf();
  if ($("#cat-carrito").val() == "mostrar_carrito_compra") {
    $("#carr_none").show();
    $("#mostrar_ntf_hd").show();
  } else {
    $("#carr_none").hide();
    $("#mostrar_ntf_hd").hide();
  }
  var funcion = "";
  buscar_producto();
  mostrar_lotes_riesgo();
  /*===========================
    MOSTRAR LOS LOTES DE RIESGOS
    =============================*/
  function mostrar_lotes_riesgo() {
    funcion = "buscar_lote_riesgos";
    $.post("controlador/LoteController.php", { funcion }, (response) => {
      const lotes_riesgo = JSON.parse(response);
      // let template = '';
      // let numLote= 0;
      // lotes_riesgo.forEach(lote => {
      //     numLote ++;
      //     if(lote.estado == 'warning'){
      //         template+=`
      //         <tr class='table-warning'>
      //             <td>${lote.id_lote}</td>
      //             <td>${lote.nombre}</td>
      //             <td>${lote.stock}</td>
      //             <td>${lote.laboratorio}</td>
      //             <td>${lote.presentacion}</td>
      //             <td>${lote.proveedor}</td>
      //             <td>${lote.mes}</td>
      //             <td>${lote.dia}</td>
      //         </tr>`;
      //     }
      //     if(lote.estado == 'danger'){
      //         template+=`
      //         <tr class='table-danger'>
      //             <td>${lote.id_lote}</td>
      //             <td>${lote.nombre}</td>
      //             <td>${lote.stock}</td>
      //             <td>${lote.laboratorio}</td>
      //             <td>${lote.presentacion}</td>
      //             <td>${lote.proveedor}</td>
      //             <td>${lote.mes}</td>
      //             <td>${lote.dia}</td>
      //         </tr>`;
      //     }
      // });
      // $("#lotes_riesgo").html(template);
      $("#lotes_riesgo_tbl").DataTable({
        responsive: true,
        data: lotes_riesgo,
        columns: [
          { data: "id_lote" },
          { data: "nombre" },
          { data: "stock" },
          { data: "estado" },
          { data: "laboratorio" },
          { data: "presentacion" },
          { data: "proveedor" },
          { data: "mes" },
          { data: "dia" },
        ],
        columnDefs: [
          {
            render: function (data, type, row) {
              let campo = "";
              if (row.estado == "danger") {
                campo = `<h1 class="badge badge-danger" style='width: 100%;'>Vencido</h1>`;
              }
              if (row.estado == "warning") {
                campo = `<h1 class="badge badge-warning" style='width: 100%;'>Por vencer</h1>`;
              }
              return campo;
            },
            targets: [3],
          },
        ],
        destroy: true,
        language: espanol,
      });
    });
  }
  /*===========================
    BUSCAR PRODUCTO 
    =============================*/
  function buscar_producto(consulta) {
    funcion = "buscar_catalago";
    $.post(
      "controlador/ProductoController.php",
      { consulta, funcion },
      (response) => {
        const productos = JSON.parse(response);
        let template = "";
        productos.forEach((producto) => {
          if (producto.stock != "Sin stock") {
            template += `
                        <div prodId="${producto.id}" prod_stock="${producto.stock}" proNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" laboratorio="${producto.laboratorio}" prodLaboratorio="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" presentacion="${producto.presentacion}" prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style='width: 100%;'>`;

            if (producto.stock >= 0 && producto.stock <= 10) {
              template += `
                                <div class="card-header text-danger border-bottom-0">
                                    <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                                </div>`;
            } else if (producto.stock > 10 && producto.stock <= 20) {
              template += `
                                <div class="card-header text-warning border-bottom-0">
                                    <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                                </div>`;
            } else {
              template += `
                                <div class="card-header text-success border-bottom-0">
                                    <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                                </div>`;
            }
            template += `<div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>${producto.nombre}</b></h2>
                                            <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h4>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${producto.concentracion}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${producto.adicional}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${producto.laboratorio}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${producto.tipo}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${producto.presentacion}</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="img/prod/${producto.avatar}" alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <button class="agregar-carrito lote btn btn-sm btn-primary">
                                            <i class="fas fa-plus-square mr-2"></i>Agregar al carrito
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
          }
        });
        $("#productos_catalago").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar-producto", function () {
    var valor = $(this).val();
    if (valor != "") {
      buscar_producto(valor);
    } else {
      buscar_producto();
    }
  });

function mostrar_ntf() {
    funcion = "mostrar_ntf";
    $.post("controlador/ComprasController.php", { funcion }, (response) => {
      const ntf_compras = JSON.parse(response);
      console.log("notifiii :", ntf_compras)
      let template = "";
      let contador = 0;

      if (ntf_compras.length != 0) {
        ntf_compras.forEach((ntf) => {
          contador++;
          template += `
                    <div class="dropdown-divider"></div>
                    <a href="gestioncompras" class="dropdown-item">
                        <div class="media">
                            <img src="img/plantilla/compra.png" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <b>Compra <i class="fas fa-long-arrow-alt-right"></i> ${ntf.id} | ${ntf.codigo}</b>
                                </h3>
                                <p class="text-sm"><b>F. Entrega :</b> <b><i>${ntf.fecha_entrega}</i></b></p>`;

          if (ntf.estado == "light") {
            template += ` <p class="text-sm text-muted"><h1 class="badge badge-success"><i class="fas fa-calendar-check mr-1"></i> <b>${ntf.mes} Meses</b> | <i class="far fa-clock mr-1"></i> <b>${ntf.dia} Días</b></h1></p>`;
          }
          if (ntf.estado == "warning") {
            template += ` 
            <p class="text-sm text-muted">
            
              <h1 class="badge badge-secondary">
            
                <i class="fas fa-calendar-check mr-1"></i>
                
                  <b>${ntf.mes} Meses</b> | <i class="far fa-clock mr-1"></i> <b>${ntf.dia} Días</b>
                  
                  <span class="float-right"> </span>
                  
              </h1>
              
            </p>
            <p class="text-sm text-muted"> 
            
              <h1 class="badge badge-warning" style="margin-left: -60px;"> Se ha completado el tiempo de confirmación 
                <span class="float-right"></span>
                
              </h1>
            </p>`;
          }
          if (ntf.estado == "danger") {
            template += ` 
            
            <p class="text-sm text-muted">
            
              <h1 class="badge badge-secondary">
            
                <i class="fas fa-calendar-check mr-1"></i>
                
                  <b>${ntf.mes} Meses</b> | <i class="far fa-clock mr-1"></i> <b>${ntf.dia} Días</b>
                  
                  <span class="float-right"> </span>
                  
              </h1>
              
            </p>
            
            <p class="text-sm text-muted">
            
              <h1 class="badge badge-danger" style='margin-left: -35px;'>
                
                  <b>El pedido sobrepasó la fecha limite</b>
                  
                  <span class="float-right"> </span>
                  
              </h1>
              
            </p>
            
            
            
            `;
          }

          template += `</div>
                            </div>
                        </a>`;
        });
      } else {
        $("#sin_ntf").show();
      }

      if (contador > 0) {
        $("#cont_ntf").html(contador);
      } else {
        $("#cont_ntf").hide();
      }
      $("#ntf_compras_pe").html(template);
    });
  }

});

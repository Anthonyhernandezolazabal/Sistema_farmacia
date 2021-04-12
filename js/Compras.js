$(document).ready(function () {
  listar_compras();
  rellenar_estado_pago();
  mostrar_ntf();
  var datatable;
  /*===========================
    RELLENAR CON DATOS DE LOS PROVEEDORES EN LOS LOTES
    =============================*/
  function rellenar_estado_pago() {
    funcion = "rellenar_estado_pago";
    $.post(
      "controlador/EstadoController.php",
      {
        funcion,
      },
      (response) => {
        const estados = JSON.parse(response);
        let template = "";
        template += `<option disabled="" selected="">Seleccionar un estado</option>`;
        estados.forEach((estado) => {
          template += `<option value="${estado.id}">${estado.nombre}</option>`;
        });
        $("#estado_compra_c").html(template);
      }
    );
  }

  function listar_compras() {
    funcion = "listar_compras";
    $.post(
      "controlador/ComprasController.php",
      {
        funcion,
      },
      (response) => {
        let datos = JSON.parse(response);

        datatable = $("#tbl_compra_c").DataTable({
          responsive: true,
          data: datos,
          columns: [
            { data: "numeracion" },
            { data: "codigo" },
            { data: "fecha_compra" },
            { data: "fecha_entrega" },
            { data: "total" },
            { data: "estado" },
            { data: "proveedor" },
            { data: "estado_pedido" },
            {
              defaultContent: `<button class="imprimir_cmp btn btn-secondary"><i class="fas fa-print"></i></button>
                    <button class="ver_toda_compra btn btn-info" type="button" data-toggle="modal" data-target="#vista-compraaaas"><i class="fas fa-search"></i></button>
                                        <button class="cambiar_estado_js btn btn-success" data-toggle="modal" data-target="#modal-cambiar_estado"><i class="fas fa-pencil-alt"></i></button>`,
            } /*Ya no es un dato que me trae datatable,es un elemento que será agregado por defecto */,
          ],
          columnDefs: [
            {
              render: function (data, type, row) {
                let campo = "";
                if (row.estado_pedido == "E") {
                  campo = `<h1 class="badge badge-success" style='width: 100%;'>Entregado</h1>`;
                }
                if (row.estado_pedido == "PE") {
                  campo = `<h1 class="click_crs btn_cambiar_estado_pr badge badge-warning" style='width: 100%;'>Por entregar</h1>`;
                }
                return campo;
              },
              targets: [7],
            },
          ],
          destroy: true,
          language: espanol,
        });
      }
    );
  }
  $("#tbl_compra_c tbody").on("click", ".cambiar_estado_js", function () {
    let datos = datatable.row($(this).parent()).data();
    let codigo = datos.codigo;
    codigo = codigo.split(" | ");
    let id = codigo[0];
    let estado = datos.estado;
    funcion = "cambiar_estado_co";
    $("#idddd_compr").val(id);
    // $('#estado_compra_c').val(estado).trigger('change');
    $.post(
      "controlador/EstadoController.php",
      {
        estado,
        funcion,
      },
      (response) => {
        let id_estado = JSON.parse(response);
        $("#estado_compra_c").val(id_estado[0]["id"]).trigger("change");
      }
    );
  });

  $("#tbl_compra_c tbody").on("click", ".btn_cambiar_estado_pr", function () {
    let datos = datatable.row($(this).parent()).data();
    let codigo = datos.codigo;
    codigo = codigo.split(" | ");
    let id = codigo[0];
    let estado_entrega = "E";
    let nombre_compra = datos.codigo;
    funcion = "cambiar_Estado_compra";
    Swal.queue([
      {
        title: "Cambiar estado",
        confirmButtonText: "¡ Producto entregado !",
        html:
          "Si el producto ya fue recibido, el estado pasará a <b>Entregado</b>",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          $.post(
            "controlador/ComprasController.php",
            { id, estado_entrega, funcion },
            (response) => {
              if (response == "edit") {
                Swal.fire({
                  position: "top-center",
                  html:
                    "<h2>" +
                    "La compra " +
                    "<b>" +
                    nombre_compra +
                    "</b>" +
                    " fue entregado" +
                    "</h2>",
                  showConfirmButton: false,
                  timer: 1800,
                });
                listar_compras();
                mostrar_ntf();
              } else {
                Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "Problemas en el servidor",
                  showConfirmButton: false,
                  timer: 1500,
                });
              }
            }
          );
        },
      },
    ]);
  });

  function mostrar_ntf() {
    funcion = "mostrar_ntf";
    $.post("controlador/ComprasController.php", { funcion }, (response) => {
      const ntf_compras = JSON.parse(response);
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
            template += ` <p class="text-sm text-muted"><h1 class="badge badge-warning"><i class="fas fa-calendar-check mr-1"></i> <b>${ntf.mes} Meses</b> | <i class="far fa-clock mr-1"></i> <b>${ntf.dia} Días</b><span class="float-right"></h1></span></p>`;
          }
          if (ntf.estado == "danger") {
            template += ` <p class="text-sm text-muted"><h1 class="badge badge-danger"><i class="fas fa-calendar-check mr-1"></i> <b>${ntf.mes} Meses</b> | <i class="far fa-clock mr-1"></i> <b>${ntf.dia} Días</b><span class="float-right"></h1></span></p>`;
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

  // $('#form_cambiar_estado_entrega').submit((e)=>{

  // })

  $("#form_cambiar_estado").submit((e) => {
    let id_compra = $("#idddd_compr").val();
    let id_estado = $("#estado_compra_c").val();
    funcion = "edit_est";
    $.post(
      "controlador/ComprasController.php",
      {
        id_compra,
        id_estado,
        funcion,
      },
      (response) => {
        if (response == "edit") {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Se modificó el estado del producto",
            showConfirmButton: false,
            timer: 1800,
          });
          listar_compras();
          $("#modal-cambiar_estado").modal("hide");
        } else {
          Swal.fire({
            position: "top-center",
            icon: "warning",
            title: "Error al modificar estado",
            showConfirmButton: false,
            timer: 1800,
          });
        }
      }
    );
    e.preventDefault();
  });

  /*============================
        VER COMPRAS
    =============================*/
  $("#tbl_compra_c tbody").on("click", ".ver_toda_compra", function () {
    let datos = datatable.row($(this).parent()).data();
    let codigo = datos.codigo;
    codigo = codigo.split(" | ");
    let id = codigo[0];
    let funcion = "ver_cmp";

    $("#codigo_cmp").html(datos.codigo);
    $("#fecha_compra").html(datos.fecha_compra);
    $("#fecha_entrega").html(datos.fecha_entrega);
    $("#estado_cmp").html(datos.estado);
    $("#proveedor_cmp").html(datos.proveedor);
    $("#total_cmp").html(datos.total);

    $.post(
      "controlador/LoteController.php",
      {
        funcion,
        id,
      },
      (response) => {
        let compra = JSON.parse(response);
        let template = "";
        let contarcmp = 0;
        // $("#registros").html(template);
        compra.forEach((cmp) => {
          contarcmp++;
          template += `    
                    <tr>
                        <td class="text-center">${contarcmp}</td>
                        <td class="text-center">${cmp.codigo}</td>
                        <td class="text-center">${cmp.cantidad}</td>
                        <td class="text-center">${cmp.vencimiento}</td>
                        <td class="text-center">${cmp.precio_compra}</td>
                        <td class="text-center">${cmp.producto}</td>
                        <td class="text-center">${cmp.laboratorio}</td>
                        <td class="text-center">${cmp.tipo}</td>
                        <td class="text-center">${cmp.presentacion}</td>
                    </tr>
                    `;
          $("#detalles_compras").html(template);
        });
      }
    );
  });
  /*============================
        IMPRIMIR COMPRAS
    =============================*/
  $("#tbl_compra_c tbody").on("click", ".imprimir_cmp", function () {
    let datos = datatable.row($(this).parent()).data();
    let codigo = datos.codigo;
    codigo = codigo.split(" | ");
    let id = codigo[0];
    (funcion = "imprimir_cmp"),
      mostrar_loader_reportes_gestioncompra("generarReportePDF");
    $.post(
      "controlador/ComprasController.php",
      {
        id,
        funcion,
      },
      (response) => {
        if (response == "") {
          cerrar_loader_reporte_gestioncompra("exito_reporte");
          window.open("pdf/pdf-compra-" + id + ".pdf", "_blank");
        } else {
          cerrar_loader_reporte_gestioncompra("error_reporte");
        }
      }
    );
  });

  function mostrar_loader_reportes_gestioncompra(mensaje) {
    var texto = null;
    var mostrar = false;
    switch (mensaje) {
      case "generarReportePDF":
        texto = "Generando reporte PDF";
        mostrar = true;
        break;
    }
    if (mostrar) {
      Swal.fire({
        title: "Generando Reporte",
        html: texto,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          const content = Swal.getContent();
          if (content) {
            const b = content.querySelector("b");
            b.textContent = Swal.getTimerLeft();
          }
        },
      });
    }
  }

  function cerrar_loader_reporte_gestioncompra(mensaje) {
    var texto = null;
    var mostrar = false;
    var tipo = null;
    switch (mensaje) {
      case "exito_reporte":
        tipo = "success";
        texto = "Reporte PDF generado con éxito";
        mostrar = true;
        break;
      case "error_reporte":
        tipo = "error";
        texto = "Error al generar el reporte, vuelva a intentar nuevamente";
        mostrar = true;
        break;
      default:
        Swal.close();
        break;
    }

    if (mostrar) {
      Swal.fire({
        position: "top-center",
        icon: tipo,
        title: texto,
        confirmButtonText: "Cerrar",
        showLoaderOnConfirm: true,
      });
    }
  }
});

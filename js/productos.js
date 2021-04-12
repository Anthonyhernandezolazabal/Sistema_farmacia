$(document).ready(function () {
  var funcion;
  rellenar_laboratorio();
  rellenar_tipo();
  rellenar_presentacion();
  buscar_producto();
  rellenar_proveedor();
  var edit = false;
  /*=======ACTIVAR LOS SELECT CON EL PLUGINS SELECT2=======*/
  $(".select2").select2();

  /*===========================
    RELLENAR CON DATOS LABORATORIO EN EL SELECT 
    =============================*/
  function rellenar_laboratorio() {
    funcion = "rellenar_laboratorio";

    $.post("controlador/laboratorioController.php", { funcion }, (response) => {
      const laboratorios = JSON.parse(response);
      let template = "";
      laboratorios.forEach((laboratorio) => {
        template += `<option value="${laboratorio.id_lab}">${laboratorio.nombre}</option>`;
      });
      $("#laboratorio").html(template);
    });
  }
  /*===========================
    RELLENAR CON DATOS DE TIPO EN EL SELECT 
    =============================*/
  function rellenar_tipo() {
    funcion = "rellenar_tipo";

    $.post("controlador/TipoController.php", { funcion }, (response) => {
      const tipos = JSON.parse(response);
      let template = "";
      tipos.forEach((tipo) => {
        template += `<option value="${tipo.id_tipo}">${tipo.nombre}</option>`;
      });
      $("#tipo").html(template);
    });
  }
  /*===========================
    RELLENAR CON DATOS DE LOS PROVEEDORES EN LOS LOTES
    =============================*/
  function rellenar_proveedor() {
    funcion = "rellenar_proveedor";

    $.post("controlador/ProveedorController.php", { funcion }, (response) => {
      const proveedorlote = JSON.parse(response);
      let template = "";
      proveedorlote.forEach((proveedor) => {
        template += `<option value="${proveedor.id}">${proveedor.nombre}</option>`;
      });
      $("#proveedor").html(template);
    });
  }

  /*===========================
    RELLENAR CON DATOS DE PRESENTACIÓN EN EL SELECT 
    =============================*/
  function rellenar_presentacion() {
    funcion = "rellenar_presentacion";

    $.post(
      "controlador/PresentacionController.php",
      { funcion },
      (response) => {
        const presentaciones = JSON.parse(response);
        let template = "";
        presentaciones.forEach((presentacion) => {
          template += `<option value="${presentacion.id_pres}">${presentacion.nombre}</option>`;
        });
        $("#presentacion").html(template);
      }
    );
  }
  /*===========================
    REGISTRAR PRODUCTO 
    =============================*/
  $(document).on("click", ".nuevoprod", (e) => {
    $("#form-crear-producto").trigger("reset");
    edit = false;
  });
  $("#form-crear-producto").submit((e) => {
    let id = $("#id_edit_prod").val();
    let nombre = $("#nombre-producto").val();
    let concentracion = $("#concentracion").val();
    let adicional = $("#adicional").val();
    let precio = $("#precio").val();
    let laboratorio = $("#laboratorio").val();
    let tipo = $("#tipo").val();
    let presentacion = $("#presentacion").val();
    if (edit == true) {
      funcion = "editar";
    } else {
      funcion = "crear";
    }

    if (
      nombre == "" &&
      concentracion == "" &&
      adicional == "" &&
      precio == ""
    ) {
      $("#alert_lg_nombre_prod").show();
      $("#alert_lg_nombre_prod_text").text("Este campo es obligatorio");
      $("#alert_lg_concentracion_prod").show();
      $("#alert_lg_adicional_prod").show();
      $("#alert_lg_precio_prod").show();
    } else if (
      nombre == "" ||
      concentracion == "" ||
      adicional == "" ||
      precio == "" ||
      nombre.length < 3
    ) {
      if (nombre == "") {
        $("#alert_lg_nombre_prod").show();
        $("#alert_lg_nombre_prod_text").text("Este campo es obligatorio.");
      } else if (nombre.length < 3) {
        $("#alert_lg_nombre_prod").show();
        $("#alert_lg_nombre_prod_text").text("Debe tener 2 o más caractéres.");
      } else {
        $("#alert_lg_nombre_prod").hide();
      }

      if (concentracion == "") {
        $("#alert_lg_concentracion_prod").show();
      } else {
        $("#alert_lg_concentracion_prod").hide();
      }

      if (adicional == "") {
        $("#alert_lg_adicional_prod").show();
      } else {
        $("#alert_lg_adicional_prod").hide();
      }

      if (precio == "") {
        $("#alert_lg_precio_prod").show();
      } else {
        $("#alert_lg_precio_prod").hide();
      }
    } else {
      $("#alert_lg_nombre_prod").hide();
      $("#alert_lg_concentracion_prod").hide();
      $("#alert_lg_adicional_prod").hide();
      $("#alert_lg_precio_prod").hide();
      $.post(
        "controlador/ProductoController.php",
        {
          id,
          nombre,
          concentracion,
          adicional,
          precio,
          laboratorio,
          tipo,
          presentacion,
          funcion,
        },
        (response) => {
          console.log(response);
          if (response == "add") {
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Nuevo Producto registrado",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-producto").trigger("reset");
            $("#crearproducto").modal("hide");
            buscar_producto();
          }
          if (response == "edit") {
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Producto editado",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-producto").trigger("reset");
            $("#crearproducto").modal("hide");
            buscar_producto();
          }
          if (response == "noadd" || response == "noedit") {
            Swal.fire({
              position: "top-center",
              icon: "warning",
              title: "!El Producto ya existe!",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-producto").trigger("reset");
          }
          edit = false;
        }
      );
    }
    e.preventDefault();
  });

  /*===========================
    BUSCAR PRODUCTO 
    =============================*/
  function buscar_producto(consulta) {
    funcion = "buscar";
    $.post(
      "controlador/ProductoController.php",
      { consulta, funcion },
      (response) => {
        console.log(response);
        const productos = JSON.parse(response);
        let template = "";
        productos.forEach((producto) => {
          // template += `
          //           <div prodId="${producto.id}" stock="${producto.stock}" proNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          //               <div class="card bg-light" style='width: 100%;'>
          //                   <div class="card-header text-muted border-bottom-0">
          //                   i class="fas fa-lg fa-cubes mr-1"></i>sin stock
          //                   `;
          // if (producto.estado_pedido == "PE" || producto.stock == null) {
          //   template += `<i class="fas fa-lg fa-cubes mr-1"></i>sin stock`;
          // }
          // if (producto.estado_pedido == "E" && producto.stock != null) {
          //   template += `<i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}`;
          // }
          // template += `</div>
          //                   <div class="card-body pt-0">
          template += `
                    <div prodId="${producto.id}" stock="${producto.stock}" proNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light" style='width: 100%;'>`;
                        if (producto.stock == "Sin stock") {
                          template += `
                            <div class="card-header text-danger border-bottom-0">
                                <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                            </div>
                          `;
                        }else{
                          if (producto.stock >= 0 && producto.stock<=10) {
                            template += `
                              <div class="card-header text-danger border-bottom-0">
                                  <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                              </div>`;
                          }else if (producto.stock >10 && producto.stock <= 20) {
                            template += `
                              <div class="card-header text-warning border-bottom-0">
                                  <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                              </div>`;
                          }else{
                            template += `
                              <div class="card-header text-success border-bottom-0">
                                  <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                              </div>`;
                          }
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
                                    <button class="avatar_produ btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiarlogo">
                                        <i class="fas fa-image"></i>
                                    </button>
                                    <button class="editar_produ btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crearproducto">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="borrar_prod fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
          // <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crearlote">
          //     <i class="fas fa-plus-square"></i>
          // </button>
        });
        $("#productos").html(template);
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
  /*===========================
    EDITAR AVATAR PRODUCTO 
    =============================*/
  $(document).on("click", ".avatar_produ", (e) => {
    funcion = "cambiar_avatar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("prodId");
    let nombre = $(elemento).attr("proNombre");
    let avatar = $(elemento).attr("prodAvatar");
    $("#id_logo_prod").val(id);
    $("#nombre_logo").html(nombre);
    $("#logoactual_prod").attr("src", "img/prod/" + avatar);
    $("#funcion").val(funcion);
  });
  $(".nuevaFoto_prod").change(function () {
    var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
      $(".nuevaFoto_prod").val("");
      Swal.fire({
        position: "top-center",
        icon: "error",
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        showConfirmButton: false,
        timer: 1800,
      });
    } else if (imagen["size"] > 2000000) {
      $(".nuevaFoto_prod").val("");
      Swal.fire({
        position: "top-center",
        icon: "error",
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 2MB!",
        showConfirmButton: false,
        timer: 1800,
      });
    } else {
      var datosImagen = new FileReader();
      datosImagen.readAsDataURL(imagen);
      $(datosImagen).on("load", function (event) {
        var rutaImagen = event.target.result;

        $(".previsualizar_prod").attr("src", rutaImagen);
      });
    }
  });
  $("#form-logo_produ").submit((e) => {
    var formData = new FormData($("#form-logo_produ")[0]);
    if ($("#photo_view").val() == "") {
      Swal.fire({
        position: "top-center",
        icon: "warning",
        title: "Debe seleccionar una imagen",
        showConfirmButton: false,
        timer: 1800,
      });
    } else {
      $.ajax({
        url: "controlador/ProductoController.php",
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
      }).done(function (response) {
        const json = JSON.parse(response);
        if (json.alert == "edit") {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Se cambió el avatar",
            showConfirmButton: false,
            timer: 1800,
          });
          $("#logoactual").attr("src", json.ruta);
          $("#form-logo").trigger("reset");
          $("#cambiarlogo").modal("hide");
          buscar_producto();
        }
      });
    }
    e.preventDefault();
  });
  /*===========================
    EDITAR PRODUCTO 
    =============================*/
  $(document).on("click", ".editar_produ", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let produc_id = $(elemento).attr("prodId");
    let nombre = $(elemento).attr("proNombre");
    let concentracion = $(elemento).attr("prodConcentracion");
    let adicional = $(elemento).attr("prodAdicional");
    let precio = $(elemento).attr("prodPrecio");
    let laboratorio = $(elemento).attr("prodLaboratorio");
    let tipo = $(elemento).attr("prodTipo");
    let presentacion = $(elemento).attr("prodPresentacion");
    $("#id_edit_prod").val(produc_id);
    $("#nombre-producto").val(nombre);
    $("#concentracion").val(concentracion);
    $("#adicional").val(adicional);
    $("#precio").val(precio);
    $("#laboratorio")
      .val(laboratorio)
      .trigger("change"); /*Para que pueda hacer el cambio */
    $("#tipo").val(tipo).trigger("change"); /*Para que pueda hacer el cambio */
    $("#presentacion")
      .val(presentacion)
      .trigger("change"); /*Para que pueda hacer el cambio */
    edit = true;
  });
  /*===========================
    ELIMINAR PRODUCTO 
    =============================*/
  $(document).on("click", ".borrar_prod", (e) => {
    edit == false;
    funcion = "eliminar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("prodId");
    let avatar = $(elemento).attr("prodAvatar");
    let nombre = $(elemento).attr("proNombre");
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1",
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: "¿Desea eliminar " + nombre + "?",
        text: "¡No podras revertir esto!",
        imageUrl: "img/prod/" + avatar + "",
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: "Si, borrar esto!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.value) {
          $.post(
            "controlador/ProductoController.php",
            { id, avatar, funcion },
            (response) => {
              console.log(response);

              if (response == "borrado") {
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Borrado!",
                  text: "El producto " + nombre + " fue borrado",
                  showConfirmButton: false,
                  timer: 1800,
                });
                buscar_producto();
              } else {
                Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "No se puedo borrar!",
                  text:
                    "El producto " +
                    nombre +
                    " no fue borrado porque tiene stock disponible",
                  showConfirmButton: false,
                  timer: 1800,
                });
              }
            }
          );
        }
      });
  });
  /*===========================
    AGREGAR LOTE 
    =============================*/
  $(document).on("click", ".lote", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("prodId");
    let nombre = $(elemento).attr("proNombre");
    $("#id_lote_prod").val(id);
    $("#nombre_producto_nombre").html(nombre);
  });
  /*===========================
    REGISTRAR LOTE 
    =============================*/
  // $("#form-crear-lote").submit(e=>{
  //     let id_producto = $("#id_lote_prod").val();
  //     let proveedor = $("#proveedor").val();
  //     let stock = $("#stock").val();
  //     let vencimiento = $("#vencimiento").val();
  //     funcion = 'crear';
  //     $.post('controlador/LoteController.php',{id_producto,proveedor,stock,vencimiento,funcion},(response)=>{

  //             Swal.fire({
  //                 position: 'top-center',
  //                 icon: 'success',
  //                 title: 'Nuevo lote agregado',
  //                 showConfirmButton: false,
  //                 timer: 1800
  //             })
  //             $("#form-crear-lote").trigger('reset');
  //             $("#crearlote").modal('hide');
  //             $("#laboratorio").val('').trigger('change'); /*Para que pueda hacer el cambio */
  //             $("#tipo").val('').trigger('change');/*Para que pueda hacer el cambio */
  //             $("#presentacion").val('').trigger('change');/*Para que pueda hacer el cambio */
  //             buscar_producto();
  //     })

  //     e.preventDefault();
  // })

  /*===========================
    REPORTES DE PRODUCTOS EN PDF 
    =============================*/
  $(document).on("click", "#button_reportes", (e) => {
    funcion = "reporte_productos";
    mostrar_loader_reportes("generarReportePDF");
    $.post("controlador/ProductoController.php", { funcion }, (response) => {
      if (response == "") {
        cerrar_loader_reporte("exito_reporte");
        window.open("pdf/pdf-" + funcion + ".pdf", "_blank");
      } else {
        cerrar_loader_reporte("error_reporte");
      }
    });
  });
  /*===========================
    REPORTES DE PRODUCTOS EN EXCEL 
    =============================*/
  $(document).on("click", "#button_reportes_excel", (e) => {
    funcion = "button_reportes_excel";
    // mostrar_loader_reportes('generarReportePDF');
    $.post("controlador/ProductoController.php", { funcion }, (response) => {
      console.log(response);

      if (response == "") {
        // cerrar_loader_reporte('exito_reporte')
        window.open("excel/reporte_productos.xlsx", "_blank");
      } else {
        // cerrar_loader_reporte('error_reporte')
      }
    });
  });

  function mostrar_loader_reportes(mensaje) {
    var texto = null;
    var mostrar = false;
    switch (mensaje) {
      case "generarReportePDF":
        texto = "Generando formato PDF";
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

  function cerrar_loader_reporte(mensaje) {
    var texto = null;
    var mostrar = false;
    var tipo = null;
    switch (mensaje) {
      case "exito_reporte":
        tipo = "success";
        texto = "Reporte PDF generado correctamente";
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
        showConfirmButton: false,
        timer: 1800,
      });
    }
  }
});

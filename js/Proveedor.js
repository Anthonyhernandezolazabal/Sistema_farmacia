$(document).ready(function () {
  var funcion = "";
  buscar_prov();
  var edit = false;
  function verificarCorreo($n) {
    var ExpRegular_Correo = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    return ExpRegular_Correo.test($n);
  }

  function verificarNumCel($m) {
    var ExpRegular_Num = /^[\d]+$/;
    return ExpRegular_Num.test($m);
  }

  function verificarNombre($n) {
    var ExpRegular_Nombre = /^[A-Za-zÑñÁÉÍÓÚáéíóúüÜ]+((?:[\s{1}][A-Za-zÑñÁÉÍÓÚáéíóúüÜ]+)+)?$/;
    return ExpRegular_Nombre.test($n);
  }
  /*===========================
    REGISTRAR PROVEEDOR 
    =============================*/
  $(document).on("click", ".nuevoprov", (e) => {
    $("#alert_lg_nombre_prov").hide();
    $("#alert_lg_tel_prov").hide();
    $("#alert_lg_email_prov").hide();
    $("#alert_lg_dir_prov").hide();
    $("#form-crear-proveedor").trigger("reset");
    edit = false;
  });
  $("#form-crear-proveedor").submit((e) => {
    let id = $("#id_edit_prov").val();
    let nombre = $("#nombre").val();
    let telefono = $("#telefono").val();
    let correo = $("#correo").val();
    let direccion = $("#direccion").val();
    if (edit == true) {
      funcion = "editar";
    } else {
      funcion = "crear";
    }

    if (nombre == "" && telefono == "" && correo == "" && direccion == "") {
      $("#alert_lg_nombre_prov").show();
      $("#alert_lg_nombre_prov_text").text("Este campo es obligatorio");

      $("#alert_lg_tel_prov").show();
      $("#alert_lg_tel_prov_text").text("Este campo es obligatorio");

      $("#alert_lg_email_prov").show();
      $("#alert_lg_email_prov_text").text("Este campo es obligatorio");

      $("#alert_lg_dir_prov").show();
      $("#alert_lg_dir_prov_text").text("Este campo es obligatorio");
    } else if (
      nombre == "" ||
      telefono == "" ||
      correo == "" ||
      direccion == "" ||
      nombre.length < 3 ||
      telefono.length != 9 ||
      direccion.length < 3 ||
      !verificarCorreo(correo) ||
      !verificarNumCel(telefono) ||
      !verificarNombre(nombre)
    ) {
      if (nombre == "") {
        $("#alert_lg_nombre_prov").show();
        $("#alert_lg_nombre_prov_text").text("Este campo es obligatorio.");
      } else if (!verificarNombre(nombre)) {
        $("#alert_lg_nombre_prov").show();
        $("#alert_lg_nombre_prov_text").text("Datos no válidos");
      } else if (nombre.length < 3) {
        $("#alert_lg_nombre_prov").show();
        $("#alert_lg_nombre_prov_text").text("Debe tener 2 o más caractéres.");
      } else {
        $("#alert_lg_nombre_prov").hide();
      }

      if (telefono == "") {
        $("#alert_lg_tel_prov").show();
        $("#alert_lg_tel_prov_text").text("Este campo es obligatorio.");
      } else if (!verificarNumCel(telefono)) {
        $("#alert_lg_tel_prov").show();
        $("#alert_lg_tel_prov_text").text("¡Debe ingresar sólo números!");
      } else if (telefono.length != 9) {
        $("#alert_lg_tel_prov").show();
        $("#alert_lg_tel_prov_text").text("Debe tener 9 dígitos.");
      } else {
        $("#alert_lg_tel_prov").hide();
      }

      if (correo == "") {
        $("#alert_lg_email_prov").show();
        $("#alert_lg_email_prov_text").text("Este campo es obligatorio.");
      } else if (!verificarCorreo(correo)) {
        $("#alert_lg_email_prov").show();
        $("#alert_lg_email_prov_text").text(
          'Incluye un signo "@ gmail.com/hotmail.com" en la dirección de correo electrónico'
        );
      } else {
        $("#alert_lg_email_prov").hide();
      }

      if (direccion == "") {
        $("#alert_lg_dir_prov").show();
        $("#alert_lg_dir_prov_text").text("Este campo es obligatorio.");
      } else if (direccion.length < 3) {
        $("#alert_lg_dir_prov").show();
        $("#alert_lg_dir_prov_text").text("Debe tener 2 o más caractéres.");
      } else {
        $("#alert_lg_dir_prov").hide();
      }
    } else {
      $("#alert_lg_nombre_prov").hide();
      $("#alert_lg_tel_prov").hide();
      $("#alert_lg_email_prov").hide();
      $("#alert_lg_dir_prov").hide();
      $.post(
        "controlador/ProveedorController.php",
        { id, nombre, telefono, correo, direccion, funcion },
        (response) => {
          if (response == "add") {
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Proveedor registrado",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-proveedor").trigger("reset");
            $("#crearproveedor").modal("hide");
            buscar_prov();
          }
          if (response == "edit") {
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Proveedor editado",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-proveedor").trigger("reset");
            $("#crearproveedor").modal("hide");
            buscar_prov();
          }
          if (response == "noedit" || response == "noadd") {
            Swal.fire({
              position: "top-center",
              icon: "warning",
              title: "El proveedor ya existe",
              showConfirmButton: false,
              timer: 1800,
            });
            $("#form-crear-proveedor").trigger("reset");
          }
          edit = false;
        }
      );
    }

    e.preventDefault();
  });
  /*===========================
    BUSCAR PROVEEDOR 
    =============================*/
  function buscar_prov(consulta) {
    funcion = "buscar";
    $.post(
      "controlador/ProveedorController.php",
      { consulta, funcion },
      (response) => {
        const proveedores = JSON.parse(response);
        let template = "";
        proveedores.forEach((proveedor) => {
          template += `
                <div provId="${proveedor.id}" provNombre="${proveedor.nombre}" provTelefono="${proveedor.telefono}" provCorreo="${proveedor.correo}" provDireccion="${proveedor.direccion}" provAvatar="${proveedor.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            <h1 class="badge  badge-success">Proveedor</h1>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${proveedor.nombre}</b></h2>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: ${proveedor.direccion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono: ${proveedor.telefono}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Teléfono: ${proveedor.correo}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="img/prov/${proveedor.avatar}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button class="avatar_prove btn btn-sm btn-info" title="Editar logo" type="button" data-toggle="modal" data-target="#cambiarlogo">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button class="editar_prove btn btn-sm btn-success" title="Editar proveedor" type="button" data-toggle="modal" data-target="#crearproveedor">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="borrar_prov btn btn-sm btn-danger" title="Eliminar proveedor">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
        });
        $("#proveedores").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar-proveedor", function () {
    var valor = $(this).val();
    if (valor != "") {
      buscar_prov(valor);
    } else {
      buscar_prov();
    }
  });
  /*===========================
    CAMBIAR LOGO PROVEEDOR 
    =============================*/
  $(document).on("click", ".avatar_prove", (e) => {
    funcion = "cambiar_avatar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("provId");
    let nombre = $(elemento).attr("provNombre");
    let avatar = $(elemento).attr("provAvatar");
    $("#nombre_logo").html(nombre);
    $("#logoactual_prov").attr("src", "img/prov/" + avatar);
    $("#id_logo_prov").val(id);
    $("#funcion").val(funcion);
  });

  $(".nuevaFoto_proov").change(function () {
    var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
      $(".nuevaFoto_proov").val("");
      Swal.fire({
        position: "top-center",
        icon: "error",
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        showConfirmButton: false,
        timer: 1800,
      });
    } else if (imagen["size"] > 2000000) {
      $(".nuevaFoto_proov").val("");
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

        $(".previsualizar_proov").attr("src", rutaImagen);
      });
    }
  });

  $("#form-logo_prove").submit((e) => {
    const formData = new FormData($("#form-logo_prove")[0]);
    if ($("#photo").val() == "") {
      Swal.fire({
        position: "top-center",
        icon: "warning",
        title: "Debe seleccionar una imagen",
        showConfirmButton: false,
        timer: 1800,
      });
    } else {
      $.ajax({
        url: "controlador/ProveedorController.php",
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
          $("#form-logo_prove").trigger("reset");
          $("#cambiarlogo").modal("hide");
          buscar_prov();
        }
      });
    }
    e.preventDefault();
  });
  /*===========================
    ELIMINAR PROVEEDOR 
    =============================*/
  $(document).on("click", ".borrar_prov", (e) => {
    edit = false;
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("provId");
    let nombre = $(elemento).attr("provNombre");
    let avatar = $(elemento).attr("provAvatar");
    funcion = "borrar";
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
        imageUrl: "img/prov/" + avatar + "",
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
            "controlador/ProveedorController.php",
            { id, avatar, funcion },
            (response) => {
              if (response == "borrado") {
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Borrado!",
                  text: "El proveedor " + nombre + " fue borrado.",
                  showConfirmButton: false,
                  timer: 1800,
                });
                buscar_prov();
              } else {
                Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "No se puedo borrar!",
                  text:
                    "El proveedor " +
                    nombre +
                    " no fue borrado porque está siendo usado en un lote.",
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
    EDITAR PROVEEDOR 
    =============================*/
  $(document).on("click", ".editar_prove", (e) => {
    edit = true;
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("provId");
    let nombre = $(elemento).attr("provNombre");
    let telefono = $(elemento).attr("provTelefono");
    let correo = $(elemento).attr("provCorreo");
    let direccion = $(elemento).attr("provDireccion");

    $("#nombre").val(nombre);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    $("#direccion").val(direccion);
    $("#id_edit_prov").val(id);
    e.preventDefault();
  });
});

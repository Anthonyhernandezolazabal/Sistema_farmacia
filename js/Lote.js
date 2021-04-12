$(document).ready(function () {
  var funcion = "";
  buscar_lote();
  /*===========================
    BUSCAR LOTE 
    =============================*/
  function buscar_lote(consulta) {
    funcion = "buscar_lote";
    $.post(
      "controlador/LoteController.php",
      { consulta, funcion },
      (response) => {
        const lotes = JSON.parse(response);
        let template = "";
        lotes.forEach((lote) => {
          template += `
                    <div loteId="${lote.id_lote}" lote_codigo="${lote.codigo}" loteStock="${lote.stock}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">`;
          if (lote.estado == "light") {
            template += `<div class="card bg-light" style='width: 100%;'>`;
          }
          if (lote.estado == "warning") {
            template += `<div class="card bg-warning" style='width: 100%;'>`;
          }
          if (lote.estado == "danger") {
            template += `<div class="card bg-danger" style='width: 100%;'>`;
          }
          template += `<div class="card-header border-bottom-0">
                                <h6>Código: <b>${lote.codigo}</b></h6>
                                <i class="fas fa-lg fa-cubes mr-1"></i>${lote.stock}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>${lote.nombre}</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${lote.concentracion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${lote.adicional}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${lote.laboratorio}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${lote.tipo}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${lote.presentacion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span> Vencimiento: ${lote.vencimiento}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${lote.proveedor}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> <b>Año: </b> ${lote.anio}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> <b>Mes:</b> ${lote.mes}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> <b>Dia:</b> ${lote.dia}</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="img/prod/${lote.avatar}" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button class="editar_lote btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#editarlote">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="borrar_lote btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
        });
        $("#lotes").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar-producto", function () {
    var valor = $(this).val();
    if (valor != "") {
      buscar_lote(valor);
    } else {
      buscar_lote();
    }
  });
  /*===========================
    EDITAR LOTE 
    =============================*/
  $(document).on("click", ".editar_lote", (e) => {
    let elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("loteId");
    let stock = $(elemento).attr("loteStock");
    let codigo = $(elemento).attr("lote_codigo");

    $("#codigo_lote").html(codigo);
    $("#id_lote").val(id);
    $("#stock").val(stock);
  });
  $("#form-editar-lote").submit((e) => {
    let id = $("#id_lote").val();
    let stock = $("#stock").val();
    funcion = "editar";
    $.post(
      "controlador/LoteController.php",
      { id, stock, funcion },
      (response) => {
        if (response == "edit") {
          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Lote editado",
            showConfirmButton: false,
            timer: 1800,
          });
          $("#editarlote").modal("hide");

          buscar_lote();
        }
      }
    );
    e.preventDefault();
  });
  /*===========================
    ELIMINAR LOTE 
    =============================*/
  $(document).on("click", ".borrar_lote", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement
      .parentElement.parentElement;
    let id = $(elemento).attr("loteId");
    funcion = "eliminar";
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1",
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: "¿Desea eliminar el lote " + id + "?",
        text: "No podrás revertir esto!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar esto!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.value) {
          $.post(
            "controlador/LoteController.php",
            { id, funcion },
            (response) => {
              if (response == "borrado") {
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Eliminado",
                  text: "El lote " + id + " fue eliminado.",
                  showConfirmButton: false,
                  timer: 1800,
                });
                buscar_lote();
              } else {
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Eliminado",
                  text:
                    "El lote " +
                    id +
                    " no fue eliminado porque está siendo usado.",
                  showConfirmButton: false,
                  timer: 1800,
                });
              }
            }
          );
        }
      });
  });
});

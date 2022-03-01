$(document).ready(function () {
  mostrar_consultas();
  listar_tabla_Ventas();
  var datatable;
  /*============================
    VENTA DEL DÍA POR VENDEDOR
    =============================*/
  function mostrar_consultas() {
    let funcion = "mostrar_consultas";
    $.post("controlador/VentaController.php", { funcion }, (response) => {
      const vistas = JSON.parse(response);
      $("#venta_dia_vendedor").html(
        "S/" + (vistas.venta_dia_vendedor * 1).toFixed(2)
      );
      $("#venta_diaria").html("S/" + (vistas.venta_diaria * 1).toFixed(2));
      $("#venta_mensual").html("S/" + (vistas.venta_mensual * 1).toFixed(2));
      $("#venta_anual").html("S/" + (vistas.venta_anual * 1).toFixed(2));
      $("#id_ganancia_mensual").html(
        "S/" + (vistas.ganancia_mensual * 1).toFixed(2)
      );
    });
  }

  function listar_tabla_Ventas() {
    /*============================
        TABLA DINAMICA DE VENTA
        =============================*/
    let funcion = "listar";
    // $.post('../controlador/VentaController.php',{funcion},(response)=>{
    //     console.log(JSON.parse(response));/* console.log(response);Para decodificar el string json */
    // })
    datatable = $("#tabla_venta").DataTable({
      responsive: true,
      ajax: {
        url: "controlador/VentaController.php",
        method: "POST",
        data: { funcion: funcion },
      },
      columns: [
        { data: "id_venta" },
        { data: "fecha" },
        { data: "cliente" },
        { data: "dni" },
        { data: "total" },
        { data: "vendedor" },
        {
          defaultContent: `<button class="imprimir_venta btn btn-secondary"><i class="fas fa-print"></i></button>
                                    <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista-venta"><i class="fas fa-search"></i></button>
                                    <button class="borrar_venta btn btn-danger"><i class="fas fa-window-close"></i></button>`,
        } /*Ya no es un dato que me trae datatable,es un elemento que será agregado por defecto */,
      ],
      destroy: true,
      language: espanol,
    });
  }
  /*============================
        IMPRIMIR VENTA
    =============================*/
  $("#tabla_venta tbody").on("click", ".imprimir_venta", function () {
    let datos = datatable.row($(this).parent()).data();
    let id = datos.id_venta;
    mostrar_loader_reportes_ventas("generarReportePDF");
    $.post("controlador/PDFController.php", { id }, (response) => {
      if (response == "") {
        cerrar_loader_reporte_ventas("exito_reporte");
        window.open("pdf/pdf-" + id + ".pdf", "_blank");
      } else {
        cerrar_loader_reporte_ventas("error_reporte");
      }
    });
  });

  function mostrar_loader_reportes_ventas(mensaje) {
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

  function cerrar_loader_reporte_ventas(mensaje) {
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

  /*============================
        BORRAR VENTA
    =============================*/
  $("#tabla_venta tbody").on("click", ".borrar_venta", function () {
    let datos = datatable.row($(this).parent()).data();
    let id = datos.id_venta;
    let funcion = "borrar_venta";

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success m-1",
        cancelButton: "btn btn-danger m-1",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "¿Desea eliminar la venta: " + id + "?",
        text: "¡No se podrá revertir esta acción!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.post(
            "controlador/DetalleVentaController.php",
            { funcion, id },
            (response) => {
              if (response == "delete") {
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Venta " + id + " eliminada!",
                  showConfirmButton: false,
                  timer: 1500,
                });
                listar_tabla_Ventas();
              } else if (response == "nodelete") {
                Swal.fire({
                  position: "top-center",
                  icon: "warning",
                  title: "No puedes Eliminar venta " + id,
                  text: "No tienes prioridad para eliminar esta venta",
                  showConfirmButton: false,
                  timer: 1800,
                });
              }
            }
          );
        }
      });
  });
  /*============================
        VER VENTA
    =============================*/
  $("#tabla_venta tbody").on("click", ".ver", function () {
    let funcion = "ver";
    let datos = datatable.row($(this).parent()).data();
    let id = datos.id_venta;
    $("#codigo_venta").html(datos.id_venta);

    let meses = [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre",
    ];
    let dias = [
      "Lunes",
      "Martes",
      "Miércoles",
      "Jueves",
      "Viernes",
      "Sabado",
      "Domingo",
    ];
    let date = new Date(datos.fecha);
    fecha_registro =
      dias[date.getDay() - 1] +
      " " +
      date.getDate() +
      " de " +
      meses[date.getMonth()] +
      " de " +
      date.getFullYear();
    $("#fecha").html(fecha_registro);

    var hours = date.getHours();
    var minutes = date.getMinutes();
    var segundo = date.getSeconds();
    var ampm = hours >= 12 ? "pm" : "am";
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? "0" + minutes : minutes;
    var horaImprimible = hours + ":" + minutes + ":" + segundo + " " + ampm;

    $("#hora").html(horaImprimible);

    $("#cliente").html(datos.cliente);
    $("#dni").html(datos.dni);
    $("#vendedor").html(datos.vendedor);
    $("#total").html(datos.total);
    $.post(
      "controlador/VentaProductoController.php",
      { funcion, id },
      (response) => {
        let registros = JSON.parse(response);
        let template = "";
        let contarVenta = 0;
        // $("#registros").html(template);
        registros.forEach((registro) => {
          contarVenta++;
          template += `    
                    <tr>
                        <td class="text-center">${contarVenta}</td>
                        <td class="text-center">${registro.cantidad}</td>
                        <td class="text-center">${"S/" + registro.precio}</td>
                        <td class="text-center">${registro.producto}</td>
                        <td class="text-center">${registro.concentracion}</td>
                        <td class="text-center">${registro.adicional}</td>
                        <td class="text-center">${registro.laboratorio}</td>
                        <td class="text-center">${registro.presentacion}</td>
                        <td class="text-center">${registro.tipo}</td>
                        <td class="text-center">${"S/" + registro.subtotal}</td>
                    </tr>
                    `;
          $("#registros").html(template);
        });
      }
    );
  });
});
let espanol = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
  },
};

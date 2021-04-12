$(document).ready(function () {
  rellenar_producto();
  rellenar_estado_pago();
  rellenar_proveedor();
  var prods = [];
  var cantprods = [];
  function rellenar_producto() {
    funcion = "rellenar_producto";
    $.post("controlador/ProductoController.php", { funcion }, (response) => {
      const productos = JSON.parse(response);
      let template = "";
      template += `<option disabled="" selected="">Seleccionar producto</option>`;
      productos.forEach((producto) => {
        template += `<option value="${producto.nombre}">${producto.nombre}</option>`;
      });
      $("#sl_producto_compra").html(template);
    });
  }
  function rellenar_estado_pago() {
    funcion = "rellenar_estado_pago";
    $.post("controlador/EstadoController.php", { funcion }, (response) => {
      const estados = JSON.parse(response);
      let template = "";
      template += `<option disabled="" selected="">Seleccionar un estado</option>`;
      estados.forEach((estado) => {
        template += `<option value="${estado.id}">${estado.nombre}</option>`;
      });
      $("#sl_estado_compra").html(template);
    });
  }

  function rellenar_proveedor() {
    funcion = "rellenar_proveedor";

    $.post("controlador/ProveedorController.php", { funcion }, (response) => {
      const proveedorlote = JSON.parse(response);
      let template = "";
      template += `<option disabled="" selected="">Seleccionar un proveedor</option>`;
      proveedorlote.forEach((proveedor) => {
        template += `<option value="${proveedor.id}">${proveedor.nombre}</option>`;
      });
      $("#sl_proveedor_compra").html(template);
    });
  }
  $(document).on("click", ".agregar_producto_compra", (e) => {
    let producto_select2 = $("#sl_producto_compra").val();
    let codigo_lote = $("#codigo_lote_c").val();
    let cantidad = $("#cantidad_c").val();
    let vencimiento = $("#vencimiento_c").val();
    let precio_compra = $("#precio_compra_c").val();

    let total_to = cantidad * precio_compra;

    if (cantidad != 0 && precio_compra != 0) {
      calcular_total_compra(total_to);
    }

    if (producto_select2 == null) {
      $("#alert_c_producto").show();
      $("#alert_c_producto_text").text("Elija un producto");
      setTimeout(() => {
        $("#alert_c_producto").hide();
      }, 1200);
    } else {
      if (codigo_lote == "") {
        $("#alert_c_codigo").show();
        $("#alert_c_codigo_text").text("Ingrese un código");
        setTimeout(() => {
          $("#alert_c_codigo").hide();
        }, 1200);
      } else {
        if (cantidad == "") {
          $("#alert_c_cantidad").show();
          $("#alert_c_cantidad_text").text("Ingrese una cantidad");
          setTimeout(() => {
            $("#alert_c_cantidad").hide();
          }, 1200);
        } else {
          if (vencimiento == "") {
            $("#alert_c_vencimiento").show();
            $("#alert_c_vencimiento_text").text(
              "Ingrese una Fecha de Vencimiento"
            );
            setTimeout(() => {
              $("#alert_c_vencimiento").hide();
            }, 1200);
          } else {
            if (precio_compra == "") {
              $("#alert_c_precio").show();
              $("#alert_c_precio_text").text("Ingrese un precio");
              setTimeout(() => {
                $("#alert_c_precio").hide();
              }, 1200);
            } else {
              let producto_array = producto_select2.split(" | ");
              let producto = {
                id: producto_array[0],
                nombre: producto_select2,
                codigo: codigo_lote,
                cantidad: cantidad,
                precio: precio_compra,
                vencimiento: vencimiento,
              };
              prods.push(producto);
              let template = "";
              template = `
                                    
                                    <tr prod_id="${producto.id}" cant_attr="${producto.cantidad}" to_attr="${producto.precio}">
                                        <td><span class="tag tag-success">${producto.nombre}</span></td>
                                        <td class='text-center'>${producto.codigo}</td>
                                        <td class='text-center'>${producto.cantidad}</td>
                                        <td class='text-center'>${producto.vencimiento}</td>
                                        <td class='text-center'>S/ ${producto.precio}</td>
                                        <td>
                                            <button class="borrar-producto_c btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                            
                            `;
              $("#tabla_registro_compra").append(template);
              $("#sl_producto_compra").val("").trigger("change");
              $("#codigo_lote_c").val("");
              $("#cantidad_c").val("");
              $("#vencimiento_c").val("");
              $("#precio_compra_c").val("");
            }
          }
        }
      }
    }
  });

  function calcular_total_compra(total) {
    cantprods.push(total);

    let total_sum_prod = 0,
      numeros = cantprods;
    for (let i of numeros) total_sum_prod += i;

    $("#total_c").val(parseFloat(total_sum_prod).toFixed(2));
  }

  $(document).on("click", ".borrar-producto_c", (e) => {
    let elemento = $(this)[0].activeElement.parentElement.parentElement;
    let id = $(elemento).attr("prod_id");
    let cant = $(elemento).attr("cant_attr");
    let total = $(elemento).attr("to_attr");
    let total_total = $("#total_c").val();
    prods.forEach(function (prod, index) {
      // console.log(index);
      // console.log(prod);
      if (prod.id == id) {
        prods.splice(index, 1); //que me elimine la ubicacion y que elimine es producto
      }
    });

    let t = cant * total;
    let r = total_total - t;
    $("#total_c").val(r);
    elemento.remove();
  });

  $(document).on("click", "#crear_compra_c", (e) => {
    let codigo = $("#codigo_c").val();
    let fecha_compra = $("#fecha_compra_c").val();
    let fecha_entrega = $("#fecha_entrega_c").val();
    let total = $("#total_c").val();
    let estado = $("#sl_estado_compra").val();
    let proveedor = $("#sl_proveedor_compra").val();

    if (codigo == "") {
      $("#alert_c_codigo").show();
      $("#alert_c_codigo_text").text("Ingrese código");
      setTimeout(() => {
        $("#alert_c_codigo").hide();
      }, 1200);
    } else {
      if (fecha_compra == "") {
        $("#alert_c_fcompra").show();
        $("#alert_c_fcompra_text").text("Ingrese una fecha de compra");
        setTimeout(() => {
          $("#alert_c_fcompra").hide();
        }, 1200);
      } else {
        if (fecha_entrega == "") {
          $("#alert_c_fventa").show();
          $("#alert_c_fventa_text").text("Ingrese una fecha de entrega");
          setTimeout(() => {
            $("#alert_c_fventa").hide();
          }, 1200);
        } else {
          if (total == "") {
            $("#alert_c_total").show();
            $("#alert_c_total_text").text("Ingrese un monto total");
            setTimeout(() => {
              $("#alert_c_total").hide();
            }, 1200);
          } else {
            if (estado == null) {
              $("#alert_c_estado").show();
              $("#alert_c_estado_text").text("Ingrese un estado");
              setTimeout(() => {
                $("#alert_c_estado").hide();
              }, 1200);
            } else {
              if (proveedor == null) {
                $("#alert_c_proveedodr").show();
                $("#alert_c_proveedodr_text").text("Ingrese un proveedor");
                setTimeout(() => {
                  $("#alert_c_proveedodr").hide();
                }, 1200);
              } else {
                if (prods == "") {
                  Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "No hay productos agregados",
                    showConfirmButton: false,
                    timer: 1800,
                  });
                } else {
                  let descripcion = {
                    codigo: codigo,
                    fecha_compra: fecha_compra,
                    fecha_entrega: fecha_entrega,
                    total: total,
                    estado: estado,
                    proveedor: proveedor,
                  };
                  let funcion = "registrar_compra_c";
                  let productosString = JSON.stringify(prods);
                  let descripcionString = JSON.stringify(descripcion);
                  $.post(
                    "controlador/ComprasController.php",
                    { funcion, productosString, descripcionString },
                    (response) => {
                      if (response == "agregado") {
                        Swal.fire({
                          position: "top-center",
                          icon: "success",
                          title: "Compra realizada",
                          showConfirmButton: false,
                          timer: 1800,
                        }).then(function () {
                          window.location = "gestioncompras";
                        });
                      } else {
                        Swal.fire({
                          position: "top-center",
                          icon: "error",
                          title: "Error en el servidor",
                          showConfirmButton: false,
                          timer: 1800,
                        });
                      }
                    }
                  );
                }
              }
            }
          }
        }
      }
    }
  });
});

/*-- PERMISOS DE USUARIO --*/
funcion = "tipo_usuario";
fecha_actual_compra_ntf();
$.post("controlador/UsuarioController.php", { funcion }, (response) => {
  if (response == 1) {
    $("#gestion_lote").hide();
  } else if (response == 2) {
    $("#gestion_lote").hide();
    $("#gestion_usuario").hide();
    $("#gestion_producto").hide();
    $("#almacen").hide();
    $("#compras").hide();
    $("#gestion_atributo").hide();
    $("#gestion_proveedor").hide();
    $("#gestion_compras").hide();
    $("#gestion_clientes").hide();
  }
});

$(document).on("click", "#recuperar_pass", (e) => {
  $("#recuperar_pg").show();
  $("#login_pg").hide();
  $("#alert_rc_dni").hide();
  $("#alert_rc_email").hide();

  $("#form_recuperar").trigger("reset");
  $("#aviso2").hide();
  $("#alert_prueba").hide();
});

$(document).on("click", "#recuperar_login", (e) => {
  $("#login_pg").show();
  $("#recuperar_pg").hide();

  $("#alert_lg_dni").hide();
  $("#alert_lg_pass").hide();

  $("#aviso2").hide();
  $("#alert_prueba").hide();

  $("#form_lg").trigger("reset");
});

let date = new Date();
let f = date.getDate() + "/" + date.getDay() + "/" + date.getFullYear();
$("#fecha_actual").html(f);

function fecha_actual_compra_ntf() {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
  document.getElementById("fecha_compra_c").value = ano + "-" + mes + "-" + dia;
}

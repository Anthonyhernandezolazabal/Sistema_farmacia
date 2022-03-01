/*-- PERMISOS DE USUARIO --*/
  // funcion = "tipo_usuario";
// $.post("controlador/UsuarioController.php", { funcion }, (response) => {
//   if (response == 1) {
//     $("#gestion_lote").hide();
//   } else if (response == 2) {
//     $("#gestion_lote").hide();
//     $("#gestion_usuario").hide();
//     $("#gestion_producto").hide();
//     $("#almacen").hide();
//     $("#compras").hide();
//     $("#gestion_atributo").hide();
//     $("#gestion_proveedor").hide();
//     $("#gestion_compras").hide();
//     $("#gestion_clientes").hide();
//   }
// });

$(document).on("click", "#recuperar_pass", (e) => {
  console.log("clicj");
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


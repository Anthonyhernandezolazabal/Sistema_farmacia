$(document).ready(function () {
  var funcion = "";
  /* === F. Validar DNI === */
  function validarDNI($d) {
    var ExpRegular_Num = /^[\d]+$/;
    return ExpRegular_Num.test($d);
  }

  $("#form_lg").submit((e) => {
    let dni = $("#lg_dni").val();
    let pass = $("#lg_pass").val();
    funcion = "validar_sesion";

    if (dni == "" && pass == "") {
      $("#alert_lg_dni").show();
      $("#alert_lg_dni_text").text("Ingrese su usuario.");

      $("#alert_lg_pass").show();
      $("#alert_lg_pass_text").text("Ingrese su contraseña.");
    } else if (dni == "" || pass == "" || dni.length != 8 || !validarDNI(dni)) {
      if (dni == "") {
        $("#alert_lg_dni").show();
        $("#alert_lg_dni_text").text("Ingrese su ussuario.");
      } else if (!validarDNI(dni)) {
        $("#alert_lg_dni").show();
        $("#alert_lg_dni_text").text("Debe ingresar solo números.");
      } else if (dni.length != 8) {
        $("#alert_lg_dni").show();
        $("#alert_lg_dni_text").text("Debe tener 9 dígitos.");
      } else {
        $("#alert_lg_dni").hide();
      }

      if (pass == "") {
        $("#alert_lg_pass").show();
        $("#alert_lg_pass_text").text("Ingrese su contraseña.");
      } else {
        $("#alert_lg_pass").hide();
      }
    } else {
      $("#alert_lg_dni").hide();
      $("#alert_lg_pass").hide();
      $.post(
        "Controlador/LoginController.php",
        { dni, pass, funcion },
        (response) => {
          const usuario = JSON.parse(response);

          if (usuario.datos != null) {
            $("#alrt_succ_lg").show();
            $("#form_ingreso").trigger("reset");
            setTimeout(() => {
              window.location = "catalago";
            }, 1400);
          } else {
            $("#form_lg").trigger("reset");
            $(".lg_alert_").show();
            setTimeout(() => {
              $(".lg_alert_").hide();
            }, 1500);
          }
        }
      );
    }
    e.preventDefault();
  });
});

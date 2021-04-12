$(document).ready(function () {

    /* === F. Validar DNI === */
    function validarDNI($d) {
        var ExpRegular_Num = /^[\d]+$/;
        return ExpRegular_Num.test($d);
    }
    /* === F. Validar EMAIL === */
    function verificarCorreo($n) {
        var ExpRegular_Correo = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        return ExpRegular_Correo.test($n);
    }
    $('#form_recuperar').submit(e => {

        let email = $('#email_recuperar').val();
        let dni = $('#dni_recuperar').val();

        if (email == '' && dni == '') {
            $('#alert_rc_dni').show();
            $('#alert_rc_dni_text').text('Ingrese DNI.');
            $('#alert_rc_email').show();
            $('#alert_rc_email_text').text('Ingrese Correo Electrónico.x');
        } else if ((email == '' || dni == '') || (dni.length != 8) || (!validarDNI(dni) || !verificarCorreo(email))) {

            if (dni == '') {
                $('#alert_rc_dni').show();
                $('#alert_rc_dni_text').text('Ingrese DNI.');
            } else if (!validarDNI(dni)) {
                $('#alert_rc_dni').show();
                $('#alert_rc_dni_text').text('Debe ingresar solo números.');
            } else if (dni.length != 8) {
                $('#alert_rc_dni').show();
                $('#alert_rc_dni_text').text('Debe tener 9 dígitos.');
            } else {
                $('#alert_rc_dni').hide();
            }

            if (email == '') {
                $('#alert_rc_email').show();
                $('#alert_rc_email_text').text('Ingrese Correo Electrónico.');
            } else if (!verificarCorreo(email)) {
                $('#alert_rc_email').show();
                $('#alert_rc_email_text').text('Datos no válidos.');
            } else {
                $('#alert_rc_email').hide();
            }
        } else {
            $('#alert_rc_dni').hide();
            $('#alert_rc_email').hide();

            mostrar_loader('recuperar_password');

            let funcion = 'verificado';

            $.post('controlador/recuperarController.php', {
                funcion,
                email,
                dni
            }, (response) => {
                if (response == 'encontrado') {

                    let funcion = 'recuperar';
                    $('#alert_prueba').hide();
                    $.post('controlador/recuperarController.php', {
                        funcion,
                        email,
                        dni
                    }, (response2) => {

                        if (response2 == 'enviado') {
                            cerrar_loader('exito_envio');
                            $('#aviso2').show();
                            $('#aviso2').text('Se restableció la contraseña');
                            $('#form_recuperar').trigger('reset');

                        } else {
                            cerrar_loader('error_envio');
                            $('#alert_prueba').show();
                            $('#alert_prueba').text('No Se puedo reestablecer');
                            $('#form_recuperar').trigger('reset');
                        }
                    })

                } else {

                    cerrar_loader('error_usuario');
                    $('#alert_prueba').show();
                    $('#alert_prueba').text('El Correo Electrónico y el DNI no se encuentran asocioados o no están registrados en el sistema');
                    $('#form_recuperar').trigger('reset');
                }
            })
        }
        e.preventDefault();
    })

    function mostrar_loader(mensaje) {
        var texto = null;
        var mostrar = false;
        switch (mensaje) {
            case 'recuperar_password':
                texto = 'Enviando correo, por favor espere...';
                mostrar = true;
                break;
        }
        if (mostrar) {
        Swal.fire({
            title: 'Enviando Mensaje',
            html: texto,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        b.textContent = Swal.getTimerLeft()
                    }
            },
        })
        }
    }

    function cerrar_loader(mensaje) {
        var texto = null;
        var mostrar = false;
        var tipo = null;
        switch (mensaje) {
            case 'exito_envio':
                tipo = 'success';
                texto = 'Correo enviado exitosamente';
                mostrar = true;
                break;
            case 'error_envio':
                tipo = 'error';
                texto = 'El correo no pudo enviarse, por favor intente nuevamente.';
                mostrar = true;
                break;
            case 'error_usuario':
                tipo = 'error';
                texto = 'Los datos ingresados no coinciden o no pernetece a un usuario.';
                mostrar = true;
                break;
            default:
                Swal.close();
                break;
        }

        if (mostrar) {

            Swal.fire({
                position: 'top-center',
                icon: tipo,
                title: texto,
                showConfirmButton: false,
                timer: 1500
            })

        }
    }
})
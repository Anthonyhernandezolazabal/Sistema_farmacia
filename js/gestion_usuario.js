$(document).ready(function(){
    var tipo_usuario = $("#tipo_usuario").val();
    if (tipo_usuario==2) {
        $("#button-crear").hide();
    }
    var funcion;

    function verificarNombre($n) {
        var ExpRegular_Nombre = /^[A-Za-zÑñÁÉÍÓÚáéíóúüÜ]+((?:[\s{1}][A-Za-zÑñÁÉÍÓÚáéíóúüÜ]+)+)?$/;
        return ExpRegular_Nombre.test($n);
    }


    function verificarNumDNI($m) {
        var ExpRegular_Num = /^[\d]+$/;
        return ExpRegular_Num.test($m);
    }
    
    buscar_datos();
    /*===========================
    BUSCAR EN LA TABLA DE GESTIÓN USUARIOS
    =============================*/
    function buscar_datos(consulta){

        funcion = 'buscar_usuarios_adm';

        $.post('controlador/UsuarioController.php',{consulta,funcion},(response)=>{

            const usuarios = JSON.parse(response);
            let template = '';
            
            usuarios.forEach(usuario => {
                template += `

                <div usuarioId="${usuario.id}" usuarioAvatar="${usuario.avatar}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light" style='width: 100%;'>
                        <div class="card-header text-muted border-bottom-0">`;
                if (usuario.tipo_usuario == 3) {
                    template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>    ` ;               
                }
                if (usuario.tipo_usuario == 1) {
                    template+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>    ` ;               
                }
                if (usuario.tipo_usuario == 2) {
                    template+=`<h1 class="badge badge-primary">${usuario.tipo}</h1>    ` ;               
                }
                template += `</div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b> ${usuario.nombre}  ${usuario.apellidos}</b></h2>
                                    <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.adicional} </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DNI: ${usuario.dni}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Residencia: ${usuario.residencia}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono: ${usuario.telefono}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo: ${usuario.correo}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo: ${usuario.sexo}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                <img src="img/usuario/${usuario.avatar}" alt="" class="img-circle img-fluid elevation-2" style='border: 3px solid #fff;'height: auto;    width: 90px;>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">`;
                            
                            if (tipo_usuario == 3) {

                                if (usuario.tipo_usuario!=3) {
                                    
                                    template+=`<button class="borrar-usuario btn btn-danger m-1" type="button" data-toggle="modal" data-target="#confirmar">
                                                <i class="fas fa-window-close"> Eliminar</i>
                                                </button>`;
                                    
                                }
                                if (usuario.tipo_usuario==2) {
                                    template+=`<button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                                    <i class="fas fa-sort-amount-up"> Ascender</i>
                                               </button>`;
                                }
                                if (usuario.tipo_usuario==1) {
                                    template+=`<button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                                    <i class="fas fa-sort-amount-down"> Descender</i>
                                               </button>`;
                                }
                                
                            }else{

                                if (tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=3) {
                                    template+=`<button class="borrar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                                                    <i class="fas fa-window-close"> Eliminar</i>
                                                </button>`;
                                }

                            }

                template+=`</div>
                        </div>
                    </div>
                </div>  
                `; 
            });

            $("#usuarios").html(template);

        });
    }

    $(document).on('keyup','#buscar',function(){

        let valor = $(this).val();
        
        if (valor != "") {
            
            buscar_datos(valor);/*Si tecleamos algo, que capture y lo mande como paramtero */

        }else{
            
            buscar_datos(); /*No me mande ningun parametro */
            
        }
    })

    /*===========================
    CREAR USUARIO
    =============================*/
    $("#form-crear").submit(e=>{

        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let edad = $("#edad").val();
        let dni = $("#dni").val();
        let pass = $("#pass").val();

        funcion='crear_usuario';


        if (nombre == '' && apellido == '' && edad == '' && dni == '' && pass == '') {

            $('#alert_lg_nombre').show();
            $('#alert_lg_nombre_text').text('Este campo es obligatorio');

            $('#alert_lg_apellidos').show();
            $('#alert_lg_apellidos_text').text('Este campo es obligatorio');

            $('#alert_lg_nacimiento').show();
            $('#alert_lg_nacimiento_text').text('Este campo es obligatorio');

            $('#alert_lg_dni').show();
            $('#alert_lg_dni_text').text('Este campo es obligatorio');

            $('#alert_lg_pass').show();
            $('#alert_lg_pass_text').text('Este campo es obligatorio');


        } else if ((nombre == '' || apellido == '' || edad == '' || dni == '' || pass == '') ||
            (nombre.length < 3 || apellido.length < 3 || pass.length < 3 || dni.length != 8) ||
            (!verificarNombre(nombre) || !verificarNombre(apellido) || !verificarNumDNI(dni))) {

            if (nombre == '') {
                $('#alert_lg_nombre').show();
                $('#alert_lg_nombre_text').text('Este campo es obligatorio.');

            } else if (nombre.length < 3) {
                $('#alert_lg_nombre').show();
                $('#alert_lg_nombre_text').text('Debe tener 2 o más caractéres.');

            } else if (!verificarNombre(nombre)) {
                $('#alert_lg_nombre').show();
                $('#alert_lg_nombre_text').text('Dato no válido.');
            } else {
                $('#alert_lg_nombre').hide();
            }

            if (apellido == '') {
                $('#alert_lg_apellidos').show();
                $('#alert_lg_apellidos_text').text('Este campo es obligatorio.');

            } else if (apellido.length < 3) {
                $('#alert_lg_apellidos').show();
                $('#alert_lg_apellidos_text').text('Debe tener 2 o más caractéres.');

            } else if (!verificarNombre(apellido)) {
                $('#alert_lg_apellidos').show();
                $('#alert_lg_apellidos_text').text('Dato no válido.');
            } else {
                $('#alert_lg_apellidos').hide();
            }

            if (edad == '') {
                $('#alert_lg_nacimiento').show();
                $('#alert_lg_nacimiento_text').text('Este campo es obligatorio.');
            } else {
                $('#alert_lg_nacimiento').hide();
            }

            if (dni == '') {
                $('#alert_lg_dni').show();
                $('#alert_lg_dni_text').text('Este campo es obligatorio.');

            } else if (!verificarNumDNI(dni)) {
                $('#alert_lg_dni').show();
                $('#alert_lg_dni_text').text('Debe ingresar solo números.');
            } else if (dni.length != 8) {
                $('#alert_lg_dni').show();
                $('#alert_lg_dni_text').text('Debe tener 8 dígitos.');

            } else {
                $('#alert_lg_dni').hide();
            }

            if (pass == '') {
                $('#alert_lg_pass').show();
                $('#alert_lg_pass_text').text('Este campo es obligatorio.');

            } else if (pass.length < 3) {
                $('#alert_lg_pass').show();
                $('#alert_lg_pass_text').text('Debe tener 2 o más caractéres.');

            } else {
                $('#alert_lg_pass').hide();
            }
        }else{


            $('#alert_lg_nombre').hide();
            $('#alert_lg_apellidos').hide();
            $('#alert_lg_nacimiento').hide();
            $('#alert_lg_dni').hide();
            $('#alert_lg_pass').hide();

            $.post('controlador/UsuarioController.php',{nombre,apellido,edad,dni,pass,funcion},(response)=>{
    
                if (response=='add') {
    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Usuario Registrado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-crear").trigger('reset');
                    $("#crearusuario").modal('hide');
                    buscar_datos();
                    
                }else{
    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'El DNI ya existe en otro usuario',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#dni").val('');
                    $("#pass").val('');
                }
            })

        }

        e.preventDefault();

    })
    /*===========================
    ASCENDER
    =============================*/
    $(document).on('click','.ascender',(e)=>{

        /*Al dar click yo necesito ascender al div donde está el usuarioId */
        const elemnto = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemnto).attr("usuarioId");
        const avatar = $(elemnto).attr("usuarioAvatar");
        funcion= 'ascender';

        $("#id_user").val(id);
        $("#avatar6").attr('src','img/usuario/'+avatar);
        $("#funcion").val(funcion);
    });


    /*===========================
    DESCENDER
    =============================*/
    $(document).on('click','.descender',(e)=>{

        /*Al dar click yo necesito ascender al div donde está el usuarioId */
        const elemnto = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemnto).attr("usuarioId");
        const avatar = $(elemnto).attr("usuarioAvatar");
        funcion= 'descender';

        $("#id_user").val(id);
        $("#avatar6").attr('src','img/usuario/'+avatar);
        $("#funcion").val(funcion);
    });

    /*===========================
    BORRAR USUARIO
    =============================*/
    $(document).on('click','.borrar-usuario',(e)=>{

        /*Al dar click yo necesito ascender al div donde está el usuarioId */
        const elemnto = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemnto).attr("usuarioId");
        const avatar = $(elemnto).attr("usuarioAvatar");
        funcion= 'borrar-usuario';

        $("#id_user").val(id);
        $("#avatar6").attr('src','img/usuario/'+avatar);
        $("#avatar").val(avatar);
        $("#funcion").val(funcion);
    });


    /*===========================
    DESCENDER / ASCENDER / BORRAR
    =============================*/
    $("#form-confirmar").submit(e=>{
        let pass = $("#oldpass").val();
        let id_usuario = $("#id_user").val();
        let avatar = $("#avatar").val();
        funcion = $("#funcion").val();

        $.post('controlador/UsuarioController.php',{pass,id_usuario,avatar,funcion},(response)=>{

            if (response=='ascendido' || response=='descendido' || response=='borrado') {/*Para que solo me muestre un solo alert */

                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Acción realizada correctamente',
                    showConfirmButton: false,
                    timer: 1800
                })

                $("#form-confirmar").trigger('reset');
                $("#confirmar").modal('hide');
                
            }else{

                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'La contraseña es incorrecta',
                    showConfirmButton: false,
                    timer: 1800
                })

                $("#form-confirmar").trigger('reset');
            }
            buscar_datos();
        })
        e.preventDefault();
    })


})


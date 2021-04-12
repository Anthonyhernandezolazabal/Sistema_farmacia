$(document).ready(function(){
    var funcion = '';
    var id_usuario = $("#id_usuario").val(); /*Id en forma global para utilizarlo */
    var edit=false; /*Estado bandera = true/false ------ Al momento de entrar a la vista el edit empezará en falso */
    /*===========================
    MOSTRAR DATOS DEL USUARIO
    =============================*/
    buscar_usuario(id_usuario);
    function buscar_usuario(dato){
        funcion = 'buscar_usuario';
        /*Funcion que capture todo los datos del usuario */
        $.post('controlador/UsuarioController.php',{dato,funcion},(response)=>{/*$.post('url',{datos},function()) AJAX DE TIPO POST */    
            /*let: una variable local*/
            let nombre='';
            let apellidos='';
            let edad='';
            let dni='';
            let tipo='';
            let tipohed='';
            let telefono='';
            let residencia='';
            let correo='';
            let sexo='';
            let adicional='';
            const usuario = JSON.parse(response);
            /*JSON.parse(): analiza lo que es el string de json.encode que pasamos y lo va decodificar */
            nombre+=`${usuario.nombre}`;
            apellidos+=`${usuario.apellidos}`;
            edad+=`${usuario.edad}`;
            dni+=`${usuario.dni}`;
            if (usuario.tipo == 'Root') {
                tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>` ;               
                tipohed+=`<span class="right badge badge-danger">${usuario.tipo}</span>` ;               
            }
            if (usuario.tipo == 'Administrador') {
                tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>` ;              
                tipohed+=`<span class="right badge badge-warning">${usuario.tipo}</span>` ;             
            }
            if (usuario.tipo == 'Técnico') {
                tipo+=`<h1 class="badge badge-primary">${usuario.tipo}</h1>` ;                
                tipohed+=`<span class="right badge badge-primary">${usuario.tipo}</span>` ;             
            }
            telefono+=`${usuario.telefono}`;
            residencia+=`${usuario.residencia}`;
            correo+=`${usuario.correo}`;
            sexo+=`${usuario.sexo}`;
            adicional+=`${usuario.adicional}`;
            $("#nombre_us").html(nombre);
            $("#apellidos_us").html(apellidos);
            $("#edad").html(edad);
            $("#dni_us").html(dni);
            $("#us_tipo").html(tipo);
            $("#us_tipobeader").html(tipohed);
            $("#telefono_us").html(telefono);
            $("#residencia_us").html(residencia);
            $("#correo_us").html(correo);
            $("#sexo_us").html(sexo);
            $("#adicional_us").html(adicional);

            $("#avatar2").attr('src',usuario.avatar);
            $("#avatar1").attr('src',usuario.avatar);
            $("#avatar3").attr('src',usuario.avatar);
            $("#avatar4").attr('src',usuario.avatar);
            $("#avatar5").attr('src',usuario.avatar);
        })
    }

    /*=============================================
    CAMBIAR LA FOTO DEL USUARIO
    =============================================*/
    $('.nuevaFoto_datospersonales').change(function () {
        var imagen = this.files[0];
    
        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
            $(".nuevaFoto_datospersonales").val("");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Error al subir la imagen',
                text: "¡La imagen debe estar en formato JPG o PNG!",
                showConfirmButton: false,
                timer: 1800
            })
        } else if (imagen['size'] > 2000000) {
            $(".nuevaFoto_datospersonales").val("");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Error al subir la imagen',
                text: "¡La imagen no debe pesar más de 2MB!",
                showConfirmButton: false,
                timer: 1800
            })
        } else {
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load", function (event) {
    
                var rutaImagen = event.target.result;
    
                $(".previsualizar_datospersonales").attr("src", rutaImagen);
    
            })
        }
    });

    $("#form-photo").submit(e=>{
        
        let formData = new FormData($('#form-photo')[0]);

        if ($('#photo').val() == '') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe seleccionar una imagen',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            $.ajax({
                url: 'controlador/UsuarioController.php',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType:false
            }).done(function(response){
    
                const json = JSON.parse(response);
                
                if (json.alert == 'edit') {
                    $('#avatar1').attr('src',json.ruta);
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Se cambió el avatar',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $('#form-photo').trigger('reset');
                    $('#cambiophoto').modal('hide');
                    buscar_usuario(id_usuario);
                }
            });
        }
        e.preventDefault();
    })

    /*===========================
    CAMBIAR CONTRASEÑA DEL USUARIO
    =============================*/
    $("#form-pass").submit(e=>{
        let oldpass=$('#oldpass').val();
        let newpass=$('#newpass').val();
        funcion= 'cambiarcontra';
        $.post('controlador/UsuarioController.php',{id_usuario,funcion,oldpass,newpass},(response)=>{
            console.log(response);
            if (response == 'update') {

                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'La contraseña se cambió correctamente',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#form-pass").trigger('reset');
                $("#cambiocontra").modal('hide');
                
            }else{

                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'La contraseña actual es incorrecta',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#form-pass").trigger('reset');
            }

        })
        e.preventDefault();
    })


    /*===========================
    MOSTRAR DATOS PARA EDITAR USUARIO
    =============================*/
    $(document).on("click",'.edit',(e)=>{
        funcion ='capturar_datos';
        edit = true; /*Estado bandera = true/false ----------- El Edit cambia a true para empezar a editar  */
        $.post('controlador/UsuarioController.php',{funcion,id_usuario},(response)=>{
            const usuario = JSON.parse(response);
            $("#telefono").val(usuario.telefono);
            $("#residencia").val(usuario.residencia);
            $("#correo").val(usuario.correo);
            $("#sexo").val(usuario.sexo);
            $("#adicional").val(usuario.adicional);
        })
    })

    /*===========================
    GUARDAR LOS DATOS EDITADOS DEL USUARIO
    =============================*/
    $('#form-usuario').submit(e=>{
        /*Verificar si la variable bandera está habilitada(true) para poder editar */
        if(edit==true){

            let telefono = $('#telefono').val(); /*Vamos a capturar todo los datos de ese imput */
            let residencia = $('#residencia').val();
            let correo = $('#correo').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();

            funcion= 'editar_usuario';

            $.post('controlador/UsuarioController.php',{id_usuario,funcion,telefono,residencia,correo,sexo,adicional},(response)=>{
                
                if (response=='editado') {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Usuario editado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-usuario").trigger('reset');/*Para que todo los campos de los input se reseteen se pongan vacíos*/

                }
                edit=false; /*El boton ya queda deshabilidtado */
                buscar_usuario(id_usuario);/*Se actualiza al que editamos */
            })
        }else{

            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Edición deshabilitada',
                showConfirmButton: false,
                timer: 1800
            })

            $("#form-usuario").trigger('reset');/*Para que todo los campos de los input se reseteen se pongan vacíos*/

        }
        /*Quitar esa acción que por defecto hace el submit*/
        e.preventDefault();
    });



})
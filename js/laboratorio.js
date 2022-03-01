$(document).ready(function(){
    var funcion;
    buscar_datos();
    var edit = false;
    /*============================
    CREAR / EDITAR LABORATORIO
    =============================*/
    $(document).on('click','#nuevolab',(e)=>{

        $("#form-crear-laboratorio").trigger('reset');
        edit = false;
    })
    $('#form-crear-laboratorio').submit(e=>{
        edit == false
        let nombre_laboratorio = $("#nombre-laboratorio").val();
        let id_editado = $("#id_editar_lab").val();

        if (edit == false) {

            funcion = 'crear';
            
        }else{

            funcion = 'editar';

        }

        if (nombre_laboratorio == '') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Los campos son obligatorio',
                showConfirmButton: false,
                timer: 1800
            })
        }else{

            $.post('controlador/laboratorioController.php',{nombre_laboratorio,id_editado,funcion},(response)=>{

              
            })

        }
        e.preventDefault();
    })

    /*============================
    BUSCAR LABORATORIO
    =============================*/
    function buscar_datos(consulta){
        funcion = 'buscar_datos';
        $.post('controlador/laboratorioController.php',{consulta,funcion},(response)=>{
            /*============================
            TABLA DINAMICA LABORATORIO
            =============================*/
            const laboratorios = JSON.parse(response);
            let template='';
            let numLab = 0;
            laboratorios.forEach(laboratorio=> {
                numLab ++;
                template += `
                    <tr labId="${laboratorio.id}" labnombre="${laboratorio.nombre}" labavatar="${laboratorio.avatar}">
                        <td>${numLab}</td>
                        <td>
                            <button class="avatar_labo btn btn-info" title="Cambiar logo del laboratorio" data-toggle="modal" data-target="#cambiarlogo">
                                <i class="far fa-image"></i>
                            </button>
                            <button class="editar_labo btn btn-success" title="Editar laboratorio" data-toggle="modal" data-target="#crear-laboratorio">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="borrar_labo btn btn-danger" title="Borrar laboratorio">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td><img src="img/lab/${laboratorio.avatar}" class="img-circle" width="60" heigth="60"></td>
                        <td>${laboratorio.nombre}</td>
                    </tr>
                `;
            });
            $("#laboratorios_tabla").html(template);
        })
    }
    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor = $(this).val();
        if (valor != "") {
            buscar_datos(valor);
        }else{
            buscar_datos();
        }
    })
    /*============================
    CAMBIAR AVATAR
    =============================*/
    $('.nuevaFoto_laboratorio').change(function () {
        var imagen = this.files[0];
    
        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
            $(".nuevaFoto_laboratorio").val("");
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Error al subir la imagen',
                text: "¡La imagen debe estar en formato JPG o PNG!",
                showConfirmButton: false,
                timer: 1800
            })
        } else if (imagen['size'] > 2000000) {
            $(".nuevaFoto_laboratorio").val("");
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
    
                $(".previsualizar_laboratorio").attr("src", rutaImagen);
    
            })
        }
    });

    $(document).on("click",".avatar_labo",e=>{
        funcion = 'cambiar_logo';
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id_logo = $(elemento).attr("labid");
        let nombre = $(elemento).attr("labnombre");
        let avatar = $(elemento).attr("labavatar");

        $("#logoactual_lab").attr("src",'img/lab/'+avatar);
        $("#nombre_logo").html(nombre);
        $("#id_logo").val(id_logo);
        $("#funcion").val(funcion);
    })
    $("#form-logo_labo").submit(e=>{
        let formData = new FormData($('#form-logo_labo')[0]);
        if ($('#photo').val() == '') {
            
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe seleccioanr una imagen',
                showConfirmButton: false,
                timer: 1800
            })
        }else{

            $.ajax({
                url: 'controlador/laboratorioController.php',
                type: 'POST',
                data: formData,
                cache: false,
                processData:false,
                contentType:false
            }).done(function(response){
                const json = JSON.parse(response);
                if (json.alert == 'edit') {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Se cambió el avatar',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $('#logoactual').attr('src',json.ruta);
                    $('#form-logo_labo').trigger('reset');
                    $('#cambiarlogo').modal('hide');
                    buscar_datos();
                }
            });

        }
        
        e.preventDefault();
    })
    /*============================
    BORRAR LABORATORIO
    =============================*/
    $(document).on("click",".borrar_labo",e=>{
        funcion = 'borrar';
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr("labid");
        let nombre = $(elemento).attr("labnombre");
        let avatar = $(elemento).attr("labavatar");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar '+nombre+'?',
            text: "No podras revertir esto!",
            imageUrl: 'img/lab/'+avatar+'',
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Si, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.post('controlador/laboratorioController.php',{id,avatar,funcion},(response)=>{

                    edit == false /*Hacemos que el modal se cambie a falso y no genere conflicto si esque precionamos el editar */
                        if (response == 'borrado') {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Borrado!',
                                text: 'El laboratorio '+nombre+' fue borrado.',
                                showConfirmButton: false,
                                timer: 1800
                            })
                            buscar_datos();
                        }else{
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'No se puedo borrar!',
                                text: 'El laboratorio '+nombre+' no fue borrado porque está siendo usado en un producto.',
                                showConfirmButton: false,
                                timer: 1800
                            })
                        }
                })

            }
          })
    })
   /*============================
    EDITAR LABORATORIO
    =============================*/
    $(document).on('click','.editar_labo',(e)=>{
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('labid');
        let nombre = $(elemento).attr('labnombre');

        $("#id_editar_lab").val(id);
        $("#nombre-laboratorio").val(nombre);
        edit = true;
    })

})
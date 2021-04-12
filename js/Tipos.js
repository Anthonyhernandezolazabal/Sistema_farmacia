$(document).ready(function(){
    var funcion;
    buscar_tipo();
    var edit = false;
    /*============================
    BUSCAR TIPO
    =============================*/
    function buscar_tipo(consulta){
        funcion = 'buscar_tipo';
        $.post('controlador/TipoController.php',{consulta,funcion},(response)=>{
            
            const tipos = JSON.parse(response);
            let template = '';
            let contTipo = 0;
            tipos.forEach(tipo => {
                contTipo ++;

                template += 
                    `
                        <tr idTip="${tipo.id_tipo}" nombreTip="${tipo.nombre}">
                            <td>${contTipo}</td>
                            <td>
                                <button class="editar_tip btn btn-success" title="Editar tipo" data-toggle="modal" data-target="#crear-tipo">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="borrar_tipo btn btn-danger" title="Borrar tipo">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td>${tipo.nombre}</td>
                        </tr>

                    `;
            });

            $("#tipos_tabla").html(template);


        })
        
    }
    $(document).on('keyup','#buscar-tipo',function(){

        var valor = $(this).val();
        if (valor !="") {
            buscar_tipo(valor);
        }else{
            buscar_tipo();
        }
        
    })

    /*============================
    EDITAR TIPO
    =============================*/
    $(document).on('click','.editar_tip',(e)=>{
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id_tipo = $(elemento).attr('idtip');
        let nombre_tip = $(elemento).attr('nombretip');
        $("#id_tip").val(id_tipo);
        $("#nombre-tipo").val(nombre_tip);
        edit = true;
    })

    /*============================
    REGISTRAR / EDITAR TIPO
    =============================*/
    $(document).on('click','.nuevotip',(e)=>{
        $("#form-tipo").trigger('reset');
        edit = false;
    })
    $("#form-tipo").submit(e=>{
        let nombre_tipo = $("#nombre-tipo").val();
        let tipo_id = $("#id_tip").val();
        if (edit == false) {
            funcion = 'crear_tipo'
        }else{
            funcion = 'editar_tipo'
        }

        if (nombre_tipo == '') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Los campos son obligatorio',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            $.post('controlador/TipoController.php',{tipo_id,nombre_tipo,funcion},(response)=>{
    
                if (response  == 'add') {
    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Tipo de producto registrado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-tipo").trigger('reset');
                    $('#crear-tipo').modal('hide');
                    buscar_tipo();
                }
                if (response  == 'noadd'){
    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: '!El tipo de producto ya existe!',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-tipo").trigger('reset');
                }
                if (response  == 'edit'){
    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Tipo de producto editado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-tipo").trigger('reset');
                    $('#crear-tipo').modal('hide');
                    buscar_tipo();
                }
            
            })

        }
        e.preventDefault();
    })

    /*============================
    ELIMINAR TIPO
    =============================*/
    $(document).on('click',".borrar_tipo",(e)=>{

        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id_tip = $(elemento).attr("idTip");
        let nombre_tio = $(elemento).attr("nombreTip");

        $("#id_tip").val(id_tip);
        funcion = 'eliminar_tip';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar '+nombre_tio+' ?',
            text: "No podrás revertir esto!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
            
                $.post('controlador/TipoController.php',{id_tip,funcion},(response)=>{
                    edit == false
                    if (response == 'removed') {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Borrado!',
                            text: 'se ha eliminado '+nombre_tio+'',
                            showConfirmButton: false,
                            timer: 1800
                        })
                        buscar_tipo()
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Ocurrió un error!',
                            text: 'No se ha podido eliminar '+nombre_tio+' porque está siendo usado en un producto',
                            showConfirmButton: false,
                            timer: 1800
                        })
                    }
                })
            }
          })
    })
})
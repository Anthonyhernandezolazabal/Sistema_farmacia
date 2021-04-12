$(document).ready(function(){
    var funcion = '';
    var edit=false
    buscar_presentacion()
    /*============================
    BUSCAR PRESENTACION
    =============================*/
    function buscar_presentacion(consulta){
        funcion = 'buscar_presentacion';
        $.post('controlador/PresentacionController.php',{consulta,funcion},(response)=>{
            const pres = JSON.parse(response);
            let template = '';
            let numPres= 0;
            pres.forEach(presentacion => {
                numPres ++;
                template += 
                    `<tr idPres="${presentacion.id_pres}" nombrePres="${presentacion.nombre}">
                        <td>${numPres}</td>
                        <td>
                            <button class="editar_pres btn btn-success" title="Editar tipo" data-toggle="modal" data-target="#crear-presentacion">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="borrar_pres btn btn-danger" title="Borrar tipo">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>${presentacion.nombre}</td>
                    </tr>`;
            });
            $("#presentacion_tabla").html(template);
        })
    }

    $(document).on('keyup','#buscar-presentacion',function(){

        var valor = $(this).val();
        if (valor !="") {
            buscar_presentacion(valor)
        }else{
            buscar_presentacion()
        }
    })

    /*============================
    EDITAR TIPO
    =============================*/
    $(document).on('click','.editar_pres',(e)=>{
        edit = true;
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id_pres = $(elemento).attr('idPres');
        let nombre_pres = $(elemento).attr('nombrePres');
        $("#id_pres").val(id_pres);
        $("#nombre-presentacion").val(nombre_pres);
    })

    /*============================
    REGISTRAR TIPO
    =============================*/
    $(document).on('click','.nuevopres',(e)=>{
        $("#form-presentacion").trigger('reset')
        edit = false;
    })
    $("#form-presentacion").submit(e=>{
        let nombre_pres = $("#nombre-presentacion").val();
        let id_pres = $("#id_pres").val();
        if (edit == false) {
            funcion = 'crear_pres'
        }else{
            funcion = 'editar_pres'
        }
        if (nombre_pres == '') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Los campos son obligatorio',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            $.post('controlador/PresentacionController.php',{id_pres,nombre_pres,funcion},(response)=>{
    
                if (response=='add') {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Nueva Presentación registrado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-presentacion").trigger('reset')
                    $('#crear-presentacion').modal('hide');
                    buscar_presentacion();
                }
                if (response=='noadd') {
        
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: '!Presentación ya existe!',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-presentacion").trigger('reset')  
                }
                if (response=='edit') {
        
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Presentación editado',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $("#form-presentacion").trigger('reset')
                    $('#crear-presentacion').modal('hide');
                    buscar_presentacion();
                }
                
            })
        }
        e.preventDefault();
    })
    /*============================
    ELIMINAR PRESENTACIÓN
    =============================*/
    $(document).on('click',".borrar_pres",(e)=>{

        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id_Pres = $(elemento).attr("idPres");
        let nombre_Pres = $(elemento).attr("nombrePres");

        $("#id_pres").val(id_Pres);
        funcion = 'eliminar_pres';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar '+nombre_Pres+' ?',
            text: "No podrás revertir esto!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.post('controlador/PresentacionController.php',{id_Pres,funcion},(response)=>{
                    edit == false
                    if (response == 'removed') {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Eliminado!',
                            text: 'se ha eliminado '+nombre_Pres+'',
                            showConfirmButton: false,
                            timer: 1800
                        })
                        buscar_presentacion()
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Ocurrió un error!',
                            text: 'No se ha podido eliminar '+nombre_Pres+' porque está siendo usado en un producto',
                            showConfirmButton: false,
                            timer: 1800
                        })
                    }
                })
            }
          })
    })

})
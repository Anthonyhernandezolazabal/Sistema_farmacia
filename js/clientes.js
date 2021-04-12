$(document).ready(function () {
    let funcion;
    buscar_cliente();
    /*============================
    TABLA DINAMICA DE CLIENTES
    =============================*/
    function buscar_cliente(consulta) {

        let funcion = 'listar_clientes';

        $.post('controlador/clientesController.php', {
            funcion,
            consulta
        }, (response) => {

            const clientes = JSON.parse(response);
            let template = '';
            clientes.forEach(cliente => {

                template += `
                
                    <tr attr_nombre=${cliente.nombre} attr_apellidos=${cliente.apellidos} attr_telefono=${cliente.telefono} attr_email=${cliente.correo} attr_adicional=${cliente.adicional} attr_id=${cliente.id}>
                        <td>${cliente.nombre +' '+ cliente.apellidos}</td>
                        <td>${cliente.dni}</td>
                        <td>${cliente.edad} años</td>
                        <td>${cliente.telefono}</td>
                        <td>${cliente.correo}</td>
                        <td>${cliente.registrado}</td>
                        <td>
                            <button button class="edit_cliente btn btn-success" type="button" data-toggle="modal" data-target="#modal-edit_cliente"><i class="fas fa-pencil-alt"></i></button>
                            <button class="borrar_cliente btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                
                `;
            });

            $("#tbl_cliente").html(template);

        })

    }
    $(document).on('keyup', '#buscar_cliente', function () {
        var valor = $(this).val();
        if (valor != "") {
            buscar_cliente(valor);
        } else {
            buscar_cliente();
        }
    })

    /*============================
     CREAR CLIENTE
     =============================*/
    $('#form_clientes').submit((e) => {

        let nombre = $('#clt_nombre').val()
        let apellidos = $('#clt_apellidos').val()
        let dni = $('#clt_dni').val()
        let telefono = $('#clt_telefono').val()
        let email = $('#clt_email').val()
        let nacimiento = $('#clt_nacimiento').val()
        let sexo = $('#clt_sexo').val()
        let adicional = $('#clt_adicional').val()
        funcion = 'registrar_nuevo_cliente'


        $.post('controlador/clientesController.php', {
            nombre,
            apellidos,
            dni,
            telefono,
            email,
            nacimiento,
            sexo,
            adicional,
            funcion
        }, (response) => {
            console.log(response);
            if (response == 'add' || response == 'modif_estado' || response == 'modif') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Cliente Registrado',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#form_clientes").trigger('reset');
                $('#modal-cliente').modal('hide');
                buscar_cliente();
            }

            if (response == 'noadd') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'El DNI del cliente ya está registrado',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#clt_dni").val('');
            }

        })

        e.preventDefault();
    });


    /*============================
     EDITAR CLIENTE
     =============================*/
    $(document).on('click', '.edit_cliente', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let telefono = $(elemento).attr('attr_telefono');
        let correo = $(elemento).attr('attr_email');
        let adicional = $(elemento).attr('attr_adicional');
        let id = $(elemento).attr('attr_id');

        $("#cli_edit_tel").val(telefono);
        $("#cli_edit_correo").val(correo);
        $("#cli_edit_adicional").val(adicional);
        $("#cli_id_cliente").val(id);
    })

    $('#form_edit_cliente').submit((e) => {

        let telefono = $('#cli_edit_tel').val()
        let email = $('#cli_edit_correo').val()
        let adicional = $('#cli_edit_adicional').val()
        let id = $('#cli_id_cliente').val()
        funcion = 'editar_nuevo_cliente'

        $.post('controlador/clientesController.php', {
            telefono,
            email,
            adicional,
            id,
            funcion
        }, (response) => {

            if (response == 'edit') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Cliente Editado',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#form_edit_cliente").trigger('reset');
                $('#modal-edit_cliente').modal('hide');
                buscar_cliente();
            }

            if (response == 'noedit') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'Error al editar',
                    showConfirmButton: false,
                    timer: 1800
                })
                $("#form_edit_cliente").trigger('reset');
                $('#modal-edit_cliente').modal('hide');
            }

        })

        e.preventDefault();
    });
    /*===========================
    ELIMINAR CLIENTES 
    =============================*/
    $(document).on('click', '.borrar_cliente', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        console.log(elemento)
        let id = $(elemento).attr('attr_id');
        let nombre = $(elemento).attr('attr_nombre');
        funcion = 'borrar_cliente';

        Swal.fire({
            title: '<strong>Eliminar</strong>',
            icon: 'question',
            html:
              '¿Seguro que desea eliminar cliente <b><u>'+nombre+'</u></b> ?<br> ' +
              'no podrá revertir esta acción ',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-thumbs-up"></i> Eliminar',
            cancelButtonText:
              '<i class="fa fa-thumbs-down"></i> Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {

                $.post('controlador/clientesController.php',{id,funcion},(response)=>{

                    if (response == 'borrado') {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Borrado!',
                            text: 'El cliente '+nombre+' fue borrado.',
                            showConfirmButton: false,
                            timer: 1800
                        })
                        buscar_cliente();
                    }
                    else{
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'No se puedo borrar!',
                            text: 'El cliente '+nombre+' no fue borrado.',
                            showConfirmButton: false,
                            timer: 1800
                        })
                    }
                })

            }
          })

        
    })
})
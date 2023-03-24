$(document).ready(function(){
    var obj = {};
    $('#myTable').DataTable({
        "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
        "lengthMenu": [[10,20,50, -1],[10,20,50,"Mostrar Todo"]],
         dom: 'fr<"col-md-6 inline"l><"row"B> ti<"col-md-7 inline"p>',

        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>Excel',
                title:'APS',
                titleAttr: 'Excel',
                className: 'btn btn-app export excel',
                exportOptions: {
                    columns: [ 0,1,2,3,4]
                }
            }
           
        ],
    
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }

        
    });
    $('.editar').click(function(){
        var activo = '', inactivo = '';
        var id = $(this).data('id');
        var htmlNombre = $(".nombreAps" + id).html();
        var htmlEstatus = $(".estatusAps" + id).html();
        var color = $(".estatusAps" + id).data('color');
        var idArquitecto = $(this).data('arquitecto');

        $('.nombreAps'+id).html('<input name="editarNombre' + id + '" class="form-control editarNombre' + id + '" value ="' + htmlNombre + '"/>');
        $('.estatusAps'+id).html('<input name="editarEstatus' + id + '" class="form-control editarEstatus' + id + '" value = "' + htmlEstatus + '"/>');
        $('.estatusAps'+id).removeClass(color);
        
        if(htmlEstatus == 'ACTIVO'){
            activo = 'selected';
            $('.estatusAps'+id).removeClass("bg-success");
        }else{
            inactivo = 'selected';
            $('.estatusAps'+id).removeClass("bg-warning");
        }


        $('.estatusAps'+id).html('<select name="guardarEstatus' + id + '" class="form-select guardarEstatus' + id + '"> <option value="1" ' + activo + '>ACTIVO</option><option value="0" ' + inactivo + '>INACTIVO</option></select>');
        $('.editar_acciones_'+id).hide();
        $('.editar_acciones_cancelar_'+id).removeAttr('style');

        obj.idArq = idArquitecto;
        obj.idtd = id;
        obj.url = '../users/listarArquitectos';
        obj.data = {
        };

        obj.type = 'POST';
        obj.accion = 'crearSelect';

        peticionAjax(obj);
    });

    $('.cancelar').click(function(){
        var id = $(this).data('id');
        var htmlNombre = $(this).data('nombre');
        //var htmlEstatus = $(".estatusAps"+id).html();
        var arquitecto = $(this).data('arquitecto');
        var htmlEstatus = $(this).data('estatus');
        var color = $(this).data('color');

        $('.nombreAps'+id).html(htmlNombre);
        $('.nombreArquitecto'+id).html(arquitecto);
        $('.estatusAps'+id).html(htmlEstatus);
        $('.estatusAps'+id).addClass(color);
        $('.editar_acciones_'+id).show();
        $('.editar_acciones_cancelar_'+id).hide();
    });

    $('.save').click(function() {
        event.preventDefault();
        var id = $(this).data('id');
        var nombre = $('.editarNombre' + id).val();
        var estatus = $('.guardarEstatus'+ id).val();
        var arquitectoID = $('.arquitectoSelect' + id).val();
        var arquit = $('.recuperarNombre' +arquitectoID).data("nombrearquitecto");
        $('.nombreArquitecto' + id).html(arquit);;

        if(nombre != '') {
            obj.url = '../aps/edit';
            obj.data = {id:id, nombre: nombre, estatus: estatus, arquitecto:arquitectoID};
            obj.type = 'POST';
            obj.accion = 'update';
            
            $(".nombreAps"+id).html(nombre);
            if(estatus==1){
                $(".estatusAps"+id).html("ACTIVO");
                $(".estatusAps"+id).addClass("bg-success");
            }else{
                $(".estatusAps"+id).html("INACTIVO");
                $(".estatusAps"+id).addClass("bg-warning");
            }

            $('.editar_acciones_'+id).show();
            $('.editar_acciones_cancelar_'+id).hide();
            peticionAjax(obj);
        } else {
            $('.mensaje_sistema').html('Favor de llenar el nombre');
            $("#mensajeModal").modal("show");
        }
    });

    $('.eliminar').click(function(){
        var id = $(this).data('id');
        obj.url = '../aps/delete';
            obj.data = {idAps: id};
            obj.type = 'POST';
            obj.accion = 'delete';
            obj.id = id;
        peticionAjax(obj);
    });

    $(".agregarNuevo").click(function(){
        $(".crearModal").modal("show");
    });

    $(".saveModal").click(function(){
        event.preventDefault();
        var nombre = $('#imputNombre').val();
        var datos = $(".frmGuardar").serialize();
        if (nombre != ''){
            obj.url = '../aps/save';
            obj.data = datos;
            obj.type = 'POST';
            obj.accion = 'save';

            peticionAjax(obj);
        } else {
            alert('No hay nombre');
        }
        setTimeout(window.location.reload(), 3000); 
    });

    $('.cerrarModal').click(function(){
        $('.crearModal').modal("hide");
    });
    
});



function peticionAjax(datos) {
    $.ajax({
        url: datos.url,
        data: datos.data,
        type: datos.type,
        dataType: 'json',
        success: function(res) {
            switch (datos.accion) {
                case "update":
                    $('.mensaje_sistema').html(res.res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show");
                    break;
                case "save":
                    $(".frmGuardar")[0].reset();
                    $('.crearModal').modal("hide");
                    $('.mensaje_sistema').html(res.res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show"); 
                                    
                    break;
                case "delete":
                    $('.estatusAps' + datos.id).removeClass("bg-success");
                    $('.estatusAps' + datos.id).addClass("bg-warning");
                    $('.estatusAps' + datos.id).html("INACTIVO");
                   
                break;
                case "crearSelect":
                    var crearSelect = '';
                    crearSelect += '<select class="form-select arquitectoSelect'+datos.idtd+'" aria-label="Default select example">';
                    $.each(res.iduser, function(key,data){
                        if(Number(data) == Number(datos.idArq)){
                            crearSelect += '<option value="'+data+'" class="recuperarNombre'+data+'" data-nombrearquitecto="'+res.nombre[key]+'" selected>'+res.nombre[key]+'</option>'; 
                        }else{
                            crearSelect += '<option value="'+data+'" class="recuperarNombre'+data+'" data-nombrearquitecto="'+res.nombre[key]+'" >'+res.nombre[key]+'</option>';
                        }
                    });
                    crearSelect += '</select>';
                    $('.nombreArquitecto'+datos.idtd).html(crearSelect);
                    break;
            }

        },
        error: function(xhr, estatus) {
        }
    });


}
$(document).ready(function() {
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
                title:'Roles de usuario',
                titleAttr: 'Excel',
                className: 'btn btn-app export excel',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5]
                }
            }
        ],
    
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }

        
    });
    $('.editar').click(function() {
        var activo = '',
            inactivo = '';
        var id = $(this).data('id');
        var color = $('.editar_estatus_' + id).data('color');
        var textHtml = $('.editar_nombre_' + id).html();
        var selectHtml = $('.editar_estatus_' + id).html();
        $('.editar_estatus_' + id).removeClass(color);
        $('.editar_nombre_' + id).html('<input name="guardar_nombre_' + id + '" class="form-control guardar_nombre_' + id + '" value="' + textHtml + '" />');
        if (selectHtml == 'ACTIVO') {
            activo = 'selected';
            $('.editar_estatus_'+id).removeClass("bg-success");
        } else {
            inactivo = 'selected';
            $('.editar_estatus_'+id).removeClass("bg-warning");
        }
        $('.editar_estatus_' + id).html('<select name="guardar_estatus_' + id + '" class="form-select guardar_estatus_' + id + '"> <option value="1" ' + activo + '>ACTIVO</option><option value="0" ' + inactivo + '>INACTIVO</option> </select>');
        $('.editar_acciones_' + id).hide();
        $('.editar_acciones_cancelar' + id).removeAttr('style');
    });

    $('.cancelar').click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var estatus = $(this).data('estatus');
        var color = $(this).data('color');

        $('.editar_nombre_' + id).html(nombre);
        $('.editar_estatus_' + id).html(estatus);
        $('.editar_estatus_' + id).addClass(color);
        $('.editar_acciones_' + id).show();
        $('.editar_acciones_cancelar' + id).hide();
    });

    $('.save').click(function() {
        event.preventDefault();
        var id = $(this).data('id');
        var textHtml = $('.guardar_nombre_' + id).val();
        var selectHtml = $('.guardar_estatus_' + id).val();
        if (textHtml != '') {
            obj.url = '../rol/edit';
            obj.data = { id: id, nombre: textHtml, estatus: selectHtml };
            obj.type = 'POST';
            obj.accion = 'update';
            $('.editar_nombre_' + id).html(textHtml);

            if(selectHtml==1){
                $(".editar_estatus_"+id).html("ACTIVO");
                $(".editar_estatus_"+id).addClass("bg-success");
            }else{
                $(".editar_estatus_"+id).html("INACTIVO");
                $(".editar_estatus_"+id).addClass("bg-warning");
            }
            
            $('.editar_acciones_'+id).show();
            $('.editar_acciones_cancelar'+id).hide();
            peticionAjax(obj);
        } else {
            $('.mensaje_sistema').html('Favor de llenar el nombre del rol');
            $("#mensajeModal").modal("show");
        }

       
    });

    $('.crear-rol').click(function() {
        $('.crear_rol_modal').modal("show");

    });

    $('.save-rol').click(function() {
        event.preventDefault();
        var nombre = $('#imputNombre').val();
        var idSubmenus = [];
        var menu = $(this).data('menu');
        var datos = $(".frmGuardar").serialize();
            
        $("input[type=checkbox]:checked").each(function(){
            idSubmenus.push([menu,this.value]);
        });
      
        //var id = $(this).data('id');

        //console.log(idSubmenus);
        
        if (nombre != '') {
            obj.url = '../rol/save';
            obj.data = datos;
            obj.type = 'POST';
            obj.accion = 'save';

            peticionAjax(obj);
        } else {
            alert('No hay nombre');
        }
        window.location.reload();
    });

    $('.abrir').click(function(){
        var id = $(this).data('id');        
        if($(this).prop("checked")){
            $('#flexCheckDefault'+id).attr("value", id);
            $('#flexCheckDefault'+id).attr("name", "checkMenu[]");
               
        }else{
            $('#flexCheckDefault'+id).removeAttr("value");
            $('#flexCheckDefault'+id).removeAttr("name");
            $('.menu_'+id).prop("checked", false);
        }

    });

    $('.selectSubMenu').click(function(){
        var id = $(this).data('id');
        if($(this).prop("checked")){
            $(this).attr("value",id);
            $(this).attr("name","checkSubMenu[]");
        }else{
            $(this).removeAttr("value");
            $(this).removeAttr("name");
        }
    });

    $('.cerrarModal').click(function(){
        $('.crear_rol_modal').modal("hide");
    });

    $('.eliminar').click(function(){
        var id = $(this).data("id");
        obj.url = '../rol/delete';
        obj.data = {idRol: id};
        obj.type = 'POST';
        obj.accion = 'delete';
        obj.id = id;
        peticionAjax(obj);
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
                    $("#mensajeModal").modal("show");
                    $(".mensaje").addClass("bg-success");
                    break;
                case "save":
                    $('.crear_rol_modal').modal("hide");
                    $('.mensaje_sistema').html(res.res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show");
                    $('#imputNombre').val('');
                    $('.abrir').click();
                    $('input[type=checkbox]').prop("checked", false);
                    break;
                case "delete":
                    $('.editar_estatus_' + datos.id).removeClass("bg-success");
                    $('.editar_estatus_' + datos.id).addClass("bg-warning");
                    $('.editar_estatus_' + datos.id).html("INACTIVO");
                break;
            }

        },
        error: function(xhr, estatus) {
        }
    });


}
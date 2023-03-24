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
                title:'Plan de Pruebas',
                titleAttr: 'Excel',
                className: 'btn btn-app export excel',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7,8,9,10]
                }
            }
        ],
    
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }

        
    });
    $('.editar').click(function(){
        var id = $(this).data('id');
        var catalogo = $(this).data('catalogo');
        var estatus = $('.estatus' + id).html();
        var nombre = $('.nombre' + id).html();
        var descripcion = $('.descripcion' + id).html();
        var url = $('.url' + id).html();
        var arquitecto = $(this).data('arquitecto');
        var programador = $(this).data('programador');
        var tester = $(this).data('tester');
        var gerente = $(this).data('gerente');
        var jefeArea = $(this).data('jefe');
        var usuario = $(this).data('usuario');
        var fechapdp = $('.fechapdp' + id).html();
        var idsistema = $(this).data('idsis');

        $(".catEstatus").find('option:selected').removeAttr("selected");
        $(".catEstatus option[value='"+ catalogo +"']").attr("selected", true);
        $(".arquiSelect").find('option:selected').removeAttr("selected");
        $(".arquiSelect option[value='"+ arquitecto +"']").attr("selected", true);
        $(".progSelect").find('option:selected').removeAttr("selected");
        $(".progSelect option[value='"+ programador +"']").attr("selected", true);
        $(".testSelect").find('option:selected').removeAttr("selected");
        $(".testSelect option[value='"+ tester +"']").attr("selected", true);
        $(".gerenteSelect").find('option:selected').removeAttr("selected");
        $(".gerenteSelect option[value='"+ gerente +"']").attr("selected", true);
        $(".jefeSelect").find('option:selected').removeAttr("selected");
        $(".jefeSelect option[value='"+ jefeArea +"']").attr("selected", true);
        $(".usuarioSelect").find('option:selected').removeAttr("selected");
        $(".usuarioSelect option[value='"+ usuario +"']").attr("selected", true);

        $(".editar_pdp_modal").modal("show");
        $('#estatus_sis').attr('value',estatus.trim());
        $('#nombre_aps').attr('value',nombre.trim());
        //$('#descripcion_pdc').attr('value',descripcion.trim());
        $('#url_sis').attr('value',url.trim());
        $('#fecha_pdp').val(fechapdp.trim().substring(0, 19));

        $.ajax({
            url: "../planpruebas/getEstatusNotas",
            type: "post",
            dataType: 'json',
            data: { idpdp: id }
        })
        .done(function(res){
            if(res.fecha_realizacion != null){
                $('#fecha_pruebas_pdp').val(res.fecha_realizacion.trim().substring(0, 19));
            }
            if(res.fecha_aprobacion != null){
                $('#fecha_aprobacion_pdp').val(res.fecha_aprobacion.trim().substring(0, 19));
            }
            $('#nueva_version_pdp').attr('value',res.nueva_version);
            $('#version_anterior_pdp').attr('value',res.version_anterior);
            $('#notas_asignacion_pdp').attr('value',res.notas);
            $('#resutado_pdp').val(res.resultado);
            $('#bitacora_pdp').val(res.bitacora);
            $('#version_historial_pdp').attr('value',res.version);
            $('.save_pdp').attr('data-id',id);
            $('.save_pdp').attr('data-idsis',idsistema);
        });
    });

    $('.save_pdp').click(function(){
        var id_pdp = $(this).data('id');
        var id_sis = $(this).data('idsis');
        var datos = $('#formulario').serialize();
        datos+= "&id="+id_pdp;
        datos+= "&idsis="+id_sis;
        obj.url = '../planpruebas/update';
        obj.data = datos;
        obj.type = 'POST';
        obj.accion = 'update';

        peticionAjax(obj);
        window.location.reload();
    });

    $('.cerrarModal').click(function(){
        $('.editar_pdp_modal').modal("hide");
        $('.historial_pdp_modal').modal("hide");
    });

    $('.historial').click(function() {
        var id = $(this).data('id');

        obj.url = '../planpruebas/getHistorialPDP';
        obj.data = {id_pdp: id};
        obj.type = 'POST';
        obj.accion = 'historial';

        peticionAjax(obj);
        $('.historial_pdp_modal').modal("show");
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
                    $("#formulario")[0].reset();
                    $('.editar_pdp_modal').modal("hide");
                    $('.mensaje_sistema').html(res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show");
                    break;
                case "historial":
                    
                    break;
            }
        },
        error: function(xhr, estatus) {
            alert("error:"+estatus);
        }
    });


}
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
                title:'Indicadores',
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

        $('#myTable2').DataTable({
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
                    title:'Indicadores',
                    titleAttr: 'Excel',
                    className: 'btn btn-app export excel',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6]
                    }
                }
            ],
    
            
        
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        

        
    });
    $('.editar').click(function(){
        var id = $(this).data('id');
        var idGerente = $(this).data('idgerente');
        var idJefe = $(this).data('idjefe');
        var idUsuarioA = $(this).data('idusuarioa');
        
        $('.editar_acciones_' + id).hide();
        $('.editar_acciones_cancelar' + id).removeAttr('style');

        obj.idGerente = idGerente;
        obj.idJefe = idJefe;
        obj.idUsuarioA = idUsuarioA;
        obj.idtd = id;
        obj.url = '../indicadores/crearSelect';
        obj.data = {};
        obj.type = 'POST';
        obj.accion = 'crearSelect';

        peticionAjax(obj);

    });

    $('.cancelar').click(function(){
        var id = $(this).data('id');
        var gerente = $(this).data('gerente');
        var jefes =  $(this).data('jefe');
        var usuarios =  $(this).data('usuario');

        $('.gerentes'+id).html(gerente);
        $('.jefes'+id).html(jefes);
        $('.usuarios'+id).html(usuarios);
        $('.editar_acciones_' + id).show();
        $('.editar_acciones_cancelar' + id).hide();
        window.location.reload();
    });

    $('.save').click(function() {
        var id = $(this).data('id');
        var selectGerente = $('.selectgerentes'+id).val();
        var selectJefe = $('.selectjefes'+id).val();
        var selectUsuario = $('.selectusuarios'+id).val();
        var recuperarGerenteText = $('.recuperarGerente'+selectGerente).data('nombre');
        var recuperarJefeText = $('.recuperarJefe'+selectJefe).data('nombre');
        var recuperarUsuarioText = $('.recuperarUsuario'+selectUsuario).data('nombre');

        obj.url = '../indicadores/updateAsignaciones';
        obj.data = { 
            idSistema: id, 
            idGerente: selectGerente,
            idJefe: selectJefe,
            idUsuario: selectUsuario
        };
        obj.type = 'POST';
        obj.accion = 'update';
        peticionAjax(obj);
        $('.gerentes'+id).html(recuperarGerenteText);
        $('.jefes'+id).html(recuperarJefeText);
        $('.usuarios'+id).html(recuperarUsuarioText);
        $('.editar_acciones_' + id).show();
        $('.editar_acciones_cancelar' + id).hide();
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
                case "crearSelect":
                    /* Select gerentes */
                    var crearSelectGerentes = '';
                    crearSelectGerentes += '<select class="form-select selectgerentes'+datos.idtd+'" aria-label="Default select example">';
                    
                    $.each(res.gerentes.idgerente, function(key,data){
                        if(Number(data) == Number(datos.idGerente)){
                            $('.cancelar' + datos.idtd).attr('data-gerente',res.gerentes.nombre[key]);
                            crearSelectGerentes += '<option value="'+data+'" class="recuperarGerente'+data+'" data-nombre="'+res.gerentes.nombre[key]+'" selected>'+res.gerentes.nombre[key]+'</option>'; 
                        }else{
                            crearSelectGerentes += '<option value="'+data+'" class="recuperarGerente'+data+'" data-nombre="'+res.gerentes.nombre[key]+'" >'+res.gerentes.nombre[key]+'</option>';
                        }
                    });
                    crearSelectGerentes += '</select>';
                    $('.gerentes'+datos.idtd).html(crearSelectGerentes);
                    

                    /* Select Jefes */
                    var crearSelectJefes = '';
                    crearSelectJefes += '<select class="form-select selectjefes'+datos.idtd+'" aria-label="Default select example">';
                    $.each(res.jefes.idjefe, function(key,data){
                        if(Number(data) == Number(datos.idJefe)){
                            $('.cancelar' + datos.idtd).attr('data-jefe',res.jefes.nombre[key]);
                            crearSelectJefes += '<option value="'+data+'" class="recuperarJefe'+data+'" data-nombre="'+res.jefes.nombre[key]+'" selected>'+res.jefes.nombre[key]+'</option>'; 
                        }else{
                            crearSelectJefes += '<option value="'+data+'" class="recuperarJefe'+data+'" data-nombre="'+res.jefes.nombre[key]+'" >'+res.jefes.nombre[key]+'</option>';
                        }
                    });
                    crearSelectJefes += '</select>';
                    $('.jefes'+datos.idtd).html(crearSelectJefes);
                    
                    /* Select Usuarios */
                    var crearSelectUsuarios = '';
                    crearSelectUsuarios += '<select class="form-select selectusuarios'+datos.idtd+'" aria-label="Default select example">';
                    $.each(res.usuariosAsi.idusuarioa, function(key,data){
                        if(Number(data) == Number(datos.idUsuarioA)){
                            $('.cancelar' + datos.idtd).attr('data-usuario',res.usuariosAsi.nombre[key]);
                            crearSelectUsuarios += '<option value="'+data+'" class="recuperarUsuario'+data+'" data-nombre="'+res.usuariosAsi.nombre[key]+'" selected>'+res.usuariosAsi.nombre[key]+'</option>'; 
                        }else{
                            crearSelectUsuarios += '<option value="'+data+'" class="recuperarUsuario'+data+'" data-nombre="'+res.usuariosAsi.nombre[key]+'" >'+res.usuariosAsi.nombre[key]+'</option>';
                        }
                    });
                    crearSelectUsuarios += '</select>';
                    $('.usuarios'+datos.idtd).html(crearSelectUsuarios);

                    break;

                case "update":
                    $('.mensaje_sistema').html(res);
                    $("#mensajeModal").modal("show");
                    $('.mensaje').addClass("bg-success");
                    break;
            }
        },
        error: function(xhr, estatus) {

        }
    });


}
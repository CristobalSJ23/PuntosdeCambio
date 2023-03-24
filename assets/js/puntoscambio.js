$(document).ready(function(){

    var obj ={};

    
    $('.editar').click(function(){
        var id = $(this).data('id');
        var idLeng = $(this).data('idlenguaje');
        var palabra = $('.nombrePal'+id).html();
        var lenguaje = $('.nombreLeng'+id).html();
        
        
        $('.nombrePal'+id).html('<input name="editarNombrePal' + id + '" class="editarNombrepal'+ id +'" value = "' + palabra +  '" />');
        //$('.nombreLeng'+id).html('<input name="editarNombreLeng' + id + '" class= "editarNombreLeng'+ id +'" value = "' + lenguaje + '"/>');

        $('.editar'+id).hide();
        $('.eliminar'+id).hide();

        $('.save'+id).show();
        $('.cancelar'+id).show();

        $('.editar_acciones_'+id).hide();
        $('.editar_acciones_cancelar'+id).removeAttr('style');

        obj.idLeng = idLeng;
        obj.idtd = id;
        obj.url = '../puntoscambio/crearSelect';
        obj.data = {};
        obj.type = 'POST';
        obj.accion = 'crearSelect';

        peticionAjax(obj);
    });

    $('.cancelar').click(function(){
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var lenguaje = $(this).data('lenguaje');

        $('.nombrePal'+id).html(nombre);
        $('.nombreLeng'+id).html(lenguaje);

        $('.editar'+id).show();
        $('.eliminar'+id).show();

        $('.save'+id).hide();
        $('.cancelar'+id).hide();

    });

    $('.save').click(function(){
        var id = $(this).data('id');
        var nombrePal = $('.editarNombrepal' + id).val();
        var nombreLeng = $('.language' + id).val();
        var lenguaje = $('.recuperarNombre' +nombreLeng).data("nombreleng");

        if(nombrePal == ''){
            $('.mensaje_sistema').html('El campo palabra no puede estar vacio');
            $('.mensaje').addClass("bg-warning");
            $('#mensajeModal').modal('show');
            exit();
        }
        if(nombreLeng == ''){
            $('.mensaje_sistema').html('El campo lenguaje no puede estar vacio');
            $('.mensaje').addClass("bg-warning");
            $('#mensajeModal').modal('show');
            exit();
        }

        $('.nombrePal' + id).html(nombrePal);
        $('.nombreLeng' + id).html(lenguaje);
        $('.save' + id).hide();
        $('.cancelar' + id).hide();
        $('.editar' + id).show();
        $('.eliminar' + id).show();

        obj.url = '../puntoscambio/update';
        obj.data = {
            id: id,
            nombre_pal: nombrePal,
            nombre_leng: nombreLeng
        };

        obj.type = 'POST';
        obj.accion = 'update';

        peticionAjax(obj);

    });

    $(".eliminar").click(function(){
        var id = $(this).data('id');
        $(".eliminarFila"+id).hide();
        obj.url = '../puntoscambio/delete';
        obj.data = {
            id: id
        };

        obj.type = 'POST';
        obj.accion = 'delete';

        peticionAjax(obj);
    });

    $(".guardarPalabra").click(function(){
        event.preventDefault();
        var palabra = $("#palabra").val();
        var datos = $("#formPalabra").serialize();
        

        if(palabra == ''){
            $('.mensaje_sistema').html('El campo palabra no puede estar vacio');
            $('.mensaje').addClass("bg-warning");
            $('#mensajeModal').modal('show');
            exit();
        }

        obj.url = '../puntoscambio/savePalabra';
        obj.data = datos;
        obj.type = 'POST';
        obj.accion = 'savePalabra';

        $('#formPalabra')[0].reset();

        peticionAjax(obj);
        
        window.location.reload();

    });

    $(".guardarLenguaje").click(function(){
        event.preventDefault();
        var lenguaje = $("#lenguaje").val();
        var lenguajeExt = $("#lenguajeExtension").val();
        if(lenguaje == ''){
            $('.mensaje_sistema').html('El campo lenguaje no puede estar vacio');
            $('.mensaje').addClass("bg-warning");
            $('#mensajeModal').modal('show');
            exit();
        }
        if(lenguajeExt == ''){
            $('.mensaje_sistema').html('El campo de extension no puede estar vacio');
            $('.mensaje').addClass("bg-warning");
            $('#mensajeModal').modal('show');
            exit();
        }

        obj.url = '../puntoscambio/saveLanguage';
        obj.data = {
            lenguaje: lenguaje,
            lenguajeExtension: lenguajeExt
        };
        obj.type = 'POST';
        obj.accion = 'saveLanguage';

        peticionAjax(obj);
        window.location.reload();
    });

    $(".agregarNuevo").click(function(){
        $(".crearModal").modal("show");
    });

    $('.cerrarModal').click(function(){
        $('.crearModal').modal("hide");
    });

    $("#formzip").on("submit",function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formzip"));
        $.ajax({
            url: "../puntoscambio/leerZip",
            type: "post",
            dataType: 'json',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(res){
            archivos = [];
            var selectProg = '<select class = "form-select programadores">';
            selectProg += "<option selected disabled value = ''>Selecciona un Programador</option>";
            $.each(res.Programadores[0].nombre, function(key,data){
                selectProg += "<option value = '"+ res.Programadores[0].idprog[key] +"'>"+data+"</option>";
            
            });
            selectProg += "</select>";
            var selectTest = '<select class = "form-select testers">';
            selectTest += "<option selected disabled value = ''>Selecciona un Tester</option>";
            $.each(res.Tester[0].nombre, function(key,data){
                selectTest += "<option value = '"+ res.Tester[0].idtest[key] +"'>"+data+"</option>";
            });
            selectTest += "</select>";

            var tabla='';
            tabla += '<table class="table table-responsive" border="1">';
            tabla += '<thead> <tr>';
            tabla += '<th>#</th>';
            tabla += '<th>Nombre del Archivo</th>';
            tabla += '<th>Programador</th>';
            tabla += '<th>Tester</th>';
            //console.log(res);
            //console.log(res.result[0].if);
            $.each(res.thead, function(key,data){
                tabla += "<th>" + data + "</th>";
            });

            tabla += "<th> Total Puntos de Cambio </th>";
            tabla += '</tr> </thead>';
            tabla += '<tbody> ';
            var result = res.result;
            var contadorPC = 0;
            var id=0;
            
            $.each(res.NombreArchivo, function(keyNombre,dataNombre){
                tabla += '<tr>';
                tabla += '<th scope="row">' + (keyNombre+1) + '</th>';
                tabla += '<td class = "urlarchivo">' + dataNombre + '</td>';
                tabla += '<td class = "programador">' + selectProg +'</td>';
                tabla += '<td class = "tester">' +  selectTest +'</td>';
            
                $.each(res.thead, function(key,data){
                    tabla += '<td>' + result[keyNombre][data] + '</td>';
                    contadorPC +=  result[keyNombre][data];
                });
                tabla += '<td class = "totalpc">' + contadorPC + '</td>';
                tabla += '</tr>';
                elemento = [];
                elemento.push(dataNombre,contadorPC);
                archivos.push(elemento);
                contadorPC = 0;
                id=keyNombre;
            });
            tabla += '</tbody>';
            tabla += '</table>';
            // tabla += '<button type="button" class="guardarSistemas btn btn-primary btn-lg" data-id="'+id+'">Guardar puntos de cambio</button>';
            $('.crearModal').modal("hide");
            $('#creartabla').html(tabla);
            $('#divBotonZip').removeAttr('style');
            $('.guardarSistemas').attr('data-id',id);
        });
    });
    
    $('.guardarSistemas').click(function(){
        var nombresurl = [];
        var totalpc = [];
        var info = {};
        var programadores = [];
        var testers = [];
        var aps;
        $('.urlarchivo').each(function(index){
            nombresurl[index]=$(this).text();
        });
        $('.totalpc').each(function(index){
            totalpc[index]=$(this).text();
        });
        $('.programadores').each(function(index){
            if($(this).val() === null) {
                swal('Debe seleccionar un Programador en el registro ' + (index + 1));
                $(this).addClass("border border-danger");
                exit();
            } else {
                programadores[index] = $(this).val();
                $('.programadores').removeClass("border border-danger");
            }
        });
        $('.testers').each(function(index){
            if($(this).val() === null) {
                swal('Debe seleccionar un Tester en el registro ' + (index + 1));
                $(this).addClass("border border-danger");
                exit();
            } else {
                testers[index] = $(this).val();
                $('.testers').removeClass("border border-danger");
            }
        });
        if($('.selectAPS').val() === null){
            swal('Debe seleccionar un APS para los sistemas');
            $('.selectAPS').addClass("border border-danger");
            exit();
        } else {
            aps = $('.selectAPS').val();
            $('.selectAPS').removeClass("border border-danger");
        }

        info.nombresurl=nombresurl;
        info.totalpc=totalpc;
        info.programadores=programadores;
        info.testers=testers;
        info.aps=aps;
        console.log(programadores);
        console.log(testers);
        console.log(info);
        var id = $(this).data('id');
        var urlarchivo = $('.urlarchivo'+id).html();
        var totalpc = $('.totalpc'+id).html();
        obj.url = '../puntoscambio/saveSistemas';
        obj.data = info;
        obj.type = 'POST';
        obj.accion = 'saveSistemas';

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
                case "savePalabra":
                    $('.mensaje_sistema').html(res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show");
                                   
                    break;    

                case "saveLanguage":
                    $('.mensaje_sistema').html(res);
                    $('.mensaje').addClass("bg-success");
                    $("#mensajeModal").modal("show");
                    
                    break;

                case "update":
                    $('.mensaje_sistema').html(res.res);
                    $("#mensajeModal").modal("show");
                    break;

                case "delete":
                    $('.mensaje_sistema').html(res);
                    $("#mensajeModal").modal("show");
                    break;

                case "crearSelect":
                    var crearSelect = '';
                    crearSelect += '<select class="form-select language'+datos.idtd+'" aria-label="Default select example">';
                    $.each(res.id, function(key,data){
                        if(Number(data) == Number(datos.idLeng)){
                            crearSelect += '<option value="'+data+'" class="recuperarNombre'+data+'" data-nombreleng="'+res.nombre[key]+'" selected>'+res.nombre[key]+'</option>'; 
                        }else{
                            crearSelect += '<option value="'+data+'" class="recuperarNombre'+data+'" data-nombreleng="'+res.nombre[key]+'" >'+res.nombre[key]+'</option>';
                        }
                    });
                    crearSelect += '</select>';
                    $('.nombreLeng'+datos.idtd).html(crearSelect);
                    break;

                case "saveSistemas":
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

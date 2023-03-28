$(document).ready(function() {
    var obj = {};
    $('#myTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "lengthMenu": [
            [10, 20, 50, -1],
            [10, 20, 50, "Mostrar Todo"]
        ],
        dom: 'fr<"col-md-6 inline"l><"row"B> ti<"col-md-7 inline"p>',

        buttons: [

            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>Excel',
                title: 'Sistemas',
                titleAttr: 'Excel',
                className: 'btn btn-app export excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                }
            }
        ],

        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }


    });
    $('.editar').click(function() {
        var id = $(this).data('id');
        var estatus_id = $(this).data('idestatus');
        var checkmarx = $('.checkmarx' + id).html();
        var aprobado = $('.aprobado' + id).html();
        var fuente = $('.fuente' + id).html();
        var resuelto = $('.resuelto' + id).html();
        var aprobados = $('.aprobados' + id).html();
        var altas = $('.altas' + id).html();
        var medias = $('.medias' + id).html();
        var bajas = $('.bajas' + id).html();
        var observacion = $('.observacion' + id).html();

        obj.idtd = id;
        obj.idestatus = estatus_id;
        obj.url = '../sistema/crearSelect';
        obj.data = {};
        obj.type = 'POST';
        obj.accion = 'crearSelect';
        peticionAjax(obj);

        $('.checkmarx' + id).html('<input style="width:100%" class="form-control checkmarxIN' + id + '" value=' + checkmarx + '>');
        $('.aprobado' + id).html('<input style="width:100%" class="form-control aprobadoIN' + id + '" value=' + aprobado + '>');
        $('.fuente' + id).html('<input style="width:100%" class="form-control fuenteIN' + id + '" value=' + fuente + '>');
        $('.resuelto' + id).html('<input min="0" style="width:100%" class="form-control resueltoIN' + id + '" value=' + resuelto + '>');
        $('.aprobados' + id).html('<input min="0" style="width:100%" class="form-control aprobadosIN' + id + '" value=' + aprobados + '>');
        $('.altas' + id).html('<input min="0" style="width:100%" class="form-control altasIN' + id + '" value=' + altas + '>');
        $('.medias' + id).html('<input min="0" style="width:100%" class="form-control mediasIN' + id + '" value=' + medias + '>');
        $('.bajas' + id).html('<input min="0" style="width:100%" class="form-control bajasIN' + id + '" value=' + bajas + '>');
        $('.observacion' + id).html('<input style="width:100%" class="form-control observacionIN' + id + '" value=' + observacion + '>');

        $('.resueltoIN' + id).keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });
        $('.aprobadosIN' + id).keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });
        $('.altasIN' + id).keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });
        $('.mediasIN' + id).keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });
        $('.bajasIN' + id).keypress(function(tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });
        $('.editar_acciones_' + id).hide();
        $('.editar_acciones_cancelar' + id).removeAttr('style');
    });

    $('.save').click(function() {
        var id = $(this).data('id');
        var selectEstatusId = $('.selectEstatus' + id).val();
        var selectEstatusText = $('.opcionEstatus' + selectEstatusId).data('estatus');
        var checkmarx = $('.checkmarxIN' + id).val();
        var aprobado = $('.aprobadoIN' + id).val();
        var fuente = $('.fuenteIN' + id).val();
        var resuelto = $('.resueltoIN' + id).val();
        var aprobados = $('.aprobadosIN' + id).val();
        var altas = $('.altasIN' + id).val();
        var medias = $('.mediasIN' + id).val();
        var bajas = $('.bajasIN' + id).val();
        var observacion = $('.observacionIN' + id).val();
        //modi
        var totalPDC = $('.total' + id).text();
        let totalSuma = parseInt(altas) + parseInt(bajas) + parseInt(medias);
        //alert(totalSuma + "/" + totalPDC);
        let totalresyapro = (parseInt(resuelto)) + (parseInt(aprobados));
        if ((totalresyapro !== parseInt(totalPDC)) || totalSuma !== (parseInt(totalPDC))) {
            $('.mensaje_sistema').html('Existe discrepancia entre el total de puntos de cambio y los nuevos datos');
            $('#mensajeModal').modal('show');
        } else {

            obj.url = '../sistema/updateSistema';
            obj.data = {
                idSistema: id,
                idEstatus: selectEstatusId,
                checkmarx: checkmarx,
                aprobado: aprobado,
                fuente: fuente,
                resuelto: resuelto,
                aprobados: aprobados,
                altas: altas,
                medias: medias,
                bajas: bajas,
                observacion: observacion
            };
            obj.type = 'POST';
            obj.accion = 'update';

            $('.estatus' + id).html(selectEstatusText);
            $('.checkmarx' + id).html(checkmarx);
            $('.aprobado' + id).html(aprobado);
            $('.fuente' + id).html(fuente);
            $('.resuelto' + id).html(resuelto);
            $('.aprobados' + id).html(aprobados);
            $('.altas' + id).html(altas);
            $('.medias' + id).html(medias);
            $('.bajas' + id).html(bajas);
            $('.observacion' + id).html(observacion);
            $('.editar_acciones_' + id).show();
            $('.editar_acciones_cancelar' + id).hide();
            peticionAjax(obj);
        } //cierra else
    });

    $('.cancelar').click(function() {
        var id = $(this).data('id');
        var estatus = $(this).data('estatusnombre');
        var checkmarx = $(this).data('checkmarx');
        var aprobado = $(this).data('aprobado');
        var resuelto = $(this).data('resuelto');
        var aprobados = $(this).data('aprobados');
        var fuente = $(this).data('fuente');
        var altas = $(this).data('altas');
        var medias = $(this).data('medias');
        var bajas = $(this).data('bajas');
        var observacion = $(this).data('observacion');

        $('.estatus' + id).html(estatus);
        $('.checkmarx' + id).html(checkmarx);
        $('.aprobado' + id).html(aprobado);
        $('.fuente' + id).html(fuente);
        $('.resuelto' + id).html(resuelto);
        $('.aprobados' + id).html(aprobados);
        $('.altas' + id).html(altas);
        $('.medias' + id).html(medias);
        $('.bajas' + id).html(bajas);
        $('.observacion' + id).html(observacion);
        $('.editar_acciones_' + id).show();
        $('.editar_acciones_cancelar' + id).hide();
    });

    $('.cerrarModal').click(function(){
        $('#mensajeModal').modal("hide");
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
                    break;
                case "crearSelect":
                    var select = '';
                    select += '<select class="form-select selectEstatus' + datos.idtd + '">';
                    $.each(res.id, function(key, val) {
                        if (val == datos.idestatus) {
                            select += '<option value="' + val + '" class="opcionEstatus' + val + '" data-estatus="' + res.estatus[key] + '" selected>' + res.estatus[key] + '</option>'
                        } else {
                            select += '<option value="' + val + '" class="opcionEstatus' + val + '" data-estatus="' + res.estatus[key] + '" >' + res.estatus[key] + '</option>'
                        }
                    });
                    select += '</select>'
                    $('.estatus' + datos.idtd).html(select);
                    break;
            }
        },
        error: function(xhr, estatus) {

        }
    });


}
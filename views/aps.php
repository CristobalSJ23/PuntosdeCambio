<button type="button" class="btn btn-primary  agregarNuevo">Crear APS</button>
<br>
<table class="table table-hover" id="myTable">
<thead>
  <tr>
    <th scope="col">#</th>   
    <th scope="col">Nombre</th>
    <th scope="col">Arquitecto</th>
    <th scope="col">Estatus</th>
    <th scope="col">Registro</th>
    <th scope="col">Acciones</th>
  </tr>
</thead>
<tbody>
    
    <?php 
    if(!isset($res['sinData'])){
    foreach($res['id'] as $i => $r){
    ?>
    <tr>
    <th scope="row"><?php echo $i+1?></th>
    <td class="nombreAps<?=$r?>"  data-id="<?=$r?>"> <?php echo $res['nombre'][$i] ?> </td>
    <td class="nombreArquitecto<?=$r?>"  data-id="<?=$r?>"> <?php echo $res['nombreArquitecto'][$i] ?> </td>
    <td class="<?=$res['colores_aps'][$i];?> estatusAps<?= $r ?>" data-id="<?=$r?>" data-color="<?=$res['colores_aps'][$i];?>"><?php echo $res['estatus_aps'][$i] ?></td>
    <td class="fechaReg<?=$r?>"><?php echo $res['fecha_reg'][$i]?></td>
    <td>
          <div class="row editar_acciones_<?= $r ?>" style="width:100%;"> 
              <div class="col"><i class="bi bi-pencil-square editar btn" data-id="<?=$r?>" data-arquitecto="<?= $res['id_arquitecto'][$i] ?>"></i></div> 
              <div class="col"><i class="eliminar bi bi-trash btn" data-id="<?=$r?>"></i></div>
          </div> 
          <div class="row editar_acciones_cancelar_<?= $r ?>" style="display:none;"> 
              <div class="col">  <i class="bi bi-check2-circle btn save" data-id="<?= $r ?>"></i> </div> 
              <div class="col"><i class="bi bi-x-circle cancelar btn" data-id="<?=$r?>" data-nombre="<?= $res['nombre'][$i] ?>"
              data-estatus="<?= $res['estatus_aps'][$i];  ?>" data-color="<?= $res['colores_aps'][$i]; ?>" data-arquitecto="<?= $res['nombreArquitecto'][$i] ?>"></i></div>
              
            </div> 
      </td>
    </tr>
    <?php } }?>
</tbody>

</table>
<div class="modal fade  crearModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white ">Registro de un nuevo rol de usuario</h5>
                <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 frmGuardar" method="POST" enctype="multipart/form-data">

                    <div class="col-md-4">
                        <label for="inputNombre" class="form-label">Nombre del aps:</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" id="imputNombre" required name="nombre"
                                maxlength="50" placeholder="Escriba el nombre">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="arquitecto" class="form-label">Arquitecto:</label>
                        <div class="d-flex">
                            <select class="arquitecto form-select" name="arquitecto" id="arquitecto">
                                <?php foreach($arquitectos['iduser'] as $i => $arq) { ?>
                                    <option value="<?= $arq ?>"><?= $arquitectos['nombre'][$i] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary saveModal">Guardar</button>
                        <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>
</div>

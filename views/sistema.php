<br>
<table class="table table-responsive" id="myTable">
  <thead>
    <tr>
      <th scope="col" >#</th>
      <th scope="col" >Sistema</th>
      <th scope="col" >URL</th>
      <th scope="col" >Estatus</th>
      <th scope="col" >Checkmarx</th>
      <th scope="col" >Aprobado</th>
      <th scope="col" >Fuente</th>
      <th scope="col" >Total PDC</th>
      <th scope="col" >Resueltos</th>
      <th scope="col" >Aprobados</th>
      <th scope="col" >Altas</th>
      <th scope="col" >Medias</th>
      <th scope="col" >Bajas</th>
      <th scope="col" >Observaciones</th>
      <th scope="col" >Acciones</th>
    </tr>
  </thead>
  <tbody>

    <?php
    if(!isset($res['sinData'])){
    foreach ($res['id'] as $i => $r) {
      ?>
      <tr>
        <th scope="row">
          <?php echo $i + 1 ?>
        </th>
        <td class="nombreSistema<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['nombre'][$i] ?> </td>
        <td class="url<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['url'][$i] ?> </td>
        <td class="estatus<?= $r ?>" data-id="<?= $r ?>">
          <?php foreach ($catalogosEstatus['id'] as $c => $catE) { ?>
            <?php if ($catE == $res['id_catE'][$i]) { ?>
              <?= $catalogosEstatus['estatus'][$c] ?></td>
            <?php } ?>
          <?php } ?>
        <td class="checkmarx<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['checkmarx'][$i] ?> </td>
        <td class="aprobado<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['aprobado'][$i] ?> </td>
        <td class="fuente<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['fuente'][$i] ?> </td>
        <td class="total<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['total'][$i] ?> </td>
        <td class="resuelto<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['resuelto'][$i] ?> </td>
        <td class="aprobados<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['aprobados'][$i] ?> </td>
        
        <td class="altas<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['altas'][$i] ?> </td>
        <td class="medias<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['medias'][$i] ?> </td>
        <td class="bajas<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['bajas'][$i] ?> </td>

        <td class="observacion<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['observacion'][$i] ?> </td>
        <td>
          <div class="row editar_acciones_<?= $r ?>" style="width:100%;">
            <div class="col"><i class="bi bi-pencil-square editar btn" data-id="<?= $r ?>" data-idestatus="<?= $res['id_catE'][$i] ?>"></i></div>
          </div>
          <div class="row editar_acciones_cancelar<?= $r ?>" style="display:none;">
            <div class="col"> <i class="bi bi-check2-circle btn save" data-id="<?= $r ?>"></i> </div>
            <div class="col"><i class="bi bi-x-circle cancelar btn" data-id="<?= $r ?>"
                data-estatusnombre="<?= $res['estatus'][$i] ?>" data-checkmarx="<?= $res['checkmarx'][$i] ?>"
                data-aprobado="<?= $res['aprobado'][$i] ?>" data-fuente="<?= $res['fuente'][$i] ?>"
                data-resuelto="<?= $res['resuelto'][$i] ?>" data-aprobados="<?= $res['aprobados'][$i] ?>"
                data-altas="<?= $res['altas'][$i] ?>" data-medias="<?= $res['medias'][$i] ?>"
                data-bajas="<?= $res['bajas'][$i] ?>" data-observacion="<?= $res['observacion'][$i] ?>"
                ></i></div>
            <!-- <div class="col"><i class="eliminar bi bi-trash btn" data-id=""></i></div> -->
          </div>
        </td>
      </tr>
    <?php } } ?>
  </tbody>

</table>
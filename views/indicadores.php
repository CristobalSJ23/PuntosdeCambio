<br>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">URL</th>
      <th scope="col">Gerente asignado</th>
      <th scope="col">Jefe de área asignado</th>
      <th scope="col">Usuario asignado</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php  if(!isset($res['sinData'])){ foreach($res['id'] as $i => $r) { ?>
      <tr>
        <th scope="row"> <?php echo $i + 1 ?> </th>
        <td class="url<?= $r ?>" data-id="<?= $r ?>"> <?php echo $res['url'][$i] ?> </td>
        <td class="gerentes<?= $r?>"> 
          <?php 
            if(isset($gerentes['idgerente'])){
              foreach($gerentes['idgerente'] as $j => $idg) { 
                if($res['gerente'][$i] == $idg) 
                  echo $gerentes['nombre'][$j];
                //else 
                //  echo "Sin asignar";
              } 
            }
          ?>
        </td>
        <td class="jefes<?= $r?>">
        <?php 
         if(isset($jefes['idjefe'])){
            foreach($jefes['idjefe'] as $j => $idg) { 
              if($res['jefe'][$i] == $idg) 
              echo $jefes['nombre'][$j];
            } 
          }
          ?>
        </td>
        <td class="usuarios<?= $r?>">
          <?php 
           if(isset($usuarioAsi['idusuarioa'])){
            foreach($usuarioAsi['idusuarioa'] as $j => $ida) {
              if($res['usuarioasi'][$i] == $ida) 
                echo $usuarioAsi["nombre"][$j];
            }
          }
          ?>
        </td>
        <td>
          <div class="row editar_acciones_<?= $r ?>" style="width:100%;">
            <div class="col"><i class="bi bi-pencil-square editar btn" data-id="<?= $r ?>" data-idgerente="<?= $res['gerente'][$i] ?>" data-idjefe="<?= $res['jefe'][$i] ?>" data-idusuarioa="<?= $res['usuarioasi'][$i] ?>"></i></div>
            <div class="col"><i class="eliminar bi bi-trash btn" data-id="<?= $r ?>"></i></div>
          </div>
          <div class="row editar_acciones_cancelar<?= $r ?>" style="display:none;">
            <div class="col"> <i class="bi bi-check2-circle btn save" data-id="<?= $r ?>"></i> </div>
            <div class="col"><i class="bi bi-x-circle cancelar btn cancelar<?= $r ?>" data-id="<?= $r ?>"></i></div>
            <div class="col"><i class="eliminar bi bi-trash btn" data-id="<?= $r ?>"></i></div>
          </div>
        </td>
      </tr>
    <?php } } ?>
  </tbody>
</table>
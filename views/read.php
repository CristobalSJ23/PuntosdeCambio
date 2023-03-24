<button type="button" class="btn btn-primary crear-rol">Crear nuevo rol</button>
<br>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha De Registro</th>
      <th scope="col">Fecha De Actualizacion</th>
      <th scope="col">Fecha De Baja</th>
      <th scope="col">Estatus</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>

    <?php


    if(!isset($res['sinData'])){
        foreach ($res['id'] as $i => $r) {
        
          ?>

      <tr>
        <th scope="row">
          <?php echo $i + 1; ?>
        </th>
        <td class="editar_nombre_<?= $r ?>" data-id="<?= $r ?>"><?php echo $res['nombre'][$i] ?></td>
        <td>
          <?php echo $res['fecha_reg'][$i]; ?>
        </td>
        <td>
          <?php echo $res['fecha_up'][$i]; ?>
        </td>
        <td>
          <?php echo $res['fecha_de'][$i]; ?>
        </td>
        <td class="<?= $res['bg'][$i]; ?> editar_estatus_<?= $r ?>" data-id="<?= $r ?>" data-color="<?= $res['bg'][$i]; ?>"><?= $res['estatus'][$i]; ?></td><td>
          <div class="row editar_acciones_<?= $r ?>" style="width:100%;">
            <div class="col"><i class="bi bi-pencil-square editar btn" data-id="<?= $r ?>"></i></div>
            <div class="col"><i class="eliminar bi bi-trash btn" data-id="<?= $r ?>"></i></div>
          </div>
          <div class="row editar_acciones_cancelar<?= $r ?>" style="display:none;">
            <div class="col"> <i class="bi bi-check2-circle btn save" data-id="<?= $r ?>"></i> </div>
            <div class="col"><i class="bi bi-x-circle cancelar btn" data-id="<?= $r ?>"
                data-nombre="<?= $res['nombre'][$i] ?>" data-estatus="<?= $res['estatus'][$i]; ?>"
                data-color="<?= $res['bg'][$i]; ?>"></i></div>
            <!-- <div class="col"><i class="eliminar bi bi-trash btn" data-id=""></i></div> -->
          </div>
        </td>
      </tr>
    <?php } }?>

  </tbody>
</table>





<div class="modal fade  crear_rol_modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white">Registro de un nuevo rol de usuario</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row g-3 frmGuardar" method="POST" enctype="multipart/form-data">

          <div class="col-md-4">
            <label for="inputNombre" class="form-label">Nombre del rol de usuario:</label>
            <div class="d-flex">
              <input type="text" class="form-control" id="imputNombre" /required name="nombre" maxlength="50"
                placeholder="Escriba el nombre">
            </div>
            <?php if (isset($datos['errorRol'])) { ?>
              <div class="alert alert-danger">
                <?= $datos['errorRol'] ?>
              </div>
            <?php } ?>
          </div>

          <div class="accordion" id="accordionPanelsStayOpenExample">
            <table>
              <?php foreach ($resMenu['nombre_menu'] as $i => $rm) { ?>
                <tr>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input accordion abrir" data-id="<?= $resMenu['id'][$i] ?>" type="checkbox"
                        value="" id="flexCheckDefault<?= $resMenu['id'][$i] ?>" data-bs-toggle="collapse"
                        data-bs-target="#<?= $i ?>-collapseOne" aria-controls="panelsStayOpen-collapseOne">
                      <label class="form-check-label" for="flexCheckDefault"></label>
                    </div>
                  </td>

                  <td width="100%">
                    <div class="accordion-item">
                      <h2 class="accordion-header accordion btn-primary" id="panelsStayOpen-headingOne">
                        <button class="accordion btn btn-primary" type="button" width="100%">
                          <?= $rm ?>
                        </button>
                      </h2>
                      <div id="<?= $i ?>-collapseOne" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                          <ul>
                            <?php
                            //echo "<pre>";
                            //var_dump($resMenu['submenu'][0]['id']);
                          
                            foreach ($resMenu['submenu'][$i]['id'] as $j => $rsm) {
                              //var_dump($resMenu['submenu'][$j]['nombre']);
                              ?>
                              <li><input data-id="<?= $rsm ?>" class="menu_<?= $resMenu['id'][$i] ?> selectSubMenu"
                                  type="checkbox"><?= $resMenu['submenu'][$i]['nombre'][$j] ?></li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary save-rol">Guardar</button>
        <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
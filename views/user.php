<button type="button" class="btn btn-primary crear-usuario">Crear nuevo usuario</button>
<br>
<table class="table" id="myTable">
<thead>
  <tr>
    <th scope="col">#</th>   
    <th scope="col">Nombre</th>
    <th scope="col">A. Paterno</th>
    <th scope="col">A. Materno</th>
    <th scope="col">Usuario</th>
    <th scope="col">Correo</th>
    <th scope="col">Registro</th>
    <th scope="col">Baja</th>
    <th scope="col">Estatus</th>
    <th scope="col">Acciones</th>
  </tr>
</thead>
<tbody>
<?php
 if(!isset($res['sinData'])){
foreach($res['id_usuario'] as $i => $r){
    ?>


  <tr>
      <th scope="row"> <?php echo $i + 1; ?> </th>
      <td class="editar_nombre_<?= $r ?>" data-id="<?=$r?>"><?php echo $res['nombre'][$i] ?></td>
      <td class="apt_pat<?= $r ?>"><?php echo $res['apt_pat'][$i]; ?></td>
      <td class="apt_mat<?= $r ?>"><?php echo $res['apt_mat'][$i]; ?></td>
      <td class="tipo_usuario<?= $r ?>"><?php echo $res['tipo_usuario'][$i]; ?></td>
      <td class="correo<?= $r ?>"><?php echo $res['correo'][$i]; ?></td>
      <td class="fecha_reg<?= $r ?>"><?php echo $res['fecha_reg'][$i]; ?></td>
      <td><?php echo $res['fecha_de'][$i]; ?></td>
      <td class="<?=$res['bg'][$i];?> editar_estatus_<?= $r ?>" data-id="<?=$r?>" data-color="<?=$res['bg'][$i];?>"><?php echo $res['estatusUser'][$i]; ?></td>
      <td>
          <div class="row editar_acciones_<?= $r ?>" style="width:100%;"> 
              <div class="col"><i class="bi bi-pencil-square editar btn" data-id="<?=$r?>"></i></div> 
              <div class="col"><i class="eliminar bi bi-trash btn" data-id="<?=$r?>"></i></div>
          </div> 
          <div class="row editar_acciones_cancelar<?= $r ?>" style="display:none;"> 
              <div class="col">  <i class="bi bi-check2-circle btn save" data-id="<?= $r ?>"></i> </div> 
              <div class="col"><i class="bi bi-x-circle cancelar btn" data-id="<?=$r?>" data-nombre="<?= $res['nombre'][$i] ?>" data-paterno="<?=$res['apt_pat'][$i] ?>" 
              data-materno="<?=$res['apt_mat'][$i] ?>" data-tipousuario="<?=$res['tipo_usuario'][$i] ?>" data-correo="<?=$res['correo'][$i] ?>" data-estatus="<?= $res['estatusUser'][$i];  ?>" data-color="<?= $res['bg'][$i]; ?>"></i></div>
             <!--  <div class="col"><i class="eliminar bi bi-trash btn" data-id=""></i></div> -->
            </div> 
      </td>
    </tr>
<?php } } ?>
</tbody>
</table>

<div class="modal fade crear_usuario_modal" tabindex="-1"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="inputNombre" class="form-label">Nombre del usuario:</label>
            <div class="d-flex">
                <input type="text" class="form-control" id="inputNombre" required name="nombre" maxlength="50" placeholder="Escriba el nombre">
            </div>
            <?php if (isset($datos['errorRol'])) { ?>
                <div class="alert alert-danger"> <?= $datos['errorRol'] ?></div>
            <?php } ?>
          </div>
          <div class="col-md-4">
            <label for="inputPaterno" class="form-label">Apellido paterno:</label>
            <div class="d-flex">
                <input type="text" class="form-control" id="inputPaterno" required name="paterno" maxlength="50" placeholder="Escriba el apellido paterno">
            </div>
          </div>
          <div class="col-md-4">
            <label for="inputMaterno" class="form-label">Apellido materno:</label>
            <div class="d-flex">
                <input type="text" class="form-control" id="inputMaterno" required name="materno" maxlength="50" placeholder="Escriba el apellido materno">
            </div>
          </div>
          <div class="col-md-4">
            <label for="inputTipoUsuario" class="form-label">Tipo de usuario:</label>
            <div class="d-flex">
                <input type="text" class="form-control" id="inputTipoUsuario" required name="tipo_usuario" maxlength="50" placeholder="Interno / Externo">
            </div>
          </div>
          <div class="col-md-4">
            <label for="inputCorreo" class="form-label">Correo del usuario:</label>
            <div class="d-flex">
                <input type="email" class="form-control" id="inputCorreo" required name="correo" maxlength="50" placeholder="Escriba el correo">
            </div>
          </div>
          <div class="col-md-4">
            <label for="inputPassword" class="form-label">Contraseña:</label>
            <div class="d-flex">
                <input type="password" class="form-control" id="inputPassword" required name="password" maxlength="50" placeholder="Escriba la contraseña">
            </div>
          </div>
          <div class="col-md-4">
            <label for="selectRol" class="form-label">Rol:</label>
            <div class="d-flex">
              <select class="form-select rol" name="rol" aria-label="Default select example">
                <?php foreach($roles["id"] as $i=>$rol) { ?>
                  <option value="<?= $rol ?>"><?= $roles["nombre"][$i] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary save-user">Guardar</button>
        <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" >Cerrar</button>
      </div>
    </div>
  </div>
</div>




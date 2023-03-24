<hr>
<div class="container">
    <button type="button" class="btn btn-primary agregarNuevo">Agrega un zip</button>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-3">
            <form id="formPalabra">
                <div class="mb-3">
                    <label for="palabra" class="form-label">¿No encuentras la palabra en el listado? Agregala
                        aquí:</label>
                    <input name="palabraLenguaje" type="text" class="form-control" id="palabra">
                </div>
                <div class="mb-3">
                    <select name="selectorLenguaje" class="form-select" aria-label="Default select example">
                         <?php if(!isset($res['sinData'])){ ?>
                        <?php foreach ($resLenguajes['id'] as $i => $leng) { ?>
                            <option value="<?= $leng ?>"><?= $resLenguajes['nombre'][$i] ?></option>
                        <?php } }?>
                    </select>
                </div>
                <button type="submit" class="guardarPalabra btn btn-primary">Guardar</button>
            </form>
            <br>
            <form id="formLenguaje">
                <div class="mb-3">
                    <label for="lenguaje" class="form-label">¿No encuentras el lenguaje? Agregalo aquí:</label>
                    <input name="lenguaje" type="text" class="form-control" id="lenguaje">
                    <label for="lenguajeExtension" class="form-label">Agrega la extension del lenguaje:</label>
                    <input name="lenguajeExtension" type="text" class="form-control" id="lenguajeExtension" />
                    <br>
                    <button type="submit" class="guardarLenguaje btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        <div class="col-9">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Palabras</th>
                        <th scope="col">Lenguaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(!isset($resPalabras['sinData'])){ foreach ($resPalabras['id'] as $i => $pal) { ?>
                        <tr class="eliminarFila<?= $pal ?>">
                            <th scope="row" value="<?= $pal ?>"><?= $pal ?></th>
                            <td class="nombrePal<?= $pal ?>" data-id="<?= $pal ?>"><?= $resPalabras['nombre'][$i] ?></td>
                            <td class="nombreLeng<?= $pal ?>" data-id="<?= $pal ?>"><?= $resPalabras['lenguaje'][$i] ?></td>
                            <td>
                                <i class="editar bi bi-pencil-square btn editar<?= $pal ?>" data-id="<?= $pal ?>"
                                    data-idlenguaje="<?= $resPalabras['idLeng'][$i] ?>"></i>
                                <i class="eliminar bi bi-trash btn eliminar<?= $pal ?>" data-id="<?= $pal ?>"></i>

                                <i class="save bi bi-check2-circle btn save<?= $pal ?>" data-id="<?= $pal ?>"
                                    style="display:none"></i>
                                <i class="cancelar bi bi-x-circle btn cancelar<?= $pal ?>" data-id="<?= $pal ?>"
                                    style="display:none" data-nombre="<?= $resPalabras['nombre'][$i] ?>"
                                    data-lenguaje="<?= $resPalabras['lenguaje'][$i]; ?>"></i>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="creartabla"></div>
    <div id="divBotonZip" style="display: none;">
            <select class = "form-select selectAPS">
              <option selected disabled value = ''>Selecciona un APS</option>
                <?php
                foreach( $resAPS['id'] as $i=>$varId){
                ?>
                
                <option value = '<?= $varId ?>'><?php echo $resAPS['nombre'][$i]?></option>
                <?php }?>
            </select> 
            <button type="button" class="guardarSistemas btn btn-primary btn-lg">Guardar puntos de cambio</button>
    </div>
</div>



<div class="modal fade  crearModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-footer">
                    <div class="d-flex justify-content-center text-center">

                        <form class="p-5  rounded-lg was-validated" method="post" id="formzip"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="archivos" class="text-white label-st">
                                    <h5 class="modal-title text-white ">Por favor seleccione/arrastre un archivo ZIP: </h5>
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-solid fa-folder"></i>
                                        </span>
                                    </div>


                                    <input type="file" accept=".zip" class="form-control " id="archivos" required
                                        name="envioarchivos">
                                    <!-- "webkitdirectory directory multiple" parametro de html para insertar varios archivos-->
                                    <div class="valid-feedback">Valido</div>
                                    <div class="invalid-feedback">Complete este campo</div>
                                </div>

                            </div>
                            <!-- <a class="btn btn-primary" href="login">Atras</a> -->
                            <button type="submit" class="btn w-25 btn-primary guardarZip">Enviar</button>
                            <button type="button" class="btn btn-secondary cerrarModal"
                                data-dismiss="modal">Cerrar</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="center">
    <h1>¡Bienvenido/a!</h1>
    <hr>
    <form method="post" >
        <div class="txt_field">
            <input type="text"  name="usuario" <?php if(isset($datos['usuario'])){ ?> value="<?= $datos['usuario'] ?>" <?php } ?> >
            <label>Usuario</label>
        </div>
        <?php
            if (isset($datos['errorUsuario'])) {
        ?>
            <div class="alert alert-danger"> <?= $datos['errorUsuario'] ?></div>
        <?php } ?>
        <div class="txt_field">
            <input type="password" name="pass" <?php if(isset($datos['pass'])){ ?> value="<?= $datos['pass'] ?>" <?php } ?> >           
            <label>Contraseña</label>
        </div>
        <?php
            if (isset($datos['errorPassword'])) {
        ?>
            <div class="alert alert-danger"> <?= $datos['errorPassword'] ?> </div>
        <?php } ?>

        <input type="submit" value="Ingresar" name="ingresar">
        
        <?php
            if (isset($datos['errorLogin'])) {
            ?>
                <div class="alert alert-danger mt-2"> <?= $datos['errorLogin'] ?> </div>
            <?php } ?>
        <div class="signup_link">

        </div>
    </form>
</div>
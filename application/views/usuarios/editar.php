<p><?= validation_errors() ?></p>
<div>
  <p><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<div>
<?= form_open('usuarios/editar') ?>
  <p>
    <?= form_hidden('id', $id) ?>
    <?= form_label('Usuario:', 'email') ?>
    <?= form_input('email', $email) ?> <br/>
    <?= form_label('Constraseña:', 'password') ?>
    <?= form_password('password', $password) ?> <br/>
    <?= form_label('Confirmar contraseña:', 'confirmpassword') ?>
    <?= form_password('confirmpassword', $confirmpassword) ?> <br/>
    <?= form_label('Nombre:', 'nombre') ?>
    <?= form_input('nombre', $nombre) ?> <br>
    <?= form_label('Apellidos:', 'apellidos') ?>
    <?= form_input('apellidos', $apellidos) ?> <br/>
  </p>
  <p><?= form_submit('editar', 'Editar') ?>
     <?= form_submit('cancelar', 'Cancelar') ?></p>
<?= form_close() ?>
</div>

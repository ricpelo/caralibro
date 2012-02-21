<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

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
  <p><?= form_submit('editar', 'Editar', 'class="boton"') ?>
     <?= form_submit('cancelar', 'Cancelar', 'class="boton"') ?></p>
<?= form_close() ?>
</div>

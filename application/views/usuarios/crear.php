<?= $mensaje ?>

<?= form_open('usuarios/crear') ?>
  <p>
    <?= form_label('Usuario:', 'email') ?>
    <?= form_input('email', set_value('email')) ?><br/>
    <?= form_label('Constraseña:', 'password') ?>
    <?= form_password('password', set_value('password')) ?><br/>
    <?= form_label('Confirmar contraseña', 'confirm_password') ?>
    <?= form_password('confirm_password', set_value('confirm_password')) ?><br/>
    <?= form_label('Nombre', 'nombre') ?>
    <?= form_input('nombre', set_value('nombre')) ?><br/>
    <?= form_label('Apellidos', 'apellidos') ?>
    <?= form_input('apellidos', set_value('apellidos')) ?><br/>
  </p> 
  <p><?= form_submit('enviar', 'Enviar') ?>
     <?= form_submit('cancelar', 'Cancelar') ?></p>
<?= form_close() ?>

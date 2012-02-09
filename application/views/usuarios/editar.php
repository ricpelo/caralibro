<p><?= validation_errors() ?></p>

<?= form_open('usuarios/editar') ?>
  <p>
    <?= form_hidden('id', $id) ?>
    <?= form_label('Usuario:', 'email') ?>
    <?= form_input('email', $email) ?> <br/>
    <?= form_label('Constraseña:', 'password') ?>
    <?= form_input('password', $password) ?> <br/>
    <?= form_label('Nombre:', 'nombre') ?>
    <?= form_input('nombre', $nombre) ?>
    <?= form_label('Apellido:', 'apellido') ?>
    <?= form_input('apellido', $apellido) ?> <br/>
  </p>
  <p><?= form_submit('editar', 'Editar') ?>
     <?= form_submit('cancelar', 'Cancelar') ?></p>
<?= form_close() ?>

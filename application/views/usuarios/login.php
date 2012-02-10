<div>
  <p><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<?= form_open('usuarios/login') ?>
    <?= form_label('Usuario:', 'email') ?>
    <?= form_input('email') ?><br/>
    <?= form_label('Constraseña:', 'password') ?>
    <?= form_password('password') ?><br/>
 <p><?= form_submit('login', 'Login') ?>
    <?= form_submit('crear', 'Crear usuario')?></p>
<?= form_close() ?>

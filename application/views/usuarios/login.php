<div>
  <p><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<?= form_open('usuarios/login') ?>
    <?= form_label('Usuario:', 'email') ?>
    <?= form_input('email') ?><br/>
    <?= form_label('Constraseña:', 'password') ?>
    <?= form_password('password') ?><br/>
 <p><?= form_submit('login', 'Login') ?></p>
<?= form_close() ?>

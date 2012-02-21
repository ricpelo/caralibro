<p><?= validation_errors() ?></p>
<div>
  <p><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<div>
<?= form_open('usuarios/borrar') ?>
  <p>
    <strong>¿Está seguro que desea borrar su cuenta de usuario?</strong>
  </p>
  <p><?= form_submit('si', 'Si', 'class="boton"') ?>
     <?= form_submit('no', 'No', 'class="boton"') ?></p>
<?= form_close() ?>
</div>

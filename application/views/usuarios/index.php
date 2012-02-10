<div>
<?= form_open('usuarios/index') ?>
  <p>
    <?= form_label('Usuario/email:')  ?> 
    <?= $email ?> <br/>
    <?= form_label('Nombre:') ?>
    <?= $nombre ?><br>
    <?= form_label('Apellidos:') ?>
    <?=  $apellidos ?> <br/>
  </p>
  <p><?= form_submit('editar', 'Editar') ?>
     <?= form_submit('borrar', 'Borrar') ?>
     <?= form_submit('muro', 'Mi muro') ?></p>
<?= form_close() ?>
</div>

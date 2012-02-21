<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

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
  <p><?= form_submit('editar', 'Editar', 'class="boton"') ?>
     <?= form_submit('borrar', 'Borrar', 'class="boton"') ?>
     <?= form_submit('muro', 'Mi muro', 'class="boton"') ?></p>
<?= form_close() ?>
</div>

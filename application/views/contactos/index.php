<div>
  <p>
    <?= form_open('/usuarios/logout') ?>
      Usuario: <?= $usuario ?>
      <?= form_submit('salir', 'Salir') ?>
    <?= form_close() ?>
  </p>
</div>

<div>
  <p><?= $mensaje ?></p>
</div>

<table style="margin: auto" border="1">
  <thead>
    <th>Amigos</th>
    <th> Operaciones</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
       <tr>
	      <td> <?= $fila['nombre_amigo'] ?> </td>
	           <?= form_open ('contactos/borrar_amigo') ?> </td>
 	      <td>
             <?= form_hidden('id_amigo', $fila['id_amigo']) ?>
	           <?= form_submit ('borrar', '         Borrar       ') ?> </td>
	           <?= form_close() ?>
       </tr>
    <?php endforeach; ?>
  </tbody>
</table>

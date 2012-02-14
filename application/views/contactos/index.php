<div>
  <p><?= $mensaje ?></p>
</div>

<table style="margin: auto">
  <thead>
    <th>Amigos</th>
    <th></th>
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

<p><?= anchor('/contactos/buscar', 'Buscar nuevos amigos') ?></p>

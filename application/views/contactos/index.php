<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

  <table style="margin: auto">
    <thead>
      <th><?= $cartel ?> </th>
      <th></th>
    </thead>
    <tbody>
      <?php foreach ($filas as $fila): ?>
         <tr>
	        <td> <?= anchor("/muros/index/{$fila['id_amigo']}", $fila['nombre_amigo']) ?> 
          </td>
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

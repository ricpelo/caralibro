<table style="margin: auto" border="1">
  <thead>
    <th>Amigos</th>
    <th>Operaciones</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
       <tr>
	 <td> <?= $fila['nombre_amigo'] ?> </td>
	   <?= form_open ('contactos/borrar') ?> </td>
 	 <td>
	   <?= form_submit ('borrar', '         Borrar       ') ?> </td>
	   <?= form_close() ?>
      </tr>
   <?php endforeach; ?>
  </tbody>
</table>

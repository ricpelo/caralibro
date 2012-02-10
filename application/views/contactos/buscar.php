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

<table>
  <thead>
    <th> Nombre </th>
    <th> </th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
             
        <td> <?= $fila['nombre'] ?> </td>
	           <?= form_open ('contactos/agregar_amigo') ?> </td>
 	      <td> <?= form_hidden('id_solicitado', $fila['id']) ?>
	           <?= form_submit ('agregar', 'Agregar Amigo') ?> </td>
	           <?= form_close() ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

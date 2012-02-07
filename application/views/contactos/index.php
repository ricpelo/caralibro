<table style="margin: auto" border="1">
  <thead>
    <th>Amigo 1</th>
    <th>Amigo 2</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
        <td><?= $fila['id_amigo1'] ?></td>
        <td><?= $fila['id_amigo2'] ?></td>
            <?= form_open('contactos/borrar') ?>
        <td>
            <?= form_hidden('id', $fila['id']) ?>
            <?= form_submit('borrar', 'Borrar') ?>
        </td>
            <?= form_close() ?>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

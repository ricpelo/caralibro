<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

  <table>
    <tbody>
      <?php foreach ($filas as $fila): ?>			
        <tr>   
				  <?= form_open ('contactos/agregar_amigo') ?>					   
		        <td> 
						  <?= anchor("/muros/index/{$fila['id']}", $fila['nombre']) ?>
					  </td>
					  <td>&nbsp -- &nbsp</td>
	   	      <td> 
						  <?= form_hidden('id_solicitado', $fila['id']) ?>
			        <?= form_submit ('agregar', 'Agregar contacto') ?> 
					  </td>
	        <?= form_close() ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

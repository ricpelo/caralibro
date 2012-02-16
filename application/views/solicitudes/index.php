<div>
  <p><?= isset($mensaje) ? $mensaje : ''?></p>
</div>
<div>
	<table>
		<tbody>
			<?php foreach ($solicitudes as $fila): ?>
				<?php extract($fila); ?>
				<tr>				
					<td class="texto">
						<?= anchor("muros/index/$id_solicitante", $nombre_solicitante . " " . $apellidos_solicitante) ?>
					</td>
					<td>&nbsp -- &nbsp</td>
					<?= form_open('solicitudes/aceptar') ?>
						<td>
							<?= form_hidden('usuario', $usuario) ?>
							<?= form_hidden('id_solicitante', $id_solicitante) ?>
							<?= form_submit('aceptar', 'Aceptar') ?>
						</td>
					<?= form_close() ?>					
					<?= form_open('solicitudes/rechazar') ?>
						<td>
							<?= form_hidden('usuario', $usuario) ?>
							<?= form_hidden('id_solicitante', $id_solicitante) ?>
							<?= form_submit('rechazar', 'Rechazar') ?>
						</td>
					<?= form_close() ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

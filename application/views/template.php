<html>
  <head>
    <title></title>
    <?= link_tag('estilos/caralibro.css') ?>
  </head>
<body>

	<div id="header">
		<p>CaraLibro</p>
		<span id="cerrar_sesion" style="float: right; position: relative; top: -40px">
			<?= anchor("usuarios/logout","Cerrar sesión") ?>
		</span>
	</div>

	<?php if (isset($usuario)): ?>
  <div id="menubotones">
		<table id="tabla_menu_botones">
			<tbody>				
				<tr>
					<td class="boton">
						<?= anchor("muros/index", "Muro de {$this->session->userdata('nombre_completo')}") ?>
					</td>
					<td>&nbsp</td>
					<td class="boton">
						<?= anchor("usuarios/index", "Perfil") ?>
					</td>
					<td>&nbsp</td>
					<td class="boton">
						<?= anchor("contactos/index", "Contactos") ?>
					</td>
					<td>&nbsp</td>
					<td class="boton">
						<?= anchor("solicitudes/index", "Solicitudes") ?>
					</td>
				</tr>				
			</tbody>
		</table>
  </div>
	<?php endif; ?>

  <div id="contents"><?= $contents ?></div>

  <div id="footer">
		<p>Copyright 2012 IES Doñana</p>
	</div>

</body>
</html>

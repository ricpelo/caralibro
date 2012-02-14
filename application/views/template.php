<html>
  <head>
    <title></title>
    <?= link_tag('estilos/caralibro.css') ?>
  </head>
<body>

	<div id="header">
		<img src= "http://localhost/web/caralibro/images/logo.jpg" border= "4" align="left"/>
		<p id="titulo">araLibro</p>		
		<?php if (isset($usuario)): ?>
			<span id="cerrar_sesion">
				<?= anchor("usuarios/logout","Cerrar sesión") ?>
			</span>
			<span id="usuario">
				<?= "Usuario: $nombre_completo" ?>
			</span>
		<?php endif; ?>
	</div>

	<?php if (isset($usuario)): ?>
  <div id="menubotones">
		<table>
			<tbody>				
				<tr>
					<td class="boton">
						<?= anchor("muros/index", "Ir a tu muro") ?>
					</td>
					<td>&nbsp --&nbsp</td>
					<td class="boton">
						<?= anchor("contactos/index", "Contactos") ?>
					</td>
					<td>&nbsp --&nbsp</td>
					<td class="boton">
						<?= anchor("solicitudes/index", "Solicitudes") ?>
					</td>
					<td>&nbsp --&nbsp</td>
					<td class="boton">
						<?= anchor("usuarios/index", "Perfil") ?>
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

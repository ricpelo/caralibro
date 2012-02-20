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
			<span id="capa_cerrar_sesion">
				<?= anchor("usuarios/logout", "Cerrar sesión", array('id' => 'cerrar_sesion')) ?>
			</span>
			<span id="usuario">
				<?= "Usuario: $nombre_completo" ?>
			</span>
		<?php endif; ?>
	</div>

	<?php if (isset($usuario)): ?>
  <div class="menubotones">
		<table style="padding-left: 10px;">
			<tbody>				
				<tr>
					<td>
						<?= anchor("muros/index", "Ir a tu muro") ?>
					</td>
					<td style="color: white;">&nbsp --&nbsp</td>
					<td>
						<?= anchor("contactos/index", "Contactos") ?>
					</td>
					<td style="color: white;">&nbsp --&nbsp</td>
					<td>
						<?= anchor("solicitudes/index", "Solicitudes") ?>
					</td>
					<td style="color: white;">&nbsp --&nbsp</td>
					<td>
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

<html>
  <head>
    <title></title>
    <?= link_tag('estilos/caralibro.css') ?>
  </head>
<body>

	<div id="header">
		<img src= "http://localhost/web/caralibro/images/logo.jpg" border= "1" align="left"/><p>Caralibro</p>
	</div>

	<?php if (isset($usuario)): ?>
  <div id="menubotones">
		<table id="tabla_menu_botones" border=1>
			<tbody>				
				<tr>
					<td class="boton">
						<?= anchor("muros/index", "Muro de $nombre_completo") ?>
					</td>
          <td class="boton">
            <?= anchor("usuarios/logout", "Cerrar sesión") ?>
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

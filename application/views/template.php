<html>
  <head>
    <title></title>
    <?= link_tag('estilos/caralibro.css') ?>
  </head>
<body>

	<div id="header">
		<p>Caralibro</p>
	</div>

	<?php if (isset($usuario)): ?>
  <div id="menubotones">
		<table border="1">
			<tbody>				
				<tr>
					<td id="usuario">
						<a href='muros/index'><?= $nombre_completo ?></a>
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

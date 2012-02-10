<html>
  <head>
    <title></title>
    <?= link_tag('estilos/caralibro.css') ?>
  </head>
<body>

		<div id="header">

			<p>Caralibro</p>

		</div>
    <div id="menubotones">
    <table border="0">
    <tbody>
    <tr>
    <td id="usuario"><?= $usuario ?></td>
    </tr>
    </tbody>
    </table>
    </div>

    <div id="contents"><?= $contents ?></div>

    <div id="footer">
			<p>Copyright 2012 IES Doñana</p>
		</div>

</body>
</html>

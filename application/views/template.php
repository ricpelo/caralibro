<html>
  <head>
    <title></title>
    <style type="text/css">
      #header {
				text-align: center;
				background: #CCC;
				font-size: xx-large;
				border-style: solid;
				border-size: 1px;
			}
			#contents {
				color: blue;
				padding-left: 300px;
				width: medium;
				padding-bottom: 40px;
			}
			.texto {
				color: blue;
			}
			#footer {
				text-align: center;
				border-style: solid;
				border-size: 1px;
				width: 100%;
				background: #CCC;
				position: absolute;
				bottom: 0;
				bottom: -1px;
				height: 40px;
			}			
    </style>
  </head>

<body>

		<div id="header">

			<p>Caralibro</p>

		</div>

    <div id="contents"><?= $contents ?></div>

    <div id="footer">
			<p>Copyright 2012 IES Doñana</p>
		</div>

</body>
</html>

<div id="menu_muro">

	<p>Muro de: <?= $propietario_muro ?></p>
  
</div>

<div>
  <p><?= $mensaje ?></p>
</div>

<div id="cuadro_texto">
	Escribe tu comentario:
  <form action="index.php" method="post">
    <input type="hidden" name="id_propietario"/>
    <input type="hidden" name="id_receptor"/>
    <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
    <br/><br/>
    <input type="submit" value="Enviar"/>
  </form>
</div>

<br/><br/>

<?php foreach ($contactos as $contacto): ?>
	<?php extract($contacto); ?>
		<div class = "contenedor">
			<span class = "propietario">  
				<?= anchor("muros/index/$id_prop" , $nombre_prop . ' ' .  $apellidos_prop) ?> escribió:				               
			</span>
			<form action="index.php" method="post">
				<div class = "borrar">				
				  <input type="hidden" name="id_envio" value="<?= $id_envio ?>"/>
				  <input type="submit" value="X"/>
				</div>
			</form>  
		</div>
		<div class="envio">
			 <div class="cuerpo"><?= $texto ?></div>
			 <div class="fechahora"><?= $fechahora ?></div>
		</div>
		<br/>
<?php endforeach; ?>


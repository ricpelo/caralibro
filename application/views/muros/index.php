<div id="menu_muro">

	<p>Muro de: <?= $propietario_muro ?></p>
  
</div>

<div>
  <p><?= $mensaje ?></p>
</div>

<div id="cuadro_texto">
	Escribe tu comentario:
  <?= form_open('muros/enviar') ?>
    <?= form_hidden('id_propietario', $id_propietario_muro); ?>
    <?= form_hidden('id_emisor_mensaje', $emisor_mensaje); ?>
    <?= form_textarea(array('name' =>'texto', 'rows'=>'10', 'cols'=>'80'));?>   
    <br/><br/>
    <?= form_submit('enviar', 'Enviar') ?>    
  <?= form_close() ?>
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


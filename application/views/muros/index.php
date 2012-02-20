<div id="menu_muro">

	<p>Muro de: <?= $propietario_muro ?></p>
  
</div>

<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

<div id="cuadro_texto">
	Escribe tu comentario:
  <?= form_open('muros/enviar') ?>
    <?= form_hidden('id_propietario', $id_propietario_muro); ?>
    <?= form_hidden('id_emisor_mensaje', $id_emisor_mensaje); ?>
    <?= form_textarea(array('name' =>'texto', 'rows'=>'10', 'cols'=>'80'));?>   
    <br/><br/>
    <?= form_submit('enviar', 'Enviar', 'class="boton"') ?>
  <?= form_close() ?>
</div>

<br/><br/>

<?php foreach ($envios as $envio): ?>
	<?php extract($envio); ?>
		<div class = "contenedor">
			<span class = "propietario">  
				<?= anchor("muros/index/$id_prop" , $nombre_prop . ' ' .  $apellidos_prop) ?> escribió:				               
			</span>
			<?= form_open('muros/borrar_envio/'); ?>
				<div class = "borrar">
				  <?= form_hidden('id_envio', $id_envio) ?>
				  <?= form_submit('borrar', 'X') ?>
				</div>
			<?= form_close() ?>
		</div>
		<div class="envio">
			 <div class="cuerpo"><?= $texto ?></div>
			 <div class="fechahora"><?= $fechahora ?></div>
		</div>
		<div class="me_gusta">
			A nadie le gusta esto
		</div> 
		<div id="cuadro_texto">
		  <?= form_open('muros/comentar'); ?>
		  <?= form_hidden('id_envio', $id_envio); ?>
		  <?= form_textarea(array('name' => 'texto', 'rows' => '3', 'col' =>'30')); ?>
		  <br/>
		  <?= form_submit('comentar', 'Comentar', 'class="boton"') ?>
		  <?= form_close() ?>
		</div>
		<br/>
<?php endforeach; ?>


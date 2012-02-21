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
			<?php if ($total_gustos == 1 && $me_gusta): ?>
				Te gusta esto
			<?php elseif ($total_gustos == 2 && $me_gusta): ?>
				A ti y a otra persona os gusta esto
			<?php elseif ($total_gustos > 1 && $me_gusta): ?>
				A <?= $total_gustos - 1 ?> personas y a tí os gusta esto 
			<?php elseif ($total_gustos > 1 && !$me_gusta): ?>
				A <?= $total_gustos ?> personas les gusta esto
			<?php elseif ($total_gustos == 1 && !$me_gusta): ?>
				A una persona le gusta esto
			<?php else: ?>
				A nadie le gusta esto
			<?php endif; ?>
			<?php if (!$me_gusta): ?>
				<?= form_open("muros/agregar_me_gusta/$id_envio") ?>
					<?= form_submit('me_gusta', 'Me gusta', 'class="boton"') ?>
				<?= form_close() ?>
			<?php else: ?>
				<?= form_open("muros/quitar_me_gusta/$id_envio") ?>
					<?= form_submit('no_me_gusta', 'Ya no me gusta', 'class="boton"') ?>
				<?= form_close() ?>
			<?php endif; ?>
		</div> 
		<div id="cuadro_texto">
		  <?= form_open('muros/comentar') ?>
				<?= form_hidden('id_envio', $id_envio) ?>
				<?= form_textarea(array('name' => 'texto', 'rows' => '3', 'col' =>'30')) ?>
				<br/>
				<?= form_submit('comentar', 'Comentar', 'class="boton"') ?>
		  <?= form_close() ?>
		</div>
		<br/>
<?php endforeach; ?>


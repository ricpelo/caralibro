<div id="menu_muro">

	<p>Muro de: <?= $propietario_muro ?></p>
  
</div>

<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>
<div>
	Escribe tu comentario:
  <?= form_open('muros/enviar') ?>
    <?= form_hidden('id_propietario', $id_propietario_muro); ?>
    <?= form_hidden('id_usuario_logueado', $id_usuario_logueado); ?>
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
      <?php if ($id_prop == $id_usuario_logueado || $id_propietario_muro == $id_usuario_logueado): ?>
			<?= form_open('muros/borrar_envio/'); ?>
            
            
				<div class = "borrar">
				  <?= form_hidden('id_envio', $id_envio) ?>
					<?= form_hidden('id_propietario_muro', $id_propietario_muro) ?>
				  <?= form_submit('borrar', 'X', 'class="boton_borrar"') ?>
				</div>
            
        
			<?= form_close() ?>
      <?php endif; ?>
		</div>

		<div class="envio">
			 <div class="cuerpo"><?= $texto ?></div>
			 <div class="fechahora"><?= $fechahora ?></div>
		</div>
		<div class="me_gusta">
			<?php if ($total_gustos == 1 && $me_gusta == "t"): ?>
				Te gusta esto
			<?php elseif ($total_gustos == 2 && $me_gusta == "t"): ?>
				A ti y a otra persona os gusta esto
			<?php elseif ($total_gustos > 1 && $me_gusta == "t"): ?>
				A <?= $total_gustos - 1 ?> personas y a tí os gusta esto 
			<?php elseif ($total_gustos > 1 && $me_gusta == "f"): ?>
				A <?= $total_gustos ?> personas les gusta esto
			<?php elseif ($total_gustos == 1 && $me_gusta == "f"): ?>
				A una persona le gusta esto
			<?php else: ?>
				A nadie le gusta esto
			<?php endif; ?>
			<?php if ($me_gusta == 'f'): ?>
				<?= form_open("muros/agregar_me_gusta/$id_envio") ?>
					<?= form_submit('me_gusta', '', 'class="boton_me_gusta"') ?>
				<?= form_close() ?>
			<?php else: ?>
				<?= form_open("muros/quitar_me_gusta/$id_envio") ?>
					<?= form_submit('no_me_gusta', '', 'class="boton_no_me_gusta"') ?>
				<?= form_close() ?>
			<?php endif; ?>
		</div> 
		
	  <?php foreach ($envio['comentarios'] as $comentario): ?>     
	    <div class="propietario_comentario">
				<?= anchor("muros/index/{$comentario['id_propietario']}", $comentario['nombre']); ?>  
				comentó:									
			</div>
	    <div class="comentario">
			  <div class="cuerpo_comentario"><?= $comentario['texto'] ?></div>
        <div class="fechahora"><?= $comentario['fechahora'] ?></div>
      </div>
      <br/>
		<?php endforeach; ?>
		
		<div class="cuadro_texto">
		  <?= form_open('muros/comentar') ?>
				<?= form_hidden('id_envio', $id_envio) ?>
				<?= form_hidden('id_propietario', $id_propietario_muro) ?>
				<?= form_textarea(array('name' => 'texto', 'rows' => '3', 'col' =>'30', 'class="coment"')) ?>
				<br/>
				<?= form_submit('comentar', 'Comentar', 'class="boton"') ?>
		  <?= form_close() ?>
		</div>
		<br/>
<?php endforeach; ?>


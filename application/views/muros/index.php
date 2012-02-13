<div>
  <p><?= $mensaje ?></p>
</div>

<div>
	Escribe tu comentario:
  <form action="index.php" method="post">
    <input type="hidden" name="id_propietario"/>
    <input type="hidden" name="id_receptor"/>
    <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
    <br/><br/>
    <input type="submit" value="Enviar"/>
  </form>
</div>     

   <?php foreach ($contactos as $contacto): ?>
   <?php extract($contacto); ?>

<div class = "contenedor">
  <span class = "propietario">
    <?= anchor("Muros/index" , $nombre_prop . ' ' .  $apellidos_prop) ?>
                   escribió:
  </span>
  <div class = "borrar">
    <form action="index.php" method="post">
      <input type="hidden" name="id_envio" value="<?= $id_envio ?>"/>
      <input type="submit" value="X"/>
    </form>
  </div>
</div>
<div class="envio">
   <br>
   <div class="cuerpo"><?= $texto ?></div>
   <div class="fechahora"><?= $fechahora ?></div>
</div>
    <?php endforeach; ?>


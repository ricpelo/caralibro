<div>
  <p>
      <?= form_open('/usuarios/logout') ?>
      Usuario: <?= $filas['nombre'] ?> <?= $filas['apellidos'] ?>       
      <?= form_submit('salir', 'Salir') ?>
      <?= form_close() ?> 
  </p>
</div>

<div>
  <p><?= $mensaje ?></p>
</div>

<div>
  <form action="index.php" method="post">
    <input type="hidden" name="id_propietario"/>
    <input type="hidden" name="id_receptor"/>
    <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
    <br/><br/>
    <input type="submit" value="Enviar"/>
  </form>
</div>     

<div>
  <span>
    <a href="index.php" value= "Juanito">
      Pepe Pepito</a> escribió:
  </span>
  <div>
    <form action="index.php" method="post">
      <input type="hidden" name="id_envio"/>
      <input type="submit" value="X"/>
    </form>
  </div>
</div>

<div>
  <div>Noseque</div>
  <div>17/11/1988</div>
</div>


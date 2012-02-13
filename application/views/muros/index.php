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

<div class = "contenedor">
  <span class = "propietario">
    <a href="index.php" value= "Juanito">
      Pepe Pepito</a> escribió:
  </span>
  <div class = "borrar">
    <form action="index.php" method="post">
      <input type="hidden" name="id_envio"/>
      <input type="submit" value="X"/>
    </form>
  </div>
</div>
<div class="envio">
   <br>
   <div class="cuerpo">Hola Caracola</div>
   <div class="fechahora">24/01/1989</div>
</div>


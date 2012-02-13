 <!DOCTYPE html>

  <head>
    <meta charset="UTF-8"/>
    <title>Muro</title>
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
  </head>

<body>
      <p>
        <?php extract($filas); ?>
        <tr>
          <td><?= $nombre ?></td>
          <td><?= $apellidos ?></td>
   
      </p>

    <div class="post">
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

          <div>
              <span>
                <?= anchor("Muros/index" , $nombre_prop . ' ' .  $apellidos_prop) ?>
                   escribió:
              </span>
              <div>
                <form>
                  <input type="hidden" name="id_envio" value="<?= $id_envio ?>"/>
                  <input type="submit" value="X"/>
                </form>
              </div>
            </div>
            <div>
              <div><?= $texto ?></div>
              <div><?= $fechahora ?></div>
            </div>
          
      
      
      <?php endforeach; ?>




</body>


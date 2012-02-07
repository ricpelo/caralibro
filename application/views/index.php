<html>
<head>
	
</head>
<body>
<div>
            <span id="nombre">
              <a href="index.php?id=">
                </a>
            </span>
            
            <hr/>
            <form action="../usuarios/logout.php" method="post">
              <span style="float: right; position: relative; top: -45px">
                
                  <a href="index.php?id="></a>
                
                <input type="submit" value="Cerrar sesión"/>
              </span>
            </form>
          </div>
          <br/><br/>
              
                  <tr>
                    <td>
                    </td>
                  <form action="index.php" method="post">
                    <td>
                    <input type="hidden" name="id_solicitante" value=""/>
                    <input type="hidden" name="id_solicitado" value=""/>
                    <input type="submit" name="aceptar" value="A"/>
                    </td><td>
                    <input type="submit" name="denegar" value="D"/>
                  </form>
                  </td>
                
          <div class="post">
            <form action="index.php" method="post">
              <input type="hidden" name="id_propietario" value=""/>
              <input type="hidden" name="id_receptor" value=""/>
              <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
              <br/><br/>
              <input type="submit" value="Enviar"/>
            </form>
          </div>
          <br/><br/>
        
            <div class="contenedor">
              <span class="propietario">
                <a href="index.php?id=">
                  </a> escribió:
              </span>
              <div class="borrar">
                <form action="index.php" method="post">
                  <input type="hidden" name="id_envio" value=""/>
                  <input type="submit" value="X"/>
                </form>
              </div>
            </div>
            <div class="envio">
              <div class="cuerpo"></div>
              <div class="fechahora"></div>
            </div>
</body>
</html>

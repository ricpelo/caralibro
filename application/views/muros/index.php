<html>
<head>
<title>Caralibro for the peña</title>
<style type="text/css">
      #nombre {
#        padding-left: 10px;
        font-family: sans;
        font-weight: bold;
        font-size: x-large;
      }
      .contactos {
        float: right;
        width: 220px;
        background: red;
        font-size: large;
      }      
      .solicitudes {
        float: left;
        width: 220px;
        background: yellow;
        font-size: x-small;
      }
      .contenedor {
        width: 700px;
        margin: auto;
      }
      .propietario {
        text-align: left;
        padding: 10px;
        border-style: solid;
        border-width: 2px;
        width: 700px;
        margin: auto;
        margin-left: 30px;
        position: relative;
        top: 2px;
        background: #cccccc;
      }
      .envio {
        width: 700px;
        border-style: solid;
        border-width: 2px;
        margin: auto;
        margin-bottom: 20px;
        padding-top: 10px;
      }
      .borrar {
        float: right;
        padding: 10px;
        border-style: solid;
        border-width: 2px;
        margin: auto;
        margin-right: 10px;
        position: relative;
        background: #dddddd;
        color: red;
        font-weight: bold;
      }
      .post {
        width: 600px;
        margin: auto;
        margin-bottom: 20px;
        text-align: center;
        font-size: 5;
      }
      .cuerpo {
        margin: auto;
        padding: 10px;
        text-align: justify;
      }
      .fechahora {
        text-align: right;
        padding: 10px;
        color: gray;
      }
    </style>
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

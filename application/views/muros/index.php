 <!DOCTYPE html>

  <head>
    <meta charset="UTF-8"/>
    <title>Muro</title>
    <style type="text/css">
      #nombre {
#        padding-left: 10px;
        font-family: sans;
        font-weight: bold;
        font-size: x-large;
      }
      .solicitudes {
        float: left;
        width: 220px;
        background: yellow;
        font-size: x-small;
      }
      .contactos {
  
        float: right;
        width: 220px;
        background: green;
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


      


    <div class="post">
            <form action="index.php" method="post">
              <input type="hidden" name="id_propietario"/>
              <input type="hidden" name="id_receptor"/>
              <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
              <br/><br/>
              <input type="submit" value="Enviar"/>
            </form>
    </div>


<div class="contenedor">
              <span class="propietario">
                <a href="index.php" value= "Juanito">
                  Pepe Pepito</a> escribió:
              </span>
              <div class="borrar">
                <form action="index.php" method="post">
                  <input type="hidden" name="id_envio"/>
                  <input type="submit" value="X"/>
                </form>
              </div>
            </div>
            <div class="envio">
              <div class="cuerpo">Noseque</div>
              <div class="fechahora">17/11/1988</div>
            </div>

</body>


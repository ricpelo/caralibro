<?php session_start(); ?>
<!DOCTYPE html>
<html>
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
      .contactos {
        float: right;
        width: 220px;
        background: #DDDDDD;
        font-size: medium;
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
    <?php
      require '../comunes/conexion.php';
      require '../comunes/comprobar_sesion.php';
      
      $error = array();

      if (comprobar_sesion()) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
          $id = trim($_GET['id']);
        } else {
          $id = $_SESSION['id'];
        }
        $id_login = $_SESSION['id'];
      } else {
        $error[] = '';
      }

      if (isset($_POST['aceptar'])) {
        $id_solicitante = trim($_POST['id_solicitante']);
        $id_solicitado = trim($_POST['id_solicitado']);        
        $res = pg_query($con, "begin");
        $res = pg_query($con, "delete from solicitudes
                                where id_solicitante = $id_solicitante and
                                      id_solicitado = $id_solicitado");
        if (pg_affected_rows($res) != 1) {
          $error[] = "Error: no se ha podido eliminar la solicitud";
        } else {
          $min = min($id_solicitante, $id_solicitado);
          $max = max($id_solicitante, $id_solicitado);
          $res = pg_query($con, "insert into contactos (id_amigo1, id_amigo2)
                                 values ($min, $max)");
          if (pg_affected_rows($res) != 1) {
            $error[] = "Error: no se ha podido añadir al contacto";
          }
        }
        $res = pg_query($con, "commit");        
      } else if (isset($_POST['denegar'])) {
        $id_solicitante = trim($_POST['id_solicitante']);
        $id_solicitado = trim($_POST['id_solicitado']);        
        $res = pg_query($con, "delete from solicitudes
                                where id_solicitante = $id_solicitante and
                                      id_solicitado = $id_solicitado");
        if (pg_affected_rows($res) != 1) {
          $error[] = "Error: no se ha podido eliminar la solicitud";
        }
      } else if (isset($_POST['id_solicitado']) && $_POST['id_solicitado'] != '') {
        $id = $id_solicitado = $_POST['id_solicitado'];
        $res = pg_query($con, "insert into solicitudes (id_solicitante, id_solicitado)
                               values ($id_login, $id_solicitado)");
      } else if (isset($_POST['id_envio']) && $_POST['id_envio'] != '') {
        $id_envio = $_POST['id_envio'];
        $res = pg_query($con, "delete from envios where id = $id_envio");
        
        if (pg_affected_rows($res) != 1) {
          $error[] = "Ha habido un problema al borrar el envío";
        }
      } else if (isset($_POST['id_propietario']) && $_POST['id_propietario'] != '') {
        $id_propietario = trim($_POST['id_propietario']);
        $id = trim($_POST['id_receptor']);
        $texto = trim($_POST['texto']);        
        $res = pg_query($con, "insert into envios (id_propietario, id_receptor, fechahora,
                                                   texto)
                               values ($id_propietario, $id, current_timestamp,
                                       '$texto')");
        
        if (pg_affected_rows($res) == 0) {
          $error[] = "Error: no se ha podido insertar el envío";
        }
      }
      
      if (empty($error)):
        $res = pg_query($con, "select nombre, apellidos
                                 from usuarios
                                where id = $id");
        if (pg_num_rows($res) == 0):
          $error[] = "Error: ese usuario no existe";
        else:
          $fila = pg_fetch_array($res, 0);
          $nombre = $fila['nombre'];
          $apellidos = $fila['apellidos'];
        ?>
          <div>
            <span id="nombre">
              <a href="index.php?id=<?= $id ?>">
                <?= $nombre ?> <?= $apellidos ?></a>
            </span>
            <?php
              if ($id != $id_login):
                $min = min($id, $id_login);
                $max = max($id, $id_login);
                $res = pg_query($con, "select *
                                         from contactos
                                        where id_amigo1 = $min and
                                              id_amigo2 = $max");
                if (pg_num_rows($res) == 0) {
                  $res = pg_query($con, "select *
                                           from solicitudes
                                          where id_solicitante = $id_login and
                                                id_solicitado = $id");
                  if (pg_num_rows($res) != 0) {
                    echo "Solicitud enviada";
                  } else { ?>
                    <form action="index.php" method="post">
                      <input type="hidden" name="id_solicitado" value="<?= $id ?>"/>
                      <input type="submit" value="Solicitar amistad"/>
                    </form>
                  <?php }
                }
              endif; ?>
            <hr/>
            <form action="../usuarios/logout.php" method="post">
              <span style="float: right; position: relative; top: -45px">
                <?php if ($id != $_SESSION['id']): ?>
                  <a href="index.php?id=<?= $_SESSION['id'] ?>"><?= $_SESSION['email'] ?></a>
                <?php else:
                  echo $_SESSION['email'];
                endif; ?>
                <input type="submit" value="Cerrar sesión"/>
              </span>
            </form>
          </div>
          <br/><br/>
          <?php
            if ($id == $id_login) {
              $res = pg_query($con, "select s.*, u.nombre as nombre_solicitante,
                                            u.apellidos as apellidos_solicitante
                                       from solicitudes s join usuarios u
                                         on s.id_solicitante = u.id
                                      where id_solicitado = $id");
                                      
              if (pg_num_rows($res) > 0) {
                echo '<div class="solicitudes"><table><tbody>';
                for ($i = 0; $i < pg_num_rows($res); $i++) {
                  $fila = pg_fetch_array($res, $i);
                  $id_solicitante = $fila['id_solicitante'];
                  $nombre_solicitante = $fila['nombre_solicitante'];
                  $apellidos_solicitante = $fila['apellidos_solicitante']; ?>
                  <tr>
                    <td><?= "$id_solicitante- $nombre_solicitante $apellidos_solicitante" ?>
                    </td>
                  <form action="index.php" method="post">
                    <td>
                    <input type="hidden" name="id_solicitante" value="<?= $id_solicitante ?>"/>
                    <input type="hidden" name="id_solicitado" value="<?= $id_login ?>"/>
                    <input type="submit" name="aceptar" value="A"/>
                    </td><td>
                    <input type="submit" name="denegar" value="D"/>
                  </form>
                  </td>
                <?php
                }
                echo '</tbody></table></div>';
              }
            }
          ?>
          <?php
          $res = pg_query($con, "  select case when $id = c.id_amigo1
                                               then c.id_amigo2
                                               else c.id_amigo1
                                           end as id_amigo,
                                          case when $id = c.id_amigo1
                                               then u2.nombre || ' ' || u2.apellidos
                                               else u1.nombre || ' ' || u1.apellidos
                                           end as nombre_amigo
                                     from contactos c, usuarios u1, usuarios u2
                                    where $id in (id_amigo1, id_amigo2) and
                                          c.id_amigo1 = u1.id and c.id_amigo2 = u2.id");
            if (pg_num_rows($res) > 0) {
              echo '<div class="contactos">';
              for ($i = 0; $i < pg_num_rows($res); $i++) {
                $fila = pg_fetch_array($res, $i);
                $id_amigo = $fila['id_amigo'];
                $nombre_amigo = $fila['nombre_amigo'];
                echo "<a href=\"index.php?id=$id_amigo\">$nombre_amigo</a><br/>";
              }
              echo '</div>';
            }
          ?>
          <div class="post">
            <form action="index.php" method="post">
              <input type="hidden" name="id_propietario" value="<?= $id_login ?>"/>
              <input type="hidden" name="id_receptor" value="<?= $id ?>"/>
              <textarea name="texto" cols="50" rows="6" style="font-size: x-large"></textarea>
              <br/><br/>
              <input type="submit" value="Enviar"/>
            </form>
          </div>
          <br/><br/>
        <?php                                    
          $res = pg_query($con, "select texto, id_propietario as id_prop, e.id as id_envio,
                                        to_char(fechahora, 'DD-MM-YYYY\" a las \"HH24:MI:SS')
                                        as fechahora,
                                        nombre as nombre_prop, apellidos as apellidos_prop
                                   from envios e join usuarios u
                                     on e.id_propietario = u.id
                                  where id_receptor = $id");

          for ($i = 0; $i < pg_num_rows($res); $i++):
            $fila = pg_fetch_array($res, $i);
            $fechahora = $fila['fechahora'];
            $texto = $fila['texto'];
            $id_prop = $fila['id_prop'];            
            $nombre_prop = $fila['nombre_prop'];
            $apellidos_prop = $fila['apellidos_prop'];
            $id_envio = $fila['id_envio'];
        ?>
            <div class="contenedor">
              <span class="propietario">
                <a href="index.php?id=<?= $id_prop ?>">
                  <?= $nombre_prop ?> <?= $apellidos_prop ?></a> escribió:
              </span>
              <div class="borrar">
                <form action="index.php" method="post">
                  <input type="hidden" name="id_envio" value="<?= $id_envio ?>"/>
                  <input type="submit" value="X"/>
                </form>
              </div>
            </div>
            <div class="envio">
              <div class="cuerpo"><?= $texto ?></div>
              <div class="fechahora"><?= $fechahora ?></div>
            </div>
        
        <?php
          endfor;
        endif;
      endif;
      
      foreach ($error as $err) {
        echo "<p><strong>$err</strong></p>";
      }
      
      pg_close($con);
    ?>
  </body>
</html>

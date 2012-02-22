<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muro extends CI_Model  {

	function obtener_datos_contenedor($id, $id_usuario_logueado) {
		return $this->db->query("select *,
														 (select count(*) != 0 from gustos g where g.id_envio = d.id_envio and g.id_usuario = ?) as me_gusta
														 from datos_cantidad d
														 where id_receptor = ?
														 order by fechahora desc", array($id_usuario_logueado, $id))->result_array();
	}

  function hacer_envio($id_emisor, $id_receptor, $texto) {
    return $this->db->query("insert into envios (id_propietario, id_receptor, texto)
                              values (?,?,?)", array($id_emisor, $id_receptor, $texto));
  }

  function recoger_comentario($id) {
    return $this->db->query("select id from comentarios when id_propietario = ?", array($id));
  }
   
  function cual_puedo_borrar($id_envio) {
    return $this->db->query("select id_propietario from envios where id = ?", array($id_envio));
  }
  
  function borrar_envio($id_envio) {
    return $this->db->query("delete from envios where id = ?", array($id_envio));
  }
  
  function borrar_comentario($id_envio) {
    return $this->db->query("delete from comentarios where id = ?", array($id_envio));
  }

  function hacer_comentario($id_envio, $id_propietario, $texto) {
    return $this->db->query("insert into comentarios (id_envio, id_propietario, texto)
                             values (?, ?, ?)", array($id_envio, $id_propietario, $texto));
  }
  
  function obtener_comentarios($id_envio) {
    return $this->db->query("select texto, to_char(fechahora, 'DD-MM-YYYY\" a las \"HH24:MI:SS')
                                        as fechahora, nombre || ' ' || apellidos  as nombre, id_propietario
                               from comentarios c, usuarios u 
                             where u.id = id_propietario and id_envio = ? order by fechahora asc", array($id_envio))->result_array();
  }       
}



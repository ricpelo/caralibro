<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muro extends CI_Model  {

	function obtener_datos_contenedor($id) {
		return $this->db->query("select texto, id_propietario as id_prop, e.id as id_envio,
		                                      to_char(fechahora, 'DD-MM-YYYY\" a las \"HH24:MI:SS')
		                                      as fechahora,
		                                      nombre as nombre_prop, apellidos as apellidos_prop
		                                 from envios e join usuarios u
		                                   on e.id_propietario = u.id
		                                where id_receptor = $id
		                                order by fechahora desc")->result_array();

	}


  function hacer_envio($id_emisor, $id_receptor, $texto) {
    return $this->db->query("insert into envios (id_propietario, id_receptor, texto)
                              values (?,?,?)", array($id_emisor, $id_receptor, $texto));
  }

  function recoger_envio($id) {
    return $this->db->query("select id from envios where id_propietario = $id");
  }
    
  
  function borrar_envio($id_envio) {
    return $this->db->query("delete from envios where id = $id_envio");
  }
  
  function hacer_comentario($id_envio, $id_propietario, $texto) {
    return $this->db->query("insert into comentarios (id_envio, id_propietario, texto)
                             values (?, ?, ?)", array($id_envio, $id_propietario, $texto));
  }
  
  function obtener_comentarios($id_envio) {
    return $this->db->query("select texto, fechahora, nombre || ' ' || apellidos  as nombre
                               from comentarios c, usuarios u 
                             where u.id = id_propietario and id_envio = ? order by fechahora desc", array($id_envio))->result_array();
  }       
}



<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muro extends CI_Model  {


function obtener_datos_contenedor($id) {

	return $this->db->query("select texto, id_propietario as id_prop, e.id as id_envio,
                                        to_char(fechahora, 'DD-MM-YYYY\" a las \"HH24:MI:SS')
                                        as fechahora,
                                        nombre as nombre_prop, apellidos as apellidos_prop
                                   from envios e join usuarios u
                                     on e.id_propietario = u.id
                                  where id_receptor = $id")->result_array();

}


// Obtiene el id del usuario que ha iniciado sesion
  function obtener_id() {
    $email = $this->session->userdata('usuario');
    return $this->db->query("select id from usuarios where email = '$email'")->row_array();
  }

  
}



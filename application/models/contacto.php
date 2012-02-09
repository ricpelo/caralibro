<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Model {
  
  // Obtiene los amigos del usuario que ha iniciado sesion
  function obtener_mis_amigos($id) {
    return $this->db->query("select case when $id = c.id_amigo1
                                               then c.id_amigo2
                                               else c.id_amigo1
                                           end as id_amigo,
                                          case when $id = c.id_amigo1
                                               then u2.nombre || ' ' || u2.apellidos
                                               else u1.nombre || ' ' || u1.apellidos
                                           end as nombre_amigo
                               from contactos c, usuarios u1, usuarios u2
                              where $id in (id_amigo1, id_amigo2) and
                    c.id_amigo1 = u1.id and c.id_amigo2 = u2.id")->result_array();
  }

  // Obtiene el id del usuario que ha iniciado sesion
  function obtener_id() {
    $email = $this->session->userdata('usuario');
    return $this->db->query("select id from usuarios where email = '$email'")->row_array();
  }
  
  function borrar($min, $max) {
    $res = $this->db->query("delete from contactos 
                              where id_amigo1 = $min and id_amigo2 = $max");
    if (pg_num_rows($res) == 0) {
      return true;
    } else {
      return false;
    }
  }
} 

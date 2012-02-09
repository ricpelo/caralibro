<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Model {
  
  function obtener_mis_amigos() {
    return $this->db->query("select case when 1 = c.id_amigo1
                                               then c.id_amigo2
                                               else c.id_amigo1
                                           end as id_amigo,
                                          case when 1 = c.id_amigo1
                                               then u2.nombre || ' ' || u2.apellidos
                                               else u1.nombre || ' ' || u1.apellidos
                                           end as nombre_amigo
                               from contactos c, usuarios u1, usuarios u2
                              where 1 in (id_amigo1, id_amigo2) and
                    c.id_amigo1 = u1.id and c.id_amigo2 = u2.id")->result_array();
  }

  
}

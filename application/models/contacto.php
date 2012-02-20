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

  // Borramos un amigo
  function borrar($min, $max) {
    return $this->db->query("delete from contactos 
                              where id_amigo1 = $min and id_amigo2 = $max");
  }

  // Muestra todos los contactos existentes
  function obtener_todos($id) {
    return $this->db->query("select id, nombre || ' ' || apellidos as nombre
                               from usuarios
                              where id in (select id from usuarios where id != $id
                                       except
                                      (select id_amigo2 from contactos 
                                        where id_amigo1 = $id
                                        union
                                       select id_amigo1 from contactos 
                                        where id_amigo2 = $id)
                                       except
                                      (select id_solicitante from solicitudes 
                                        where id_solicitado = $id
                                        union
                                       select id_solicitado from solicitudes 
                                        where id_solicitante = $id));")->result_array();
  }

  function agregar_contacto($id_solicitado, $id_solicitante) {
    $id_amigo1 = min($id_solicitado, $id_solicitante);
    $id_amigo2 = max($id_solicitado, $id_solicitante);
    return $this->db->query("insert into contactos(id_amigo1, id_amigo2)
                                            values($id_amigo1, $id_amigo2)");
  }
  //cambios
  function tiene_solicitud($id_solicitante) {
		return $this->db->query("select id_solicitado from solicitudes 
														 where id_solicitante = ?", array($id_solicitante));
	}
} 

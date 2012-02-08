<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitud extends CI_Model  {

	function obtener_solicitudes($usuario) {
		return $this->db->query("select s.*, u.nombre as nombre_solicitante,
                                            u.apellidos as apellidos_solicitante
                                       from solicitudes s join usuarios u
                                         on s.id_solicitante = u.id
                                      where id_solicitado = ?", array($usuario))->result_array();
	}

	function borrar_solicitud($id_solicitado, $id_solicitante) {
		if ($this->existe_solicitud($id_solicitado, $id_solicitante)->num_rows() == 1) {
			return $this->db->query("delete 
						 									 from solicitudes 
						 									 where id_solicitado = ? and id_solicitante = ?", array($id_solicitado, $id_solicitante));
		}
	}

	private function existe_solicitud($id_solicitado, $id_solicitante) {
		return $this->db->query("select * from solicitudes 
														 where id_solicitado = ? and id_solicitante = ?", array($id_solicitado, $id_solicitante));
	}

	function crear_solicitud($id_solicitado, $id_solicitante) {
		if ($this->existe_solicitud($id_solicitado, $id_solicitante)->num_rows() == 0) {
			return $this->db->query("insert into solicitudes (id_solicitante, id_solicitado)
															 values (?, ?)", array($id_solicitado, $id_solicitante));
		}
	}
}

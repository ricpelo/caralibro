<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades {

  function comprobar_vacio($variable){
    return $variable && $variable != '';
  }

	function obtener_datos_plantilla() {
	  $this->CI =& get_instance();
		$nombre = $this->CI->session->userdata('nombre');
		$apellidos = $this->CI->session->userdata('apellidos');
		$data['nombre_completo'] = $nombre . ' ' . $apellidos;
		$data['usuario'] = $this->CI->session->userdata('id');
		return $data;
	}

	function _obtener_nombre_usuario($id) {
		$this->CI =& get_instance();
		return $this->CI->db->query("select nombre || ' ' || apellidos from usuarios where id = ?", array($id));
	}

}

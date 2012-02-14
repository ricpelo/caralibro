<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades {

  function comprobar_vacio($variable){
    return $variable && $variable != '';
  }

	function obtener_datos_plantilla() {
	  $this->CI =& get_instance();
		$data['nombre_completo'] = $this->CI->session->userdata('nombre_completo');
		$data['usuario'] = $this->CI->session->userdata('id');
		$id_muro = $this->CI->session->userdata('id_muro');
		$data['usuario_muro'] = $this->_obtener_nombre_usuario($id_muro);
		return $data;
	}

	function _obtener_nombre_usuario($id) {
		$this->CI =& get_instance();
		return $this->CI->db->query("select nombre || ' ' || apellidos from usuarios where id = ?", array($id));
	}

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades {

  function comprobar_vacio($variable){
    return $variable && $variable != '';
  }

	function obtener_datos_plantilla() {
	  $CI =& get_instance();
		$nombre = $CI->session->userdata('nombre');
		$apellidos = $CI->session->userdata('apellidos');
		$data['nombre_completo'] = $nombre . ' ' . $apellidos;
		$data['usuario'] = $CI->session->userdata('id');
		return $data;
	}

	function _obtener_nombre_usuario($id) {
		$CI =& get_instance();
		return $CI->db->query("select nombre || ' ' || apellidos from usuarios where id = ?", array($id));
	}

  function comprobar_logueo() {
    $CI =& get_instance();
    if (!$CI->session->userdata('usuario')) {
      $CI->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    }
  }
}

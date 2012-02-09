<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitudes extends CI_Controller {

	function __construct() {		
		CI_Controller::__construct();

#		if (!$this->session->userdata('usuario') {
#			$this->session->set_flashdata('mensaje', 'Se requiere login');			
#			redirect("usuarios/login");
#		} 
		$this->load->model('Solicitud');
#   $this->load->model('Contacto');
	}
 
	function index() {
#		$data['usuario'] = $this->session->userdata('usuario');
		$data['usuario'] = 1;
		$data['solicitudes'] = $this->Solicitud->obtener_solicitudes($data['usuario']);
    $mensaje = $this->session->flashdata('mensaje');
    if ($this->utilidades->comprobar_vacio($mensaje)){    
      $data['mensaje'] = $mensaje;
    }else if (empty($data['solicitudes'])){
      $data['mensaje'] = 'No existen solicitudes pendientes';
    }
		$this->template->load('template', 'solicitudes/index', $data);
	}

	function aceptar() {
		$this->_finalizar_solicitud('a');
	}

	function rechazar() {
		$this->_finalizar_solicitud('r');
	}

	function _finalizar_solicitud($opcion) {
		$usuario = $this->input->post('usuario');
		if (!empty($usuario)) {
			$id_solicitado = $this->input->post('usuario');
			$id_solicitante = $this->input->post('id_solicitante');
			$res = $this->Solicitud->borrar_solicitud($id_solicitado, $id_solicitante);
			if ($opcion == 'a') {
#       $this->Contacto->agregar_contacto($id_solitado, $id_solicitante);
				$this->session->set_flashdata('mensaje','El usuario ha sido agregado a amigos');
			}else {
         $this->session->set_flashdata('mensaje','El usuario ha sido rechazado');
      }
  	}
   redirect('solicitudes/index');
  }
}

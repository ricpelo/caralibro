<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitudes extends CI_Controller {

	function __construct() {		
		CI_Controller::__construct();

#		if (!$this->session->userdata('usuario') {
#			$this->session->set_flashdata('mensaje', 'Se requiere login');			
#			redirect("usuarios/login");
#		} 
		$this->load->model('Solicitud');
	}

	function index() {
#		$data['usuario'] = $this->session->userdata('usuario');
		$data['usuario'] = 1;
		$data['solicitudes'] = $this->Solicitud->obtener_solicitudes($data['usuario']);
		$this->load->view('solicitudes/index', $data);
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
				
			}
			$this->load->view('solicitudes/index');
		} else {
			$this->session->set_flashdata('mensaje', 'No existen solicitudes pendientes');
			redirect("/solicitudes/index");
		}
	}
}

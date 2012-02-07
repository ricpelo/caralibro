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
		$this->Solicitud->crear_solicitud(1,2);
		$data['usuario'] = 1;
		$data['solicitudes'] = $this->Solicitud->obtener_solicitudes($data['usuario']);
		$this->load->view('solicitudes/index', $data);
	}

	function aceptar() {
		if ($this->input->post('aceptar')) {
			$id_solicitado = $this->input->post('usuario');
			$id_solicitante = $this->input->post('id_solicitante');
			$res = $this->Solicitud->borrar_solicitud($id_solicitado, $id_solicitante);
		}
	}

	function rechazar() {
		if ($this->input->post('rechazar')) {
			$id_solicitado = $this->input->post('usuario');
			$id_solicitante = $this->input->post('id_solicitante');
			$res = $this->Solicitud->borrar_solicitud($id_solicitado, $id_solicitante);
		}
	}
}

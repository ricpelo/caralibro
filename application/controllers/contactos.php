<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends CI_Controller {

  function __construct() {
    CI_Controller::__construct();
    
    //if (!$this->session->userdata('usuario')) {
    //  $this->session->set_flashdata('mensaje', 'Se requiere autorización');
    //  redirect('usuarios/login');
    //} 
    $this->load->model('Contacto');
  }

  function index() {
    
   $data['filas'] = $this->Contacto->obtener_mis_amigos();
   $this->load->view('contactos/index', $data);

  }

  function borrar_amigo() {
	  $id = $this->input->post('id');
	  $res = $this->Contacto->borrar_amigo($id);
	  if ($res && $this->db->affected_rows() == 1) {
      $this->session->set_flashdata('mensaje', 'Eliminado un amigo de la lista con éxito');
	  } else {
      $this->session->set_flashdata('mensaje', 'No se ha podido borrar al amigo');
	  }
    redirect('contactos/index');
	}
}



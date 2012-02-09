<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends CI_Controller {

  function __construct() {
    CI_Controller::__construct();
    
    if (!$this->session->userdata('usuario')) {
      $this->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    } 
    $this->load->model('Contacto');
  }

  function index() { // muestra la lista con todos mis amigos
    if ($this->session->flashdata('mensaje')) {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    } else {
      $data['mensaje'] = '';
    }
    $data['usuario'] = $this->session->userdata('usuario');
    $id = $this->Contacto->obtener_id();
    $id = (int) $id['id'];
//   $data['id'] = $id;
    $data['filas'] = $this->Contacto->obtener_mis_amigos($id);
    $this->load->view('contactos/index', $data);
  }

  // borra el amigo seleccionado
  function borrar_amigo() {
    $id = $this->Contacto->obtener_id();
    $id = (int) $id['id'];
    $min = min($id, $id_amigo);
    $max = max($id, $id_amigo);
    $this->Contacto->borrar($min, $max);
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



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
    $this->template->load('template', 'contactos/index', $data);
  }

  // borra el amigo seleccionado
  function borrar_amigo() {
    $id = $this->Contacto->obtener_id();
    $id = (int) $id['id'];
    $id_amigo = $this->input->post('id_amigo');
    $min = min($id, $id_amigo);
    $max = max($id, $id_amigo);
    $this->Contacto->borrar($min, $max);
    if ($this->db->affected_rows()) {
      $this->session->set_flashdata('mensaje', 'Se ha borrado un amigo con exito');
    } else {
      $this->session->set_flashdata('mensaje', 'Se ha producido un error al borrar');
    }
    redirect('contactos/index');
  }

  function buscar() {
    $id = $this->Contacto->obtener_id();
    $id = (int) $id['id'];
    $data['usuario'] = $this->session->userdata('usuario');
    $data['mensaje'] = '';
    $data['filas'] = $this->Contacto->obtener_todos($id);
    $this->template->load('template', 'contactos/buscar', $data);
  }
// modelo solicitud agregar solicitud
}

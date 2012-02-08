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

  function index() {
   $id = $this->Contacto->obtener_id();
   $id = (int) $id['id'];
//   $data['id'] = $id;
   $data['filas'] = $this->Contacto->obtener_mis_amigos($id);
   $this->load->view('contactos/index', $data);
   
  }
}



<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muros extends CI_Controller {

  
  function __construct() {
    CI_Controller::__construct();
    
     if (!$this->session->userdata('usuario')) {
     $this->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    } 
  }

  function index() {
     
     $this->load->model('Usuario');

    if ($this->session->flashdata('mensaje')) {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    } else {
      $data['mensaje'] = '';
    }
<<<<<<< HEAD
     $data['usuario'] = $this->session->userdata('usuario');
     $data['fila'] = $this->Usuario->obtenerDatos($data['usuario']);
     $this->template->set('usuario', $data['usuario']);
=======
     $data['usuario'] = $this->session->userdata('usuario');     
     $data['filas'] = $this->Usuario->obtenerDatos($data['usuario']);
     
     

>>>>>>> 614224ca5390c67964d23bd7bb6ffc8094262e2b
     $this->template->load('template','muros/index', $data);
     
  }
  

<<<<<<< HEAD

  function insertar_comentario() {

  }

=======
>>>>>>> 614224ca5390c67964d23bd7bb6ffc8094262e2b
  
  function obtener_datos_envio() {

    $data['filas'] = $this->Muro->obtener_datos($id);
    $this->load->view('muros/index', $data);
	}

}




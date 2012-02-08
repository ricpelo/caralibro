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
     $data['usuario'] = $this->session->userdata('usuario');
     $data['fila'] = $this->Usuario->obtenerDatos($data['usuario']);
    
     $this->load->view('muros/index', $data);
     
  }
  


  function insertar_comentario() {





  }





}



>>>>>>> 81e0e2ad171a94c44ea4064c9cf3151eed4598ab

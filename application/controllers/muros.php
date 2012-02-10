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
     $this->template->set('usuario', $data['usuario']);
     $data['usuario'] = $this->session->userdata('usuario');     
     $data['filas'] = $this->Usuario->obtenerDatos($data['usuario']);
     $nombre = $this->session->userdata('nombre');
     $apellidos = $this->session->userdata('apellidos');
     $data['nombre_completo'] = $nombre . " " . $apellidos;
     $this->template->set('nombre_completo', $data['nombre_completo']);
     $this->template->load('template','muros/index', $data);
     
  }
  

  function insertar_comentario() {

  }
  
  function obtener_datos_envio() {

    $data['filas'] = $this->Muro->obtener_datos($id);
    $this->load->view('muros/index', $data);
	}

}



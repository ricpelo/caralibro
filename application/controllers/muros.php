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
    $this->load->model('Muro');
		$data = $this->utilidades->obtener_datos_plantilla();
    if ($this->session->flashdata('mensaje')) {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    } else {
      $data['mensaje'] = '';
    } 
    $data['filas'] = $this->Usuario->obtenerDatos($data['usuario']);
    $id = (int) $this->Muro->obtener_id();       
 
    $data['contactos'] = $this->Muro->obtener_datos_contenedor($id);
     
    $this->template->load('template','muros/index', $data);    	  
	
  }
 

}




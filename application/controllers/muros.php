<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muros extends CI_Controller {

  
  function __construct() {
    CI_Controller::__construct();
    
     if (!$this->session->userdata('usuario')) {
     $this->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    } 
  }

  function index($id = null) {     
    $this->load->model('Usuario');
    $this->load->model('Muro');
		$data = $this->utilidades->obtener_datos_plantilla();
    if ($this->session->flashdata('mensaje')) {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    } else {
      $data['mensaje'] = '';
    }
    $data['usuario'] = $this->session->userdata('usuario');     
    $data['filas'] = $this->Usuario->obtenerDatos($data['usuario']);
    if ($id == null) {
      $id = $this->session->userdata('id');
    }
    $data['contactos'] = $this->Muro->obtener_datos_contenedor($id);
    $data['id'] = $id;

		/* Se recogen nombre y apellidos del propietario del muro */
		$propietario_muro = $this->Usuario->obtener($id);
		$nombre = $propietario_muro['nombre'];
		$apellidos = $propietario_muro['apellidos'];
		$data['propietario_muro'] = $nombre . ' ' . $apellidos;

    $this->template->load('template','muros/index', $data);    
 	}

  
  function enviar() {

        

  }  


}




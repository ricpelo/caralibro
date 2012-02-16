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
    $email = $this->session->userdata('usuario');     
    $data['filas'] = $this->Usuario->obtenerDatos($email);
    if ($id == null) {
      $id = $this->session->userdata('id');
      
    }
    $data['contactos'] = $this->Muro->obtener_datos_contenedor($id);

		/* Se recogen nombre y apellidos del propietario del muro */
		$propietario_muro = $this->Usuario->obtener($id);
		$nombre = $propietario_muro['nombre'];
		$apellidos = $propietario_muro['apellidos'];
		$data['propietario_muro'] = $nombre . ' ' . $apellidos;
    $data['id_propietario_muro'] = $id;    
    $data['emisor_mensaje'] = $this->session->userdata('id');
    $this->template->load('template','muros/index', $data);    
 	}

  
  function enviar($id_receptor, $id_emisor, $texto) {
    $this->load->model('Usuario');
    $this->load->model('Muro');
    if ($id_receptor == $id_emisor){
         $this->session->set_flashdata('mensaje', 'No puedes enviarte mensajes a ti mismo');
         redirect('muros/index'); 
    } else {
        $this->Muro->hacer_envio($id_receptor, $id_emisor, $texto);
    }       

  }  


}




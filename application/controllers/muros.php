<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muros extends CI_Controller {

  function __construct() {
    CI_Controller::__construct();
    
    $this->load->library('Utilidades');
    $this->utilidades->comprobar_logueo();
  }

  function index($id = null) {     
    $this->load->model('Usuario');
    $this->load->model('Muro');
		$data = $this->utilidades->obtener_datos_plantilla();
    $data['mensaje'] = $this->session->flashdata('mensaje');
    $email = $this->session->userdata('usuario');     
    $data['filas'] = $this->Usuario->obtener_datos($email);
    if ($id == null) $id = $this->Usuario->obtener_id();
    $data['envios'] = $this->Muro->obtener_datos_contenedor($id);

		/* Se recogen nombre y apellidos del propietario del muro */
		$propietario_muro = $this->Usuario->obtener($id);
    $data['id_propietario_muro'] = $id;
    $data['id_emisor_mensaje'] = $this->Usuario->obtener_id();
		$data['propietario_muro'] = $propietario_muro['nombre'] . ' ' . $propietario_muro['apellidos'];
    $this->template->load('template','muros/index', $data);
  }

  function enviar($id_receptor, $id_emisor, $texto) {
    $this->load->model('Usuario');
    $this->load->model('Muro');
    if ($id_receptor == $id_emisor) {
      $this->session->set_flashdata('mensaje', 'No puedes enviarte mensajes a ti mismo');
      redirect('muros/index'); 
    } else {
      $this->Muro->hacer_envio($id_receptor, $id_emisor, $texto);
    }       
    $this->template->load('template','muros/index', $data);
  }

  function borrar_envio() {
    $res = $this->Muro->recoger_envio($id);
    if ($res && $this->db->affected_rows() == 1) { 
      $res = $this->Muro->borrar_envio($id_envio);  
      if ($res && $this->db->affected_rows() == 1) {
          redirect('muros/index');
      } else { 
          $this->session->set_flashdata('mensaje', 'No se ha podido borrar el envío');
      }
    } else {
      $this->session->set_flashdata('mensaje', 'No se ha encontrado ningún envio');
    }
  }

}







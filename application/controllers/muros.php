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

  function enviar() {
    $this->load->model('Usuario');
    $this->load->model('Muro');
    $id_propietario = $this->input->post('id_propietario');
    $id_emisor_mensaje = $this->input->post('id_emisor_mensaje');
    $texto = $this->input->post('texto');
    $this->Muro->hacer_envio($id_emisor_mensaje, $id_propietario, $texto);
    redirect("muros/index/$id_propietario");
  }
  
  function comentar() {
    $this->load->model('Muro');
    $this->load->model('Usuario');
    
    if ($this->input->post('comentar')) {
      $id_envio = $this->input->post('id_envio');
      $id_propietario = $this->Usuario->obtener_id();
      $texto = $this->input->post('texto');
      $this->Muro->hacer_comentario($id_envio, $id_propietario, $texto);
      redirect('muros/index');
    }
  }

  function borrar_envio() {
    $this->load->model('Muro');
    $id_envio = $this->input->post('id_envio');
    $envio = $this->Muro->recoger_envio($id_envio);
    $data['propietario_envio'] = $this->Muro->cual_puedo_borrar($id_envio);
    $this->template->load('template','muros/index', $data);
    if (!empty($envio)) {
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


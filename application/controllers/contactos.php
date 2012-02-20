<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends CI_Controller {

  function __construct() {
    CI_Controller::__construct();
    
    $this->load->library('Utilidades');
    $this->utilidades->comprobar_logueo();

    $this->load->model('Contacto');
    $this->load->model('Solicitud');
    $this->load->model('Usuario');
  }

  function index() { // muestra la lista con todos mis amigos
    $data = $this->utilidades->obtener_datos_plantilla();
    $data['mensaje'] = $this->session->flashdata('mensaje');
    $id = $this->Usuario->obtener_id();
    $data['filas'] = $this->Contacto->obtener_mis_amigos($id);
    $data['cartel'] = 'Amigos';
    
    if (empty($data['filas'])){
      $data['mensaje'] = 'No tienes ningun amigo';
      $data['cartel'] = '';
    }
    $this->template->load('template', 'contactos/index', $data);
  }

  // borra el amigo seleccionado
  function borrar_amigo() {
    $id = $this->Usuario->obtener_id();
    $id_amigo = $this->input->post('id_amigo');
    $min = min($id, $id_amigo);
    $max = max($id, $id_amigo);
    if ($this->Contacto->borrar($min, $max)) {
      $this->session->set_flashdata('mensaje', 'Se ha borrado un amigo con exito');
    } else {
      $this->session->set_flashdata('mensaje', 'Se ha producido un error al borrar');
    }
    redirect('contactos/index');
  }
  
  function buscar() {
    $id = $this->Usuario->obtener_id();
    $data = $this->utilidades->obtener_datos_plantilla();
    $data['filas'] = $this->Contacto->obtener_todos($id);
    if (empty($data['filas'])){
      $data['mensaje'] = 'Todos los contactos son amigos tuyos';
    }
    $this->template->load('template', 'contactos/buscar', $data);
  }

  function agregar_amigo() {
    $id_solicitante = $this->Usuario->obtener_id();
    $id_solicitado = (int) $this->input->post('id_solicitado');
    if ($this->Solicitud->crear_solicitud($id_solicitado, $id_solicitante)) {
      $this->session->set_flashdata('mensaje', 'Se envió la solicitud');
    } else {
      $this->session->set_flashdata('mensaje', 'Se ha producido un error');
    }
    redirect('contactos/index');
  }
}

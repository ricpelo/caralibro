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

  
  function obtener_datos_envio() {
    $res = $this->db->query("select texto, id_propietario as id_prop, e.id as id_envio,
                                        to_char(fechahora, 'DD-MM-YYYY\" a las \"HH24:MI:SS')
                                        as fechahora,
                                        nombre as nombre_prop, apellidos as apellidos_prop
                                   from envios e join usuarios u
                                     on e.id_propietario = u.id
                                  where id_receptor = $id");
    $data['filas'] = $res->result_array();
    
if ($this->session->flashdata('mensaje')) {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    } else {
      $data['mensaje'] = '';
    }
    $data[''] = $this->session->userdata('usuario');
    $this->load->view('muros/index', $data);
	}

}



>>>>>>> 81e0e2ad171a94c44ea4064c9cf3151eed4598ab

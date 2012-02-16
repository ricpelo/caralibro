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
<<<<<<< HEAD
    
		$data['propietario_muro'] = $nombre . ' ' . $apellidos;
    
    $this->template->load('template','muros/index', $data);
  

=======
		$data['propietario_muro'] = $nombre . ' ' . $apellidos;

    $this->template->load('template','muros/index', $data);    
>>>>>>> ea7bae666213fade5a9f6caaf9fceba84e26fbc9
 	}

  function enviar() {
   

  }  



  function borrar_envio(){

      
      


     $res = $this->Muro->borrar_envio($id_envio);
     
     if ($res && $this->db->affected_rows() == 1){
        
        $id_envio = $_POST['id_envio'];
        redirect('muros/index');

    } else { 
          $this->session->set_flashdata('mensaje', 'No se ha podido borrar el envío');
        }

    }




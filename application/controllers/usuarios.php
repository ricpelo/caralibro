<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  function __construct() {		
		CI_Controller::__construct();
		
		$this->load->model('Usuario');
  }
  
  function _comprobar() {
   
    if (!$this->session->userdata('usuario')) {
      $this->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    }
  }
  	
  function index() {
      $this->_comprobar();
  }	

  function login() {
  	
  	if ($this->input->post('login')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $res = $this->Usuario->comprobarUsuario($email, $password);
      if ($res->num_rows() == 1) {
        $datos = $res->result_array();
        $this->session->set_userdata('id', $datos['id']);
        $this->session->set_userdata('usuario', $email);
        redirect('muros/index');
      } else {
        $mensaje = 'Error: usuario o contraseña incorrectos';
      }

    } else {
      $mensaje = $this->session->flashdata('mensaje');
    }

    $this->load->view('usuarios/login', array('mensaje' => $mensaje));
  }
  
  function logout() {
    $this->session->unset_userdata('usuario');
    redirect('usuarios/login');
  }
  
  function crear() {
  	if ($this->input->post('enviar')) {
  		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nombre = $this->input->post('nombre');
		$apellidos = $this->input->post('apellidos');
		
		if(!$this->Usuario->crear($email, $password, $nombre, $apellidos)) {
			$data['mensaje'] = 'Se ha producido un error..';
			$this->load->view('usuarios/crear', $data);
		} else {
			$this->session->set_flashdata('mensaje', 'El usuario se creo correctamente.');
			redirect('usuarios/login');			
		}
  	} else {
  	  $this->load->view('usuarios/crear');
    }
  }
  
  function editar() {
	 $this->_comprobar();
	  if ($this->input->post('editar')) {
	  	$password = $this->input->post('password');
		$email = $this->input->post('email');
		$confirmPassword = $this->input->post('confirmpassword');
		$nombre = $this->input->post('nombre');
		$apellidos = $this->input->post('apellidos');
		$id = $this->input->post('id');
		if ($password == $confirmPassword){
			if(!$this->Usuario->actualizar(array('id' => $id,
			                                     'email' =>$email, 
			                                     'password'=> $password, 
			                                     'nombre'=> $nombre, 
			                                     'apellidos' => $apellidos))){
			                                     	
			    $data['mensaje'] = "No se a podido realizar la actualización, vuelva a intentarlo.";	
			    $this->load->view('usuarios/editar', $data); 
			} else {
				$this->session->set_flashdata('mensaje', 'El usuario se modifico correctamente.');
		 	    redirect('muros/index');	
			}
			
		} else {
			$data['mensaje'] = "La confirmación de la clave es erronea.";	
			$this->load->view('usuarios/editar', $data); 
		}
	  } else {
	  	$data = $this->Usuario->obtenerDatos($this->session->userdata('usuario'));
		$data['confirmpassword'] = '';
		$data['password'] = '';
		$this->load->view('usuarios/editar', $data); 
	  }
    }
    
    function borrar() {
      $id = $this->input->post('id');
      $this->template->load('Template', 'usuarios/borrar', 'mensaje');
      if ($this->input->post('si')) {
        $res = $this->Usuario->borrar($id);
	      if ($res && $this->db->affected_rows() == 1) {
          $this->session->set_flashdata('mensaje', 'Usuario borrado con éxito');
	      } else {
          $this->session->set_flashdata('mensaje', 'No se ha podido borrar el usuario');
	      }
        redirect('usuarios/login');
      } else {
        redirect('muros/index');
      }
    }
}

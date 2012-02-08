<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  
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
  	$this->load->model('Usuario');
  	if ($this->input->post('login')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->Usuario->comprobarUsuario($email, $password)->num_rows() == 1) {
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
  	$this->load->model('Usuario');
  	if ($this->input->post('enviar')) {
  		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nombre = $this->input->post('nombre');
		$apellidos = $this->input->post('apellidos');
		
		if(!$this->Usuario->crear($email, $password, $nombre, $apellidos)) {
			$this->session->set_flashdata('mensaje', 'Se ha producido un error..');
		} else {
			$this->session->set_flashdata('mensaje', 'El usuario se creo correctamente.');
			redirect('usuarios/login');			
		}
  	} else {
  	  $this->load->view('usuarios/crear');
    }
  }
  
  function editar()
	{
	  if ($this->input->post('cancelar')) {      
	  # Si has pulsado el botón Cancelar
	    redirect('usuarios/index');
	  } else if ($this->input->post('editar_index')) { 
	  # Primera vez que entramos en el método
	      $id   = $this->input->post('id');
	      $data = $this->Usuario->obtener($id);
	      $this->load->view('usuarios/editar', $data);
	  } else if ($this->input->post('editar')) {
	      $id   = $this->input->post('id');
	      $data = $this->_datos_formulario();  
	      #$this->_reglas_editar($id);    
	      
	    if ($this->form_validation->run() == FALSE) {
	       # NO se ha podido hacer la edición por alguna razón
	       $this->load->view('usuarios/editar', $data);
	    } else {
	      $res = $this->Empleado->actualizar($data);
	      if ($res && $this->db->affected_rows() == 1) {
	       # OK
         $this->session->set_flashdata('mensaje', 'Usuario editado con éxito');
   	     redirect('usuarios/index');
	      } else {
	       # NO se ha podido hacer la edición por alguna razón
	       $this->load->view('usuarios/editar', $data);
	      }
	    }
	  } 
	}
	
	function _datos_formulario() {
    return array('email'     => $this->input->post('email'),
                 'password'  => $this->input->post('password'),
                 'nombre'    => $this->input->post('nombre'),
                 'apellidos' => $this->input->post('apellidos'),
                 'id'        => $this->input->post('id'));
  }
}

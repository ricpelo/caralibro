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
  	if ($this->input->post('login')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $res = $this->db->query("Select * from usuarios where email = ? and password = md5(?)", array($email, $password));
      if ($res->num_rows() == 1) {
        $this->session->set_userdata('usuario', $email);
        redirect('usuarios/index');
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
  	if ($this->input->post('crear')) {
  		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$nombre = $this->input->post('nombre');
		$apellidos = $this->input->post('apellidos');
		
		$res=$this->db->query("insert into usuarios (email, password, nombre, apellidos) 
		                                   values (?,md5(?),?,?)",array($email, $password, $nombre, $apellidos));
		if(!$res) {
			$this->session->set_flashdata('mensaje', 'Se ha producido un error..');
		}
  	} else {
  	  $this->load->view('usuarios/crear');
    }
  }
}
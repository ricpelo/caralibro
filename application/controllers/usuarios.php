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
	  var_dump($this->session->userdata('id'));
	  var_dump($this->session->userdata('nombre'));
	  var_dump($this->session->userdata('apellidos'));
  }		

  function login() {
  	
  	if ($this->input->post('login')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $res = $this->Usuario->comprobarUsuario($email, $password);
      if ($res->num_rows() == 1) {
        $datos = $res->row_array();
        $this->session->set_userdata('id', $datos['id']);
        $this->session->set_userdata('usuario', $email);
		$this->session->set_userdata('nombre', $datos['nombre']);
		$this->session->set_userdata('apellidos', $datos['apellidos']);
        redirect('muros/index');
      } else {
        $mensaje = 'Error: usuario o contraseña incorrectos';
      }

    } else {
      $mensaje = $this->session->flashdata('mensaje');
    }

    $this->template->load('template','usuarios/login', array('mensaje' => $mensaje));
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
			$this->template->load('template','usuarios/crear', $data); 
		} else {
			$this->session->set_flashdata('mensaje', 'El usuario se creo correctamente.');
			redirect('usuarios/login');			
		}
  	} else {
  	    $data['mensaje'] = 'Introduce los datos para el registro.';
  	    $this->template->load('template','usuarios/crear',$data); 
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
		$data = compact('id','email','password', 'nombre', 'apellidos', 'confirmpassword');
		if ($password == $confirmPassword){
			if(!$this->Usuario->actualizar(array('id' => $id,
			                                     'email' =>$email, 
			                                     'password'=> $password, 
			                                     'nombre'=> $nombre, 
			                                     'apellidos' => $apellidos))){
			                                     	
			    $data['mensaje'] = "No se a podido realizar la actualización, vuelva a intentarlo.";
				$data['confirmpassword'] = '';
				$data['password'] = '';
			    $this->template->load('template','usuarios/editar', $data); 
			} else {
				$this->session->set_flashdata('mensaje', 'El usuario se modifico correctamente.');
		 	    redirect('muros/index');	
			}
			
		} else {
			$data['mensaje'] = "La confirmación de la clave es erronea.";
			$data['confirmpassword'] = '';
			$data['password'] = '';
			$this->template->load('template','usuarios/editar', $data); 
		}
	  } else {
	  	$data = $this->Usuario->obtenerDatos($this->session->userdata('usuario'));
		$data['confirmpassword'] = '';
		$data['password'] = '';
		$this->template->load('template','usuarios/editar', $data); 
	  }
    }
    
    function borrar() {
      
      if ($this->input->post('si')) {
      		$id = $this->session->userdata('id');
            $res = $this->Usuario->borrar($id);
	        if ($res && $this->db->affected_rows() == 1) {
                $this->session->set_flashdata('mensaje', 'Usuario borrado con éxito');
				redirect('usuarios/login');
	        } else {
              $this->session->set_flashdata('mensaje', 'No se ha podido borrar el usuario');
			  redirect('muros/index');
	        }
      } elseif ($this->input->post('no')) {
          $this->session->set_flashdata('mensaje', 'La operación fue cancelada.');
			  redirect('muros/index');
      } else {
        #redirect('usuarios/borrar');
		$this->template->load('template', 'usuarios/borrar');
      }
    }
}

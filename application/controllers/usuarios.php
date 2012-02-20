<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
    $this->load->model('Usuario');
  }

  function index() {
    $this->utilidades->comprobar_logueo();
	  if ($this->input->post('editar')) {
	  		redirect('usuarios/editar');
	  } elseif ($this->input->post('borrar')) {
		  	redirect('usuarios/borrar');
	  } elseif ($this->input->post('muro')) {
		  	redirect('muros/index');
	  } else {
	  		$datos= $this->Usuario->obtener($this->session->userdata('id'));
	  		$this->template->load('template','usuarios/index', $datos);
	  }
  }		

  function login() {
  	if ($this->input->post('login')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $res = $this->Usuario->comprobar_usuario($email, $password);
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

    } elseif ($this->input->post('crear')) {
        redirect('usuarios/crear');
    } else {
      $mensaje = $this->session->flashdata('mensaje');
    }

    $this->template->load('template','usuarios/login', array('mensaje' => $mensaje));
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect('usuarios/login');
  }
  
  function crear() {
  	if ($this->input->post('enviar')) {
  		$email = $this->input->post('email');
		  $password = $this->input->post('password');
		  $nombre = $this->input->post('nombre');
		  $apellidos = $this->input->post('apellidos');
		  $this->_reglas_crear();
		  if ($this->form_validation->run()==FALSE){
		  	$data['mensaje'] = 'Ese email ya ha sido registrado..';
			$this->template->load('template','usuarios/crear', $data); 
		  }
		  if(!$this->Usuario->crear($email, $password, $nombre, $apellidos)) {
			  $data['mensaje'] = 'Se ha producido un error. Es posible que el usuario ya este siendo usado';
			  $this->template->load('template','usuarios/crear', $data); 
		  } else {
			  $this->session->set_flashdata('mensaje', 'El usuario se creo correctamente.');
			  redirect('usuarios/login');			
		  }
		  
  	} elseif($this->input->post('cancelar')) {
  	  redirect('usuarios/login');
  	  
  	} else {
  	    $data['mensaje'] = 'Introduce los datos para el registro.';
  	    $this->template->load('template','usuarios/crear',$data); 
    }
  }
  
  function editar() {
	 $this->utilidades->comprobar_logueo();
	  if ($this->input->post('editar')) {
	  	$password = $this->input->post('password');
		$email = $this->input->post('email');
		$confirmPassword = $this->input->post('confirmpassword');
		$nombre = $this->input->post('nombre');
		$apellidos = $this->input->post('apellidos');
		$id = $this->input->post('id');
		$data = compact('id','email','password', 'nombre', 'apellidos', 'confirmpassword');
		if ($password == $confirmPassword){
			if ($password != '' && $confirmPassword != '') {
				$res = $this->Usuario->actualizar(array('id' => $id,
			                                     'email' =>$email, 
			                                     'password'=> $password, 
			                                     'nombre'=> $nombre, 
			                                     'apellidos' => $apellidos));
			} elseif ($password == '' && $confirmPassword == '') {
				$res = $this->Usuario->actualizar(array('id' => $id,
			                                     'email' =>$email,
			                                     'nombre'=> $nombre, 
			                                     'apellidos' => $apellidos));
			} 
			
			if(!$res) {
			                                     	
			    $data['mensaje'] = "No se ha podido realizar la actualización, es posible que el usuario ya este en uso, 
			                      vuelva a intentarlo con otro nombre.";
				$data['confirmpassword'] = '';
				$data['password'] = '';
			    $this->template->load('template','usuarios/editar', $data); 
			} else {
				$this->session->set_flashdata('mensaje', 'El usuario se modifico correctamente.');
				$this->_actualizar_variable_session($nombre, $apellidos, $email);
		 	    redirect('muros/index');	
			}
			
		} else {
			$data['mensaje'] = "La confirmación de la clave es erronea.";
			$data['confirmpassword'] = '';
			$data['password'] = '';
			$this->template->load('template','usuarios/editar', $data); 
		}
		
	  } elseif ($this->input->post('cancelar')) {
		  redirect('usuarios/index');
	  } else {
	  	$data = $this->Usuario->obtener_datos($this->session->userdata('usuario'));
		$data['confirmpassword'] = '';
		$data['password'] = '';
		$this->template->load('template','usuarios/editar', $data); 
	  }
    }
    
    function borrar() {
      $this->utilidades->comprobar_logueo();
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
		$this->template->load('template', 'usuarios/borrar');
      }
    }
	
	function _reglas_crear() {
		$this->form_validation->set_rules('email', 'usuario','required|is_unique[usuarios.email]');
	}

  function _actualizar_variable_session($nombre, $apellidos, $email) {
  	$this->session->set_userdata('usuario', $email);
		$this->session->set_userdata('nombre', $nombre);
		$this->session->set_userdata('apellidos', $apellidos);
  }
}

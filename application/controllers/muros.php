<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleados extends CI_Controller {

  function __construct() {
    CI_Controller::__construct();
    
    if (!$this->session->userdata('usuario')) {
      $this->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    }

  }





}




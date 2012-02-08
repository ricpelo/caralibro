<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {
  
  function comprobarUsuario($email, $password){
  	
  		return $this->db->query("Select * from usuarios where email = ? and password = md5(?)", array($email, $password));	
  }
  
  function crear($email, $password, $nombre, $apellidos) {
  	if($email != '' && $password != '' && $nombre != '' && $apellidos != '') {
	  return $this->db->query("insert into usuarios (email, password, nombre, apellidos) 
		                                   values (?,md5(?),?,?)",array($email, $password, $nombre, $apellidos));
	} else {
		return FALSE;
	}
  }
}

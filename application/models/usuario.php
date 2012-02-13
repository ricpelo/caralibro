<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {
  
  function comprobarUsuario($email, $password){
  	
  		return $this->db->query("Select * from usuarios where email = ? and password = md5(?)", array($email, $password));	
  }
  
  function crear($email, $password, $nombre, $apellidos) {
    $res = $this->_nombreUtilizado($email);
  	if($email != '' && $password != '' && $nombre != '' && $apellidos != '' && empty($res)) {
	  return $this->db->query("insert into usuarios (email, password, nombre, apellidos) 
		                                   values (?,md5(?),?,?)",array($email, $password, $nombre, $apellidos));
	  } else {
		  return FALSE;
	  }
  }
  
  function obtener($id) {
     return $this->db->query("select * from usuarios where id = ?", array($id))->row_array();
  }
  
  function actualizar($datos) {
    $res = $this->_nombreEditado($datos['email'], $datos['id']);
    if (!empty($res)) {
      return $this->db->query("update usuarios
	                                set email     = ?,
	                                    password  = md5(?),
	                                    nombre    = ?,
	                                    apellidos = ?
                                where id = ?", array($datos['email'],
                                                     $datos['password'],
                                                     $datos['nombre'],
                                                     $datos['apellidos'],
                                                     $datos['id']));
    } else {
        return false;
    }
  }
  
  function obtenerDatos($email) {
  	if ($email != '') { # Comprueba que el email no este vacio.
  		return $this->db->query("Select * from usuarios where email = ?", array($email))->row_array();
  	} else {
  		return false;	
  	}
  }

  function borrar($id) {
    return $this->db->query("delete from usuarios where id = ?", array($id));
  }
  
  function _nombreUtilizado($email) {
    return $this->db->query("select email from usuarios where email = ?", array($email))->row_array();
  }
  
  function _nombreEditado($email, $id) {
    return $this->db->query("select email from usuarios where email = ? and id = ?", array($email, $id))->row_array();
  }
}

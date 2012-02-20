<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {
  
  function obtener_id() {
    return $this->session->userdata('id');
  }
  
  function comprobar_usuario($email, $password){
  	
  		return $this->db->query("Select * from usuarios where email = ? and password = md5(?)", array($email, $password));	
  }
  
  function crear($email, $password, $nombre, $apellidos) {
    $res = $this->_nombre_utilizado($email);
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
    $res = $this->_nombre_editado($datos['email'], $datos['id']);
    if ($res) {
      $this->db->where('id',$datos['id']);
	  unset($datos['id']);
	  return $this->db->update('usuarios',$datos);
    } else {
        return false;
    }
  }
  
  function obtener_datos($email) {
  	if ($email != '') { # Comprueba que el email no este vacio.
  		return $this->db->query("Select * from usuarios where email = ?", array($email))->row_array();
  	} else {
  		return false;	
  	}
  }

  function borrar($id) {
    return $this->db->query("delete from usuarios where id = ?", array($id));
  }
  
  function _nombre_utilizado($email) {
    return $this->db->query("select email from usuarios where email = ?", array($email))->row_array();
  }
  
  function _nombre_editado($email, $id) {
    /* Comprueba primero si el nombre esta disponible, si este esta, devolvera true, por tanto se hara el cambio.
     * Si por el contrario no tiene esta disponible se comprobara si el nombre corresponde con la id enviada, si es así lo permite.
     * Si no se cumple ninguna de las dos retorna false.*/
    $res = $this->db->query("select email from usuarios where email = ?", array($email))->row_array();
    if (!$res) {
      return true;
    } else {
      $res = $this->db->query("select email from usuarios where email = ? and id = ?", array($email, $id))->row_array();
      if($res) {
        return true;
      } else {
        return false;
      }
    }
  }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muro extends CI_Model  {


}

 function obtener($id) {
    return $this->db->query("select * from usuarios where id = ?", array($id))->row_array();
  }

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades {

  function comprobar_vacio($variable){
    return $variable && $variable != '';
  }

}

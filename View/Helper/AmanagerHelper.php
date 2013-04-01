<?php
class AmanagerHelper extends AppHelper {

  var $helpers = array('Session','Html');

  function is_logged() {
    return $this->Session->read('Amanager.User')?true:false;
  }

  function get_user_info($info = null) {
    if(!$info) return $this->Session->read('Amanager.User');
    $user_info = $this->Session->read('Amanager.User');
    if( !$user_info[$info] ) return "Informação não encontrada";
    return $user_info[$info];
  }

}

?>
<?php
class AmanagerHelper extends AppHelper {

  var $helpers = array('Session','Html');

  private $controller;

  public function __construct(View $view, $settings = array()) {
    parent::__construct($view, $settings);
    $this->controller=$this->loadController();
  }

  protected function loadController($name=null){
    if (is_null($name)) $name=$this->params['controller'];
    $className = ucfirst($name) . 'Controller';
    list($plugin, $className) = pluginSplit($className, true);
    App::import('Controller', $name);
    $cont = new $className;
    $cont->constructClasses();
    $cont->request=$this->request;
    return $cont;
  }

  function is_allowed ($url) {
    if( !isset($url['controller']) or empty($url['controller']) ){
      $url['controller'] = $this->controller->request->params['controller'];
      $url['action'] = 'admin_' . $url['action'];
    }
    return $this->controller->Amanager->isAllowed($url);
  }

  function is_logged() {
    return $this->Session->read('Amanager.User')?true:false;
  }

  function get_user_info($info = null) {
    if(!$info) return $this->Session->read('Amanager.User');
    $user_info = $this->Session->read('Amanager.User');
    if( !$user_info[$info] ) return "Informação não encontrada";
    return $user_info[$info];
  }

  /**
   * Verifica se usuário está em especificado grupo
   *
   * in_group method
   *
   * @param string $user_id
   * @param string $group_name
   * @return boolean
   */
  public function in_group($user_id, $group_name) {
    App::import('Model', 'Amanager.User');
    $this->User = new User();
    return( $this->User->in_group($user_id, $group_name) );
  }

}

?>

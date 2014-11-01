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
    $className = Inflector::camelize($className);
    if( isset($this->params['plugin']) ){
      if( !empty($this->params['plugin'])){
        $plugin = Inflector::camelize($this->params['plugin']);
        $name = Inflector::camelize($this->params['plugin']) . '.' . $name;
      }
    }
    if (!class_exists($className)) return false ;
    App::import('Controller', $name);
    $cont = new $className;
    $cont->constructClasses();
    $cont->request=$this->request;
    return $cont;
  }

  function is_allowed ($url) {
    return $this->controller->Amanager->isAllowed( $this->adjusts_url($url) );
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

  public function check_controller_exist( $name_controller ) {
    $aCtrlClasses = App::objects('controller');
    foreach ($aCtrlClasses as $controller) {
      if ($controller != 'AppController') {
        // Load the controller
        App::import('Controller', str_replace('Controller', '', $controller));

        // Load the ApplicationController (if there is one)
        App::import('Controller', 'AppController');
        $controllers[] = $controller;
      }
    }
    return in_array($name_controller, $controllers );
  }

  /**
   * Get either a Gravatar URL or complete image tag for a specified email address.
   *
   * @param string $email The email address
   * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
   * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
   * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
   * @param boole $img True to return a complete IMG tag False for just the URL
   * @param array $atts Optional, additional key/value attributes to include in the IMG tag
   * @return String containing either just a URL or a complete image tag
   * @source http://gravatar.com/site/implement/images/php/
   */
  function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
      $url = '<img src="' . $url . '"';
      foreach ( $atts as $key => $val )
          $url .= ' ' . $key . '="' . $val . '"';
      $url .= ' />';
    }
    return $url;
  }

  /**
   * Só ebibe o link se o usuário logado tiver permissão
   *
   * link method
   *
   * @param string $text
   * @param array $url
   * @param string $tag
   * @param array $options
   * @return string $link
   */
<<<<<<< HEAD
  public function link($text, $url, $tag = false, $options = array()) {
=======
  public function link($text, $url, $options = array(), $confirmMessage = false, $tag = false) {
>>>>>>> json
    $tag_open = $tag?"<{$tag}>":"";
    $tag_close = $tag?"</{$tag}>":"";
    $url = $this->adjusts_url( $url );
    if($this->is_allowed( $this->adjusts_url($url) )){
<<<<<<< HEAD
      echo $tag_open . $this->Html->link( $text, $url, $options ) . $tag_close;
=======
      echo $tag_open . $this->Html->link( $text, $url , $options, $confirmMessage) . $tag_close;
>>>>>>> json
    }
  }

  /**
   * Ajusta uma url para o formato do plugin
   *
   * link adjusts_url
   *
   * @param array $url
   * @return array $url
   */
  public function adjusts_url($url) {

    // Se não for passado o nome do controlador a ser acessado
    if( !isset($url['controller']) or empty($url['controller'])  ){
      $url['controller'] = $this->controller->request->params['controller'];
      // Verofoca se há prefico na url
      if(isset($this->controller->request->params['prefix'])){
        if( !empty($this->controller->request->params['prefix']) ){
          $url['action'] = 'admin_' . $url['action'];
        }
      }
    }
    return $url;
  }

}

?>

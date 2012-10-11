<?php
App::uses('Controller', 'Controller');
class AmanagerComponent extends Component {

/**
 * components
 *
 * @var array
 */
  public $components = array( 'Session');

/**
 * controller
 *
 * @var object
 */
  var $controller;

/**
 * loginAction
 *
 * @var array
 */
  var $login_action = array(
    'controller'=>'users',
    'plugin' => 'amanager',
    'action'=>'login'
  );

/**
 * loginRedirect
 *
 * @var array
 */
  var $login_redirect = array(
    'controller'=>'amanager',
    'plugin' => 'amanager',
    'action'=>'index'
  );

/**
 * logoutRedirect
 *
 * @var array
 */
  var $logout_redirect = array(
    'controller'=>'pages',
    'plugin' => false,
    'action'=>'display'
  );

  function __construct(ComponentCollection $collection, $settings = array()) {
    parent::__construct($collection, $settings);
  }

  function initialize(&$controller) {

    if( $controller->name == 'Users' && $controller->action == 'login' ){
      if( $this->is_logged() ){

        $url = $this->previous_url();

        $controller->redirect( urldecode(Router::url($url + array('base' => false))) );
      }
    }

    $this->controller = $controller;

    // Verifica se o usuário tem permissão para a área
    $this->isAllowed($this->controller->request->params);

  }

  function startup(&$controller = null) {

    $this->previous_url($controller->request->params);

    if( isset($this->settings->login_action) )
      $this->login_action = $this->settings->login_action;

    if( isset($this->settings->login_redirect) )
      $this->login_redirect = $this->settings->login_redirect;

    if( isset($this->settings->logout_redirect) )
      $this->logout_redirect = $this->settings->logout_redirect;

  }

  public function auth(&$controller) {
    //$controller->Auth->allow('*');
    //pr($controller->request->params);
  }

  public function redirect() {
    $this->controller->redirect($this->login_redirect);
  }


  public function login($data_login){
    $this->Session->write('Amanager', $data_login);

    $this->controller->redirect($this->login_redirect);
  }

  public function is_logged(){
    return $this->Session->read('Amanager.User')?true:false;
  }

  public function previous_url($url = null){
    if( !$url )
      return $this->Session->read('Amanager.previous_url')?$this->Session->read('Amanager.previous_url'):false;

      $this->Session->write('Amanager.previous_url', $url);
  }

  public function logout() {

    if(!$this->is_logged()){
      $this->Session->setFlash(__('Você tentou acessar um endereço não acessível neste momento'));
      $this->controller->redirect($this->logout_redirect);
    }

    $this->Session->delete('Amanager');
    $this->Session->setFlash(__('Você foi desconectado do sistema'), 'message/warning');
    $this->controller->redirect($this->logout_redirect);
  }



  // Função que checa se o(s) grupo(s) do usuário logado
  //... tem acesso a área solicitada
  function isAllowed($params = null) {

pr($params);
die('#EASWQ321');


    $groups = $this->Session->read('Amanager.Group');
    $alow = false;
    foreach( $groups as $group ){
      $rules = Hash::sort($group['Rule'], '{n}.order', 'asc');
      foreach( $rules as $actions ){
        foreach( $actions['Action'] as $action ){
          $permission = Router::parse($action['alias'], false);
          $result = Hash::diff($permission, $params);
          $action_alow =  $action['alow'];
          if( !$result && $action_alow ){
            $alow = true;
          }
          if( !$result && $action_alow == null ){
            $alow = false;
          }
        }
      }
    }

    return $alow;

  }

}

?>

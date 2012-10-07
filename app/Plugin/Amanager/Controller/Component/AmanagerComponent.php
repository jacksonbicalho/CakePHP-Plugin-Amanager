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
  var $login_action = array();

/**
 * loginRedirect
 *
 * @var array
 */
  var $login_redirect = array();

/**
 * logoutRedirect
 *
 * @var array
 */
  var $logout_redirect = array();

  function __construct(ComponentCollection $collection, $settings = array()) {
    parent::__construct($collection, $settings);
  }

  function initialize(&$controller) {

    $this->controller = $controller;

   // $AuthConfig = array(
   //   'loginAction' => array('plugin'=>'amanager','controller' => 'users', 'action' => 'login'),
   //   'loginRedirect' => array('controller' => 'amanager', 'action' => 'index'),
   //   'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
   // );
    //$controller->Auth = $controller->Components->load('Auth', $AuthConfig);

    //$controller->Auth->allow('*');
  }

  function startup(&$controller = null) {
  }

  public function auth(&$controller) {
    //$controller->Auth->allow('*');
    //pr($controller->request->params);
  }

  public function redirect() {
    $this->controller->redirect($this->login_redirect);
  }

  public function logout() {
    $this->Session->delete('Amanager');
  }

  public function set_login($user_data){
    $this->Session->write('Amanager', $user_data);
  }
  public function logged(){
    return $this->Session->read('Amanager')?true:false;
  }
  public function previous_url(){
    $this->controller->redirect($this->controller->referer);
  }
  public function alogout() {
    $this->Session->delete('Amanager');
    $this->Session->setFlash(__('Você foi desconectado do sistema'));
    $this->redirect($this->logout_redirect);
  }


}

?>

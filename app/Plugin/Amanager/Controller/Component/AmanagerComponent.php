<?php
App::uses('AuthComponent', 'Controller/Component');
class AmanagerComponent extends Component {

/**
 * components
 *
 * @var array
 */
  var $components = array('Session');

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

    $this->login_action = $settings['login_action'];
    $this->login_action = $settings['login_redirect'];
    $this->login_action = $settings['logout_redirect'];

    parent::__construct($collection, $settings);
  }

  function initialize(&$controller) {
    //pr ($controller->request->params);
    //$controller->Auth = $controller->Components->load('Auth', $options);
  }

  function startup(&$controller = null) {
  }

  public function auth(&$controller) {
    //$controller->Auth->allow('*');
    //pr($controller->request->params);
  }

}

?>

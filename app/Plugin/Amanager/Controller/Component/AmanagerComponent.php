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
 *
 * Armazena a url responsável por exibir o formulário de login.
 *
 * login_action
 *
 * @var array
 */
  var $login_action = array(
    'controller'=>'users',
    'plugin' => 'amanager',
    'action'=>'login'
  );

/**
 *
 * Armazena a url para onde o usuário é redirecionado após o login.
 * A ideia é que a mesma só seja usada se previous_url estiver vazio.
 *
 * login_redirect
 *
 * @var array
 */
  var $login_redirect = array(
    'controller'=>'amanager',
    'plugin' => 'amanager',
    'action'=>'index'
  );

/**
 *
 * Armazena a url para onde o usuário é redirecionado após se deslogar do sistema.
 *
 * logout_redirect
 *
 * @var array
 */
  var $logout_redirect = array(
    'controller'=>'pages',
    'plugin' => false,
    'action'=>'display'
  );

/**
 *
 * Armazena a url para onde o usuário é redirecionado quando o mesmo não tem acesso ao endereço
 * acessado.
 *
 * access_denied
 *
 * @var array
 */
  var $access_denied = array(
    'controller'=>'users',
    'action'=>'access_denied',
    'plugin'=>'amanager'
  );

/**
 *
 * Armazena a url anterior a atual para ser usada em redirecionamentos
 *
 * url_prev
 *
 * @var array
 */
  var $url_prev = array();

  function __construct(ComponentCollection $collection, $settings = array()) {
    parent::__construct($collection, $settings);
  }

/**
 *
 * Método acionado pelo controlador do projeto
 *
 * beforeFilter method
 *
 * @param object $controller
 * @return void
 *
 **/
  function beforeFilter(&$controller) {

    // Verifica se o usuário tem permissão para a área
    if( !$this->isAllowed($controller->request->params) ){

      $this->Session->write('Amanager.url_prev', $controller->request->params);

      $this->url_prev = $controller->request->params;

      if( $this->is_logged() ){

        $this->Session->setFlash(__('Acesso negado!'), 'message/error');

        if(
            $controller->request->params['action'] != $this->access_denied['action']
            or $controller->request->params['controller'] != $this->access_denied['controller']
            or $controller->request->params['plugin'] != $this->access_denied['plugin']
          )
        {
          $this->controller->redirect( $this->access_denied );

        }

      }
      $this->controller->redirect( $this->login_action );
    }

  }

  function initialize(&$controller) {
    $this->controller = $controller;
  }

  function startup(&$controller = null) {

    if( isset($this->settings->login_action) )
      $this->login_action = $this->settings->login_action;

    if( isset($this->settings->login_redirect) )
      $this->login_redirect = $this->settings->login_redirect;

    if( isset($this->settings->logout_redirect) )
      $this->logout_redirect = $this->settings->logout_redirect;

  }

  public function login($data_login){
    $this->url_prev = $this->Session->read('Amanager.url_prev');
    $this->Session->write('Amanager', $data_login);
    $this->controller->redirect($this->url_prev);
  }

  public function is_logged(){
    return $this->Session->read('Amanager.User')?true:false;
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
    $urls_livres = Configure::read('Amanager.urls_livres');
    unset($params['named']);
    unset($params['pass']);
    if( empty($params['plugin']) ) unset( $params['plugin'] );
    foreach($urls_livres as $url_livre){
      $result = Hash::diff($url_livre, $params);;

      if(!$result) return true;
    }

    $groups = $this->Session->read('Amanager.Group');
    $adm = Set::extract('{n}/.[name=administrators]',  $groups );
    if($adm)  return true ;

    if(!$groups) return false;
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

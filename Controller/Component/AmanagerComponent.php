<?php
App::uses('Controller', 'Controller');
App::uses('AmanagerAppModel', 'Amanager.Model');

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
    'action'=>'login',
  	'admin'=>false
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
    'action'=>'index',
  	'admin'=>false

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
    'action'=>'display',
  	'admin'=>false
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
    'plugin'=>'amanager',
  	'admin'=>false
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

  /**
   *
   * Parâmetros que são levados em consideração na hora da verificação de permissão
   *
   * @var array
   */
  var $parametros_levados_em_conta = array(
    'controller',
    'action',
    'plugin',
    'admin',
  );

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
   *
   * @param array $options
   *
   * @return void
   *
   **/
  function beforeFilter(&$controller, $options = array() ) {

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
    $url_prev = $this->clear_url( $this->url_prev, array('pass') );
    $url_prev['url'] = null;
    $this->controller->redirect( Router::reverse($url_prev, true) );
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
    $this->Session->setFlash(__('Você foi desconectado do sistema'));
    $this->controller->redirect($this->logout_redirect);
  }

  // Função que checa se o(s) grupo(s) do usuário logado
  //... tem acesso a área solicitada
  function isAllowed($params = null) {

    $params['url'] = null; // Para não retornar erro de Router::reverse
    $teste = Router::reverse($params, false);

    // Limpa os parâmertros
    $params = $this->clear_url( $params );

    // Verifica se a url é livre, se sim já libera o acesso

    $teste = $this->checks_urls_free( $params ) ;

	  if( $this->checks_urls_free( $params ) ) return true;

    // Se estiver no grupo administrators permite
    $groups = $this->Session->read('Amanager.Group');

    $master = Configure::read('Amanager.group_master' );

    $adm = Set::extract("{n}/.[name={$master}]",  $groups );
    if($adm)  return true ;

    if(!$groups) return false;
    $alow = false;

    foreach( $groups as $group ){
      $rules = Hash::sort($group['Rule'], '{n}.order', 'asc');
      foreach( $rules as $actions ){
        foreach( $actions['Action'] as $action ){

					$permission = $this->clear_url( Router::parse($action['alias'], false) );
        	$result = Hash::diff( $permission, $params );
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

  /**
   * password_generator method
   *
   * Gera uma senha com a quantidade de caracteres passada no parâmetro $size
   * Se o parâmetro não for informado, a quantidade de 10 caracteres é assumida
   *
   * @params integer $size
   *
   */
  public function password_generator($size = 10) {
    return substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$' ) , 0 , $size );
  }

  /* :: API :: */

  /**
   *
   * Valida os dados enviados de outro modelo
   *
   * valida_user method
   *
   * @param object $model
   * @param array $dados
   * @return boolean true or array $errors
   *
   **/
  public function valida_user( $dados ) {

    $return = array();

    if ( !isset( $dados['User'] ) ){
      $return['erro'][] = 'O índice User não foi encontrado no array de dados enviado. Por favor informe ao administrador do sistema este erro. [#ShekyuAds9';
      return $return;
    }

    App::import('Model', 'Amanager.User');
    $User = new User();
    $User->set($dados);
    if( ! $User->validates() ) {
      $erros = $User->invalidFields();
      foreach( $erros as $key => $var ){
        $return['erro'][$key] = $erros[$key][0];
      }
      return $return;
    }

    return true;

  }

  /**
   *
   * Insere um usuário enviado de fora do Plugin
   *
   * add_user method
   *
   * @param array $user
   * @return integer with the user id or false
   *
   **/
  public function add_user( $user ) {

    if ( !isset( $user['User'] ) ){
      return false;;
    }

    App::import('Model', 'Amanager.User');
    $User = new User();
    $User->create();
    if ($User->save( $user )) {
      $user = $User->read();
      $user_id = $user['User']['id'];
      return $user_id;
    } else {
      return false;
    }
    return false;
  }

  /**
   *
   * get_id_group method
   *
   * Obtém o id do grupo de acordo com o nome passado
   *
   * @param string $nome
   * @return integer $id
   *
   **/
  public function get_id_group( $nome ) {

    App::import('Model', 'Amanager.Group');
    $Group = new Group();
    $group = $Group->findByName($nome);
    return $group['Group']['id'];
  }

  /**
   *
   * obtém os dados de usuário de acordo com o id de EntitysUser passado
   *
   * get_user_data method
   *
   * @param integer $entitys_user_id
   * @return array $data or false
   *
   **/
  public function get_user_data( $entitys_user_id ) {
    App::import('Model', 'Amanager.EntitysUser');
    $EntitysUser = new EntitysUser();
    $EntitysUser->id = $entitys_user_id;
    $entitys_user = $EntitysUser->read();
    return $entitys_user['User'] ;
  }

  /**
   *
   * obtém os dados do usuário logado
   *
   * get_user_logged method
   *
   * @param string $attribute
   * @return array $data or false
   *
   **/
  public function get_user_logged( $attribute = false){
    $_attribute = !$attribute?"":".{$attribute}" ;
    $user = $this->Session->read("Amanager.User{$_attribute}");
    return !$user?false:$user;
  }

  /**
   *
   * Insere nova chave de ataulização de senha para o usuário especificado
   *
   * set_password_change_code method
   *
   * @param integer $user_id
   * @return string $passwordchangecode
   *
   **/
  public function set_password_change_code($user_id) {
    App::import('Model', 'Amanager.User');
    $User = new User();
    $User->id = $user_id;
    $passwordchangecode = hash('sha512', mktime());
    $User->saveField('passwordchangecode', $passwordchangecode, array( 'validate'=>false, 'callbacks'=>false) );
    return $passwordchangecode ;
  }

  /**
   *
   * Verifica se a url pretendida está entre as url livres
   *
   * checks_urls_free method
   *
   * @param array $params
   * @return boolean
   *
   **/
  public function checks_urls_free($params) {

    $urls_livres = Configure::read('Amanager.urls_livres');

    foreach($urls_livres as $url_livre){

      $result = Hash::diff($url_livre, $params);
      // Se for para todas as ações do controlador permite
      if( isset($url_livre['action'])){
        if( ($params['controller'] == $url_livre['controller'] && $url_livre['action']=='*') && ( !isset($url_livre['admin']) == !isset($params['admin']) ) ){
          return true;
        }
      }

      if( count($result) == 0) return true;
    }

    return false;

  }

  /**
   *
   * Limpa os parâmetros usado para gerar urls
   * só mantendo os que serão usados para verificação de permissão
   *
   * clear_url method
   *
   * @param  $url
   * @param  array $manter informa os índices que mesmo estando em parametros_levados_em_conta
   *
   * @return $url
   *
   **/
  public function clear_url($url, $manter = array()) {

    foreach( $url as $k  => $v ){
      if( !in_array($k, $this->parametros_levados_em_conta) && !in_array($k, $manter) ){
        unset($url[$k]);
      }
    }

    if (array_key_exists('key', $url)) {
      if( $url['plugin'] == NULL ){
        unset( $url['plugin'] );
      }
    }

    if (array_key_exists('plugin', $url)) {
      if(empty($url['plugin'])) $url['plugin'] = false;
    }

    if (array_key_exists('admin', $url)) {
      if(empty($url['admin']))unset( $url['admin'] );
    }

    return $url ;
  }

}

?>
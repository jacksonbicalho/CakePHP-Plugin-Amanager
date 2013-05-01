<?php
App::uses('AmanagerAppController', 'Amanager.Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AmanagerAppController {
  public $components = array(
  //'Security' => array(
  //  'csrfCheck' =>false // Permite que seja feita n tentativas de requisições (Alterar!)
  //)
  );

  /**
   * index method
   *
   * @return void
   */
  public function index() {
    $this->User->recursive = 0;
    $this->set('users', $this->paginate());
  }

  /**
   * view method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function view($id = null) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->set('user', $this->User->read(null, $id));
  }

  /**
   * add method
   *
   * @return void
   */
  public function add() {
    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));
  }

  /**
   * edit method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function edit($id = null) {

    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {

      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $this->request->data = $this->User->read(null, $id);
    }
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));
  }

  /**
   * delete method
   *
   * @throws MethodNotAllowedException
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function delete($id = null) {
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException();
    }
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->User->delete()) {
      $this->Session->setFlash(__('User deleted'));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('User was not deleted'));
    $this->redirect(array('action' => 'index'));
  }

  /**
   * recover_password method
   *
   * @param string $key
   * @return void
   */
  public function recover_password($key = null) {

    // Verifica se foi passado a chave
    if ( $key == null ) {
      throw new MethodNotAllowedException();
    }

    // Verifica se realmente existe um usuário com a chave passada
    $this->User->recursive=0;
    $user = $this->User->findByPasswordchangecode($key);

    if ( !$user ) {
      $this->Session->setFlash(__('Ocorreu um erro ao tentar processar o endereço solicitado. Caso o erro persista entre em contato com o administrador.'));
      $this->redirect( Configure::read('Amanager.page_ini') );
    }

    // Verifica se ainda está dentro do prazo de validade estabelecido nas configurações
    $prazo_validate = Configure::read('Ealbum.password_change_code.limit');

    $data_start = strtotime( $user['User']['modified'] );
    $data_end = strtotime( date("Y-m-d H:i:s") );
    $diff = $data_end - $data_start;

    if ( $diff >  $prazo_validate){
      $this->Session->setFlash(__('O prazo para recuperação de senha expirou. Você deve reiniciar o processo clicando em perdi minha senha.'));
      $this->redirect(array('action' => 'index'));
    }
    $user_id = $user['User']['id'];
    $this->set( compact('user_id') );

    if ($this->request->is('post') || $this->request->is('put')) {


      // Define o campo passwordchangecode como vazio para não mais permitir a alteração da senha
      // a nao ser que o usuário inicie o novo processo
      $this->request->data['User']['passwordchangecode'] = '';

      // Obtén os dados necessários para serem validados
      $this->request->data['User']['username'] = $user['User']['username'];
      $this->request->data['User']['email'] = $user['User']['email'];

      // Obtém os outros dados para permtir

      if ($this->User->save($this->request->data)) {

        $this->Session->setFlash(__('Sua senha foi salva com sucesso'));

        // Se usuário estiver logado, redireciona-o para a sua conta
        // Se não estiver logado, redireciona-o para a tela de login
        if( $this->Amanager->is_logged() ){
          $this->redirect(array('action' => 'index'));
        }else{
          $this->redirect(array('action' => 'login'));
        }

      } else {

        $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'message/error');
        //$this->redirect(array('action' => 'recover_password', $key));
      }

    }

  }


  public function login() {

    // Verifica se o usuário está logado
    if( $this->Amanager->is_logged() ){
      $this->Session->setFlash(__('you already logged is'), 'message/warning');
      $this->redirect(array('controller'=>'amanager', 'action' => 'index'));
    }

    $this->User->recursive = 3;
    if ($this->request->is('post')) {
      $password = $this->User->encripty_password( $this->request->data['User']['password'], $this->request->data['User']['username'] );
      $username = $this->request->data['User']['username'];
      $data_login = $this->User->find('first', array('recursive' => 3, 'conditions'=> array('password'=>$password, 'username'=>$username) ));

      if (!$data_login){
        $this->Session->setFlash(__('Username or password invalid'), 'message/error');
        $this->redirect(array('action' => 'login'));
      }

      $this->Amanager->login($data_login);

    }
  }

  public function logout() {
    $this->Amanager->logout();
  }

  public function access_denied() { }

  public function beforeFilter() {
    parent::beforeFilter();
  }

}

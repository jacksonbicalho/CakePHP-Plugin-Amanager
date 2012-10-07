<?php
App::uses('AmanagerAppController', 'Amanager.Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AmanagerAppController {
  public $components = array(
   'Security' => array(
      'csrfCheck' =>false // Permite que seja feita n tentativas de requisições (Alterar!)
    )
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

  public function login() {
      $this->User->recursive = 3;
    if ($this->request->is('post')) {
      $password = $this->User->encripty_password( $this->request->data['User']['password'], $this->request->data['User']['username'] );
      $username = $this->request->data['User']['username'];
      $data_login = $this->User->find('all', array('recursive' => 3, 'conditions'=> array('password'=>$password, 'username'=>$username) ));

      if (!$data_login){
				$this->Session->setFlash(__('Username or password invalid'), 'message/error');
				$this->redirect(array('action' => 'login'));
      }


    }
  }

  public function logout() {
      $this->redirect($this->Auth->logout());
  }

  public function beforeFilter() {
    $this->Security->blackHoleCallback = 'blackhole';
    parent::beforeFilter();
  }

  public function blackhole($type) {
      die("Erro: Informe o administrador: (". $type . ")");
  }


}

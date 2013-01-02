<?php
App::uses('AppController', 'Controller');
/**
 * Business Controller
 *
 * @property Business $Business
 */
class BusinessController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Business->recursive = 0;
    $conditions = array('Language.language'=> Configure::read('Config.language') );
    $this->paginate = array('group' => 'grouping', 'conditions'=>$conditions);
		$this->set('business', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		$this->set('business', $this->Business->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Business->create();
			if ($this->Business->save($this->request->data)) {
				$this->Session->setFlash(__('The business has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		}
		$languages = $this->Business->Language->find('list');
		$this->set(compact('languages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Business->save($this->request->data)) {
				$this->Session->setFlash(__('The business has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Business->read(null, $id);
		}
		$languages = $this->Business->Language->find('list');
		$this->set(compact('languages'));
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
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->Business->delete()) {
			$this->Session->setFlash(__('Business deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Business was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Business->recursive = 0;
    $this->paginate = array('group' => 'grouping');
		$this->set('business', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		$this->set('business', $this->Business->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {

      // Ajuste para inserir os idiomas agrupados para o registro
      $this->adjusts_language_group($this);
			$this->Business->create();
			if ($this->Business->saveAll($this->request->data['Business'], array('validate'=>false))) {
				$this->Session->setFlash(__('The business has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		}
		$languages = $this->Business->Language->find('list', array('fields'=>array('id', 'nome', 'language')));
		$this->set(compact('languages'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Business->saveAll($this->request->data['Business'], array('validate'=>false))) {
				$this->Session->setFlash(__('The business has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The business could not be saved. Please, try again.'));
			}
		} else {
			$_business = $this->Business->find('all', array('conditions'=>array('grouping'=>$this->Business->get_grouping($this->Business, $id))));
      foreach( $_business as $k => $busine  ){
        $business[$busine['Business']['language_id']] = $busine;
      }
			//$this->request->data = $this->Business->read(null, $id);
		}
		$languages = $this->Business->Language->find('list', array('fields'=>array('id', 'nome', 'language')));
		$this->set(compact('languages', 'business'));
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Business->id = $id;
		if (!$this->Business->exists()) {
			throw new NotFoundException(__('Invalid business'));
		}

    // Obtém os registros do mesmo grupo
    $grouping = $this->Business->read();
    $grouping = $grouping['Business']['grouping'];

		if ($this->Business->deleteAll(array('Business.grouping' => $grouping), false)  ) {
			$this->Session->setFlash(__('Business deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Business was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

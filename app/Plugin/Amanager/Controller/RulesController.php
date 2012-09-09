<?php
App::uses('AmanagerAppController', 'Amanager.Controller');
/**
 * Rules Controller
 *
 * @property Rule $Rule
 */
class RulesController extends AmanagerAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rule->recursive = 0;
		$this->set('rules', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Rule->id = $id;
		if (!$this->Rule->exists()) {
			throw new NotFoundException(__('Invalid rule'));
		}
		$this->set('rule', $this->Rule->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rule->create();
			if ($this->Rule->save($this->request->data)) {
				$this->Session->setFlash(__('The rule has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rule could not be saved. Please, try again.'));
			}
		}

		$_plugins = $this->Ctrl->get_plugins();
    foreach($_plugins as $k => $v){
      $plugins[$v] = $v;
    }
		$controllers = $this->Ctrl->get_controllers(true);

    $_actions = $this->Ctrl->get_methods_controlles($controllers[key($controllers)]);
    foreach($_actions as $k => $v){
      $actions[$v] = $v;
    }
		$groups = $this->Rule->Group->find('list');
		$this->set(compact('groups', 'plugins', 'controllers', 'actions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Rule->id = $id;
		if (!$this->Rule->exists()) {
			throw new NotFoundException(__('Invalid rule'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rule->save($this->request->data)) {
				$this->Session->setFlash(__('The rule has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rule could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Rule->read(null, $id);
		}

		$_plugins = $this->Ctrl->get_plugins();
    foreach($_plugins as $k => $v){
      $plugins[$v] = $v;
    }
		$controllers = $this->Ctrl->get_controllers(true);
    if($this->request->data['Rule']['plugin'])
      $controllers = $this->Ctrl->get_controlles_plugins($this->request->data['Rule']['plugin'], true);

    $_actions = $this->Ctrl->get_methods_controlles(key($controllers));
    if($this->request->data['Rule']['controller'])
      $_actions = $this->Ctrl->get_methods_controlles($this->request->data['Rule']['controller']);

    foreach($_actions as $k => $v){
      $actions[$v] = $v;
    }
		$groups = $this->Rule->Group->find('list');
		$this->set(compact('groups', 'plugins', 'controllers', 'actions'));
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
		$this->Rule->id = $id;
		if (!$this->Rule->exists()) {
			throw new NotFoundException(__('Invalid rule'));
		}
		if ($this->Rule->delete()) {
			$this->Session->setFlash(__('Rule deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rule was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * get_controlles_plugins method
 * @param post data
 * @return array
 */
  public function get_controlles_plugins() {

    $plugin = $this->request->data['Rule']['plugin'];

    $this->set('options', $this->Ctrl->get_controlles_plugins($plugin, true));
    $this->autoRender=false;
    $this->layout = 'ajax';
    $this->render("/Elements/options");
  }

/**
 * get_methods_controlles method
 * @param post data
 * @return array
 */
  public function get_methods_controlles() {


    $controller = $this->request->data['Rule']['controller'];

    $this->set('options', $this->Ctrl->get_methods_controlles($controller, true));
    $this->autoRender=false;
    $this->layout = 'ajax';
    $this->render("/Elements/options");
  }

}

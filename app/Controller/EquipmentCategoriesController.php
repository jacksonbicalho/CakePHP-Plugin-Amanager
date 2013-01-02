<?php
App::uses('AppController', 'Controller');
/**
 * EquipmentCategories Controller
 *
 * @property EquipmentCategory $EquipmentCategory
 */
class EquipmentCategoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EquipmentCategory->recursive = 0;
		$this->set('equipmentCategories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
		$this->set('equipmentCategory', $this->EquipmentCategory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EquipmentCategory->create();
			if ($this->EquipmentCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The equipment category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The equipment category could not be saved. Please, try again.'));
			}
		}
		$languages = $this->EquipmentCategory->Language->find('list');
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
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EquipmentCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The equipment category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The equipment category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EquipmentCategory->read(null, $id);
		}
		$languages = $this->EquipmentCategory->Language->find('list');
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
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
		if ($this->EquipmentCategory->delete()) {
			$this->Session->setFlash(__('Equipment category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Equipment category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EquipmentCategory->recursive = 0;
    $this->paginate = array('group' => 'grouping');
		$this->set('equipmentCategories', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
		$this->set('equipmentCategory', $this->EquipmentCategory->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
      $this->adjusts_language_group($this);
			$this->EquipmentCategory->create();
      if ($this->EquipmentCategory->saveAll($this->request->data['EquipmentCategory'])) {
				$this->Session->setFlash(__('The equipment category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The equipment category could not be saved. Please, try again.'));
			}
		}
		$languages = $this->EquipmentCategory->Language->find('list', array('fields'=>array('id', 'nome', 'language')));
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
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->EquipmentCategory->saveAll($this->request->data['EquipmentCategory'])) {
				$this->Session->setFlash(__('The equipment category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The equipment category could not be saved. Please, try again.'));
			}
		} else {
			$_equipment_categories = $this->EquipmentCategory->find('all', array('conditions'=>array('grouping'=>$this->EquipmentCategory->get_grouping($this->EquipmentCategory, $id))));
      foreach( $_equipment_categories as $k => $equipment_category  ){
        $equipment_categories[$equipment_category['EquipmentCategory']['language_id']] = $equipment_category;
      }
		}
		$languages = $this->EquipmentCategory->Language->find('list', array('fields'=>array('id', 'nome', 'language')));
		$this->set(compact('languages', 'equipment_categories'));
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
		$this->EquipmentCategory->id = $id;
		if (!$this->EquipmentCategory->exists()) {
			throw new NotFoundException(__('Invalid equipment category'));
		}
    $grouping = $this->EquipmentCategory->read();
    $grouping = $grouping['EquipmentCategory']['grouping'];
		if ($this->EquipmentCategory->deleteAll(array('EquipmentCategory.grouping' => $grouping), false)  ) {
			$this->Session->setFlash(__('Equipment category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Equipment category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

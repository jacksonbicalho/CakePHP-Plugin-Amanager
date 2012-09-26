<?php
App::uses('AmanagerAppController', 'Amanager.Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class RulesController extends AmanagerAppController {

    function index($tableonly = false) {
        $this->Rule->recursive = 0;
        $this->set('rules', $this->Rule->find('all'));
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Rule.'), 'error');
            $this->redirect(array('action'=>'index'));
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

      $data['Rule'] = $this->request->data['Rule'];
      $data['Action'] = $this->request->data['Action'];

			$this->Rule->create();
			if ($this->Rule->saveAssociated($data, array('atomic'=>false))) {
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

    function edit($id = null) {//$this->Rule->getEnumValues('permission'));
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Rule'), 'error');
            $this->redirect(array('action'=>'index'));
        }
        if ($id == '1') { // do not touch to the admin rule
            $this->Session->setFlash(__('Impossible to edit this rule!'), 'warning');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Rule->save($this->data)) {
                $this->Session->setFlash(__('The Rule has been saved'), 'success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Rule could not be saved. Please, try again.'), 'warning');
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Rule->read(null, $id);

			// Tranforma em array cada ações da regra
			$actions = explode(' or ', $this->data['Rule']['action']);
			$actions_salvas = array();
			foreach($actions as $k =>$v){
				$actions_salvas[$k]= trim($v);
			}
        }

		// Obtém lista de controladores e retira controladores e funções não necessárias
		$a_retirar = array('beforeSave', 'parentNode');
		$controllers = $this->Ctrl->get();

		foreach($controllers as $k => $v){
			foreach($v as $k2 => $v2){
				if (in_array($v2, $a_retirar)){
					unset($controllers[$k][$k2]);
				}
			}
		}

		$this->set(compact('controllers'));
		$this->set(compact('actions_salvas'));

        // fix groups dropdown menu
        $groups = $this->Rule->Group->find('list');
        $this->set(compact('groups'));


        // fix permissions dropdown menu
        $permissions = $this->Rule->getEnumValues('permission');
        $this->set(compact('permissions'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Rule'), 'error');
        } else
        if ($id == '1') { // do not touch to the admin rule
            $this->Session->setFlash(__('Impossible to delete this rule!'), 'warning');
        } else
        if ($this->Rule->delete($id)) {
            $this->Session->setFlash(__('Rule deleted'), 'success');
        }
        $this->redirect(array('action'=>'index'));
    }

    function up($id1, $id2) {   // swap order of two rules
        if ($id1 != 1 && $id2 != 1) {
            $r1 = $this->Rule->findById($id1);
            $r2 = $this->Rule->findById($id2);
//            pr(array($r1,$r2));
            $order = $r1['Rule']['order'];
            $r1['Rule']['order'] = $r2['Rule']['order'];
            $r2['Rule']['order'] = $order;
//            pr(array($r1,$r2));
            $this->Rule->save($r1);
            $this->Rule->save($r2);
        }
        $this->redirect(array('action'=>'index'));
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

/**
 * rules_list method
 *
 * @return void
 */
  public function update_rules_list() {

    $rule = $this->request->data['Rule'];
    $action = isset($this->request->data['Action'])?$this->request->data['Action']:array();

    unset($rule['name']);
    unset($rule['group_id']);
    $rule['controller'] = $this->Ctrl->_str_controller($rule['controller']);
    $c = explode('.', $rule['controller']);
    $rule['controller'] = isset($c[1])?$c[1]:$rule['controller'];

    $prefix = explode('_', $rule['action']);
    // Verifica se a posição[0] existe no array de prefixos definidos no bootstrap
    if(isset($prefix[0])){

      if( in_array($prefix[0], Configure::read('Routing.prefixes')) ){
        $rule[$prefix[0]] = true;
      }

    }
    $novo_alias = strtolower(Router::url($rule + array("base" => false)));
    $alias[]['alias'] =  strtolower(Router::url($rule + array("base" => false)));

    foreach($action as $k => $v){
      if( is_array($v) ){
        if ( in_array($novo_alias, $v) ){
           $alias = array();
        }
      }

    }
    $alias = array_merge( $action,$alias );

    $this->set('alias', $alias);
    $this->autoRender=false;
    $this->layout = 'ajax';
    $this->render("/Elements/update_rules_list");

  }

/**
 * reorder method
 *
 * @return void
 */
  public function reorder() {
    foreach ($this->data[$this->alias] as $key => $value) {
      $this->{$this->alias}->id = $value;
      $this->{$this->alias}->saveField("order", $key + 1);
    }
    exit();
  }


}

?>

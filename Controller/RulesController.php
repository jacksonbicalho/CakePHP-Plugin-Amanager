<?php
App::uses('AmanagerAppController', 'Amanager.Controller');
/**
 * Rules Controller
 *
 * @property Rule $Rule
 */
class RulesController extends AmanagerAppController {

  function index() {

    $this->paginate = array(
      'order' => array(
        'Rule.order' => 'asc'
        )
        );

        $this->set('rules', $this->paginate());
        //$this->set('rules', $this->Rule->find('all', array('order'=>'order')));
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid Rule.'), 'msg/error');
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
      if ( isset($this->request->data['Group']) )
      $data['Group'] = $this->request->data['Group'];

      $this->Rule->create();
      if ($this->Rule->saveAssociated($data, array('atomic'=>false))) {
        $this->Session->setFlash(__('The rule has been saved'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The rule could not be saved. Please, try again.'), 'msg/error');
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
   * @return void
   */
  function edit($id = null) {

    $this->check_rule($id);

    if (!empty($this->data)) {

      $data['Rule'] = $this->request->data['Rule'];
      if ( isset($this->request->data['Group']) )
      $data['Group'] = $this->request->data['Group'];

      if ( isset($this->request->data['Action']) ){
        $data['Action'] = $this->request->data['Action'];

        foreach( $data['Action'] as $k =>$v){
          if( !isset($v['alow']) ){
            $data['Action'][$k]['alow'] = null;
          }
        }

        // Exclui as ações que foram removidas da lista da regra
        $actions_salvas = $this->Rule->read();
        $excluir = Set::extract(
          '/id',
        array_diff_assoc($actions_salvas['Action'], $data['Action'])
        );

        $this->Rule->Action->deleteAll(array('Action.id' => $excluir), false);

      }else{ //Exclui todas as ações da regra em questão
        $this->Rule->Action->deleteAll( array('rule_id'=>$data['Rule']['id'])) ;
      }

      if ($this->Rule->saveAssociated($data, array('atomic'=>false))) {
        $this->Session->setFlash(__('The rule has been saved.'), 'msg/success');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash(__('The Rule could not be saved. Please, try again.'), 'msg/warning');
      }
    }
    if (empty($this->data)) {

      $this->request->data = $this->Rule->read();
      $actions_salvas = $this->request->data['Action'];

      $this->set(compact('actions_salvas'));

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

  }

  /**
   * delete method
   *
   * @param string $id
   * @return void
   */
  public function delete($id = null) {
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException();
    }

    $this->check_rule($id);

    if ($this->Rule->delete()) {
      $this->Session->setFlash(__('Rule deleted.'), 'msg/success');
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('Rule was not deleted.'), 'msg/error');
    $this->redirect(array('action' => 'index'));
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

    unset($rule['id']);
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

    $rule['controller'] = Inflector::underscore($rule['controller']);
    $novo_alias = strtolower(Router::url(  $rule + array("base" => false )));
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
    foreach ($this->data['Rule'] as $key => $value) {
      $this->Rule->id = $value;
      $this->Rule->saveField("order", $key + 1);
    }
    exit();
  }

  /**
   * check_rule method
   *
   * @return booleam
   */
  public function check_rule($id = null) {

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid Rule.'), 'msg/error');
      $this->redirect(array('action'=>'index'));
    }
    $id = isset($this->data['Rule']['id'])?$this->data['Rule']['id']:$id;

    $this->Rule->id = $id;
    if (!$this->Rule->exists()) {
      $this->Session->setFlash(__('Invalid Rule.'), 'msg/error');
      $this->redirect(array('action'=>'index'));
    }
  }

}

?>

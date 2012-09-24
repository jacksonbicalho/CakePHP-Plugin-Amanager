<?php
App::uses('AmanagerAppController', 'Amanager.Controller');

/**
 * Amanagers Controller
 *
 */
class AmanagerController extends AmanagerAppController {

  public function beforeFilter() {
      //Configure AuthComponent
 //   $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
 //   $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
 //   $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');
  }

/**
 * uses
 *
 * @var array
 */
	public $uses = array();

  public function index() {  }

}

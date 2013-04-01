<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * EntitysUser Model
 *
 * @property Group $Group
 */
class EntitysUser extends AmanagerAppModel {

  /**
   * Use database config
   *
   * @var string
   */
  public $useDbConfig = 'acessmanager';

  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
		'User' => array(
			'className' => 'Amanager.User',
			'foreignKey' => 'user_id',
			'dependent' => true,
  )
  );

  public function beforeDelete($cascade = true) {

    $entry = $this->read();
    // Exclui o usuário referente a essa entrada
    $this->User->delete( $entry['EntitysUser']['user_id'], false);
    parent::beforeDelete($cascade = true);
  }





}
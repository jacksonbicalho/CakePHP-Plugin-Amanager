<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * EntitysUser Model
 *
 * @property Group $Group
 */
class UserModel extends AmanagerAppModel {

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
		$this->User->delete( $entry['UserModel']['user_id'], false);
		parent::beforeDelete($cascade = true);
	}

}

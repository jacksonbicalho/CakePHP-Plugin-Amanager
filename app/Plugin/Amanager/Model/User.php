<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AmanagerAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'acessmanager';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group',
			'joinTable' => 'groups_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'group_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

/**
 * beforeSave method
 * @param array $options
 * @return boolean
 */
  public function beforeSave($options = array()) {

    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = $this->encrypt_password( $this->data[$this->alias]['password'], $this->data[$this->alias]['username'] );
    }
    return true;
  }

/**
 * encrypt_password method
 *
 * @param string $password
 * @param string $login
 *
 * @return string $encrypted
 */
  public function encrypt_password($password,$username){
    return sha1 ( $username . "_" . $password );
  }

/**
 * login method
 *
 * @param string $password
 * @param string $login
 *
 * @return string $encrypted
 */
  public function login($data){
    $username = $data[$this->alias]['username'];
    $password = $this->encrypt_password( $data[$this->alias]['password'], $data[$this->alias]['username'] );
    $user_data = $this->find('first', array('conditions'=>array('username'=>$username, 'password'=>$password)) );
    return $user_data;
  }


}

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
				'message' => 'Nome de usuário não pode ficar em branco',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Senha não pode ficar em branco',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'E-mail não pode ficar em branco',
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
  var $hasAndBelongsToMany = array(
    'Group' => array(
      'className' => 'Amanager.Group'
    ),
  );

  public function beforeSave($options = array()) {
    $this->data['User']['password'] = $this->encripty_password( $this->data['User']['password'], $this->data['User']['username'] );
    return true;
  }

  public function encripty_password($password, $username) {
    return md5($password . $username);
  }

/**
 * password_generator method
 *
 * Gera uma senha com a quantidade de caracteres passada no parâmetro $size
 * Se o parâmetro não for informado, a quantidade de 10 caracteres é assumida
 *
 * @params integer $size
 *
 * @var array
 */
  public function password_generator($size = 10) {
    return substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$' ) , 0 , $size );
  }

}
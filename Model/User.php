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
        'rule'     => 'notempty',
        'required' => true,
        'message'  => 'Nome de usuário é obrigatório'
      ),
      'username-unique' => array(
        'rule'    => 'isUnique',
        'message' => 'Nome de usuário digitado já encontra-se cadastrado em nosso sistema'
      )
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
        'rule'     => 'notempty',
        'required' => true,
        'message'  => 'E-mail é obrigatório'
      ),
      'email' => array(
        'rule'     => 'email',
        'required' => true,
        'message'  => 'O endereço digitado nẽo é um e-mail válido'
      ),
      'email-unique' => array(
        'rule'    => 'isUnique',
        'message' => 'O e-mail digitado já encontra-se cadastrado em nosso sistema'
      )
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'EntitysUser' => array(
			'className' => 'Amanager.EntitysUser',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

  public function beforeSave($options = array()) {
    $this->data['User']['password'] = $this->encripty_password( $this->data['User']['password'], $this->data['User']['username'] );
    return true;
  }

  public function encripty_password($password, $username) {
    return md5($password . $username);
  }

}
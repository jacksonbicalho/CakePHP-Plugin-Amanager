<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AmanagerAppModel {

  var $alter_username = false;

  /**
   * Use database config
   *
   * @var string
   */
  //public $useDbConfig = 'acessmanager';

  /**
   * Validation rules
   *
   * @var array
   */
  public $validate = array(
		'username' => array(
      'notBlank' => array(
        'rule'     => 'notBlank',
        'required' => true,
        'message'  => 'Nome de usuário é obrigatório',
      ),
      'username-unique' => array(
        'rule'    => 'isUnique',
        'message' => 'Nome de usuário digitado já encontra-se cadastrado em nosso sistema',
      )
    ),

    'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Senha não pode ficar em branco',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'update', // Limit validation to 'create' or 'update' operations
			),
			'password' => array(
        'rule'    => array('minLength', '8'),
        'message' => 'Mínimo 8 caracteres',
        'on' => 'update', // Limit validation to 'create' or 'update' operations
      ),
		),

		'password2' => array(
      'notBlank' => array(
        'rule'     => 'notBlank',
        'required' => true,
        'message'  => 'Este campo é obrigatório',
        'on' => 'update', // Limit validation to 'create' or 'update' operations
      ),
      'compare_password' => array(
        'rule'    => 'compare_password',
        'message' => 'A senha repetida não confere com a digitada no campo senha.',
      )
    ),

		'email' => array(
      'notBlank' => array(
        'rule'     => 'notBlank',
        'required' => true,
        'message'  => 'E-mail é obrigatório'
      ),
      'email' => array(
        'rule'     => 'email',
        'required' => true,
        'message'  => 'O endereço digitado não é um e-mail válido!'
      ),
      'email-unique' => array(
        'rule'    => 'isUnique',
        'message' => 'O e-mail digitado já encontra-se cadastrado em nosso sistema!'
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

  public function compare_password($field) {
    if( $field['password2'] != $this->data['User']['password'] ){
      return false;
    }
    return true;
  }

  public function beforeSave($options = array()) {

    // Obtém o nome de uauário cadastrado no sistema
    // e verifica se o mesmo foi alterado
    $user =  $this->findById($this->id);
    $username = isset($user['User']['username'])?$user['User']['username']:null;
    $alter_username = $this->data['User']['username'] != $username?true:false;

    // Se o nome de usuário digitado for diferente do nome de usuário cadastrado
    // se a senha nõ estiver vazia ou confirmação de senha não estiver vazia
    if(
        ( $username != null and $alter_username) or
        !empty($this->data['User']['password']) or
        !empty($this->data['User']['password2'])
      ){
      //$this->validate['password']['notempty']['on']='update';
      //$this->validate['password2']['notempty']['on']='update';

      // Se nome de usuário tiver sido alterado, obriga a digitar a senha
      // levando em conta que a senha é criptografada de acordo com o nome de usuário
      if($alter_username){
        $this->validate['password']['notempty']['required'] = true;
        $this->validate['password2']['notempty']['required'] = true;
      }

      $this->validate['password2']['compare_password'] = array(
        'rule'    => 'compare_password',
        'message' => 'A senha repetida não confere com a digitada no campo senha.',
      );

      $this->data['User']['password'] = $this->encripty_password( $this->data['User']['password'], $this->data['User']['username'] );
      if ( isset($this->data['User']['password2']) ){
        unset($this->data['User']['password2']);
      }
    }else{
      // Se a senha não tiver sido alterada, remove os campos para não sofrerem alterações
      unset($this->data['User']['password']);
      unset($this->data['User']['password2']);
    }

    return true;
  }



/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from model::save(), see $options of model::save().
 * @return boolean True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 */
	public function beforeValidate($options = array()) {
    // Se id não for falso está sendo alterado
    if($this->id){
      // Obtém o nome de uauário cadastrado no sistema
      // e verifica se o mesmo foi alterado
      $user =  $this->findById($this->id);
      $username = $user['User']['username'];
      $this->alter_username = $this->data['User']['username'] != $username?true:false;

      // Se nome de usuário tiver sido alterado, obriga a digitar a senha
      // levando em conta que a senha é criptografada de acordo com o nome de usuário
      if($this->alter_username){
        unset($this->validate['password']['password']['on']);
        unset($this->validate['password2']['notempty']['on']);
        $this->validate['password']['password'] = array(
          'rule'    => 'notempty',
          'message' => 'Para alterar o nome de usuário é necessário digitar a senha. Se desejar, você pode aproveitar para alter a senha.',
        );
      }
    }
		return true;
	}


  public function encripty_password($password, $username) {
    return md5($password . $username);
  }

  /**
   * Verifica se usuário está em especificado grupo
   *
   * in_group method
   *
   * @param string $user_id
   * @param string $group_name
   * @return boolean
   */
  public function in_group($user_id, $group_name) {

    $this->id = $user_id;
    if (!$this->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $user = $this->read();
    foreach( $user['Group'] as $groups ){
      if( in_array($group_name, $groups, true) ){
        return true;
      }
    }
    return false;
  }

}
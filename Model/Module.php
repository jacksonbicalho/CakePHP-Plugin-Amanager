<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * Module Model
 *
 * @property Rule $Rule
 * @property Action $Action
 */
class Module extends AmanagerAppModel {

  /**
   * Use database config
   *
   * @var string
   */
  public $useDbConfig = 'acessmanager';

  /**
   * Display field
   *
   * @var string
   */
  public $displayField = 'name';

  /**
   * Validation rules
   *
   * @var array
   */
  public $validate = array(
		'rule_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
  //'message' => 'Your custom message here',
  //'allowEmpty' => false,
  //'required' => false,
  //'last' => false, // Stop validation after this rule
  //'on' => 'create', // Limit validation to 'create' or 'update' operations
  ),
  ),
		'name' => array(
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
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
		'Rule' => array(
			'className' => 'Rule',
			'foreignKey' => 'rule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
			);

			/**
			 * hasMany associations
			 *
			 * @var array
			 */
			public $hasMany = array(
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'module_id',
			'dependent' => false,
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

}

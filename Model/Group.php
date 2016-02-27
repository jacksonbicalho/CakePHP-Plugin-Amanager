<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AmanagerAppModel {

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'uniqueNameRule' => array(
				'rule' => 'isUnique',
				'message' => 'Já existe uma grupo com esse nome!'
			)
		),
  );

  /**
   * Use database config
   *
   * @var string
   */
  //public $useDbConfig = 'acessmanager';

  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * hasAndBelongsToMany associations
   *
   * @var array
   */
  var $hasAndBelongsToMany = array(
    'Rule' => array(
      'className' => 'Amanager.Rule'
		),
		'User' => array(
			'className' => 'Amanager.User'
		)
	);
}

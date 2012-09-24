<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AmanagerAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'acessmanager';

/**
 * recursive
 *
 * @var numeric
 */
  public $recursive = 1;

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
  var $hasMany = array(
    'Rule' => array(
      'className' => 'Amananager.Rule',
      'exclusive' => false,
      'dependent' => false,
      'foreignKey' => 'group_id',
      'order' => 'Rule.order ASC'
    )
  );

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
  var $hasAndBelongsToMany = array(
    'User' => array(
      'className' => 'Authake.User',
      'joinTable' => 'authake_groups_users',
      'foreignKey' => 'group_id',
      'associationForeignKey'=> 'user_id',
      'order' => 'User.id',
      'displayField' => 'login'
    )
  );

}

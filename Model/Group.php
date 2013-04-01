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

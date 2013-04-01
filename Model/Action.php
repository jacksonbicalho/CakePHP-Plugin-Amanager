<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * Action Model
 *
 */
class Action extends AmanagerAppModel {

  /**
   * belongsTo associations
   *
   * @var array
   */
  var $belongsTo = array(
          'Rule' => array(
          'className'  => 'Rule',
          'foreignKey' => 'rule_id',
  //'order' => 'Rule.order ASC'
  )
  );

}
?>
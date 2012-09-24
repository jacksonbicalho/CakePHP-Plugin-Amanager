<?php
App::uses('AmanagerAppModel', 'Amanager.Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class Rule extends AmanagerAppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
  var $belongsTo = array(
          'Group' => array(
          'className'  => 'Group',
          'foreignKey' => 'group_id',
          //'order' => 'Rule.order ASC'
          )
      );

/**
 * hasMany associations
 *
 * @var array
 */
  var $hasMany = array(
    'Action' => array(
      'className' => 'Action',
      'exclusive' => false,
      'dependent' => false,
      'foreignKey' => 'rule_id',
      'dependent'     => true,
      //'order' => 'Rule.order ASC'
    )
  );



  function getRules($group_ids, $cleanRegex = false) {
      if(is_array($group_ids)){ //if no group get rules for the all users (with group_id is null)
          $groups = implode(',', $group_ids);
          $conditions = "Rule.group_id IN ({$groups}) OR Rule.group_id is NULL";
      } else {
          $conditions = "Rule.group_id is NULL";
      }

      $fields = '';
      $order = 'Rule.order ASC, Rule.group_id ASC';
      $data = $this->find('all', array('conditions'=>$conditions, 'fields'=>$fields, 'order'=>$order, 'contain'=>array()));

      if ($cleanRegex) {
          $nb = count($data);
          for($i=0; $i<$nb; $i++) {
              $data[$i]['Rule']['action'] = str_replace(array('/','*',' or '), array('\/', '.*','|'), $data[$i]['Rule']['action']);
          }
      }
      return $data;
  }

	function beforeValidate(){

		return true;

	}

function get_sql_insert_id() {
   $db =& ConnectionManager::getDataSource($this->useDbConfig);
   return $db->lastInsertId();
}





}
?>
<?php

App::uses('AmanagerAppModel', 'Amanager.Model');

/**
 * Rule Model
 *
 */
class Rule extends AmanagerAppModel {

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    var $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'Amanager.Group'
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    var $hasMany = array(
        'Action' => array(
            'className' => 'Amanager.Action',
            'dependent'     => true,
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


    function get_sql_insert_id() {
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        return $db->lastInsertId();
    }

    /**
     * Called after each find operation. Can be used to modify any results returned by find().
     * Return value should be the (modified) results.
     *
     * @param mixed $results The results of the find operation
     * @param boolean $primary Whether this model is being queried directly (vs. being queried as an association)
     * @return mixed Result of the find operation
     * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#afterfind
     */
    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if(isset($value['Action'])){
                if(isset($results[$key]['Action'])){
                    $results[$key]['Action'] = $this->jsonToArray($value['Action']);
                }
            }
        }
        return $results;
    }

    /**
     * Called during validation operations, before validation. Please note that custom
     * validation rules can be defined in $validate.
     *
     * @param array $options Options passed from Model::save().
     * @return boolean True if validate operation should continue, false to abort
     * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
     * @see Model::save()
     */
    public function beforeValidate($options = array()) {
        if(isset($this->data['Action'])){
            $this->data['Action'] = $this->arrayToJson($this->data['Action']);
        }
        return true;
    }

    /**
     * Converte um array de actions (objectors Json) em um array de actions (strings)
     * @param  actions  $array de objetos Json
     * @return array dados convertidos em array
     */
    public function jsonToArray($actions = array()){
        /* Corre todas as ações para transformá-las em objetos json */
        foreach ($actions as $key => $action) {
            $params = (array)json_decode($action['alias']);
            $alias = Router::url($params   + array("base" => false));
            $actions[$key]['alias'] = $alias;
        }
        return $actions;
    }

    /**
     * Converte um array de actions em um array de actions (Objetos Json)
     * @param  actions  $array
     * @return array objetos Json
     */
    public function arrayToJson($actions = array()){
        /* Corre todas as ações para transformá-las em objetos json */
        foreach ($actions as $key => $action) {
            $params = Router::parse($action['alias'], false );
            $actions[$key]['alias'] = json_encode($params);
        }
        return $actions;
    }
}
?>

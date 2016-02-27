<?php

App::uses('AmanagerAppModel', 'Amanager.Model');
App::uses('AmanagerComponent', 'Amanager.Controller');

/**
 * Rule Model
 *
 */
class Rule extends AmanagerAppModel {

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
				'message' => 'Já existe uma regra com esse nome!'
			)
		),
  );

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
				$results[$key]['Action'] = $this->jsonToArray($results[$key]['Action']);
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
		$amanager = new AmanagerComponent(new ComponentCollection);
		/* Corre todas as ações para transformá-las em objetos json */
		foreach ($actions as $key => $action) {
			$params = Router::parse($action['alias'], false );
			$params = $amanager->limpaPrametros($params);
			$actions[$key]['alias'] = json_encode($params);
		}
		return $actions;
	}
}
?>

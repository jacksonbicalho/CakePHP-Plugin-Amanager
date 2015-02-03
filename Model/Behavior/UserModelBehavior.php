<?php
class UserModelBehavior extends ModelBehavior {

  public $seoData = array();

  public $recordRunTime;

  /**
  * Initiate Callbacks Behavior
  *
  * @param object $Model
  * @param array $config
  * @return void
  * @access public
  */
  public function setup(Model $model, $config = array()) {
  }

/**
 * Called before each find operation. Return false if you want to halt the find
 * call, otherwise return the (modified) query data.
 *
 * @param array $queryData Data used to execute this query, i.e. conditions, order, etc.
 * @return mixed true if the operation should continue, false if it should abort; or, modified
 *               $queryData to continue with new $queryData
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforefind
 */
	public function beforeFind(Model $model, $queryData) {

    if($model->alias != 'UserModel'){
		if($model->alias != 'UserModel'){
			$this->hasOne($model);
		}
    }

		return true;
	}

/**
 * beforeValidate is called before a model is validated, you can use this callback to
 * add behavior validation rules into a models validate array. Returning false
 * will allow you to make the validation fail.
 *
 * @param Model $model Model using this behavior
 * @return mixed False or null will abort the operation. Any other result will continue.
 */
	public function beforeValidate(Model $model, $options = array()) {

		$this->hasOne($model);

		// Verifica se não há erros nos dados do aluno para poder criar o usuário sem problemas
		$model->UserModel->User->set( $model->data['User'] );
		$errors = $model->UserModel->User->invalidFields();
		foreach( $errors as $field => $erro ){
			$model->invalidate($field, $erro[0]);
		}

	}

/**
 * Called before each save operation, after validation. Return a non-true result
 * to halt the save.
 *
 * @param array $options
 * @return boolean True if the operation should continue, false if it should abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforesave
 */
	public function beforeSave(Model $model, $options = array()) {

    if($model->alias != 'MetaTag' && !empty($model->data['MetaTag'])){
      $model->data['MetaTag']['model'] = $model->alias;
      $this->seoData['MetaTag'] = $model->data['MetaTag'];
    }

	}

/**
 * Called after each successful save operation.
 *
 * @param boolean $created True if this save created a new record
 * @return void
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#aftersave
 */
	public function afterSave(Model $model, $created, $options = array()) {

    if($model->alias != 'MetaTag' && !empty($model->data['MetaTag'])){
      $model->bindModel(
        array('hasOne' => array(
            'MetaTag' => array(
              'className' => 'Seo.MetaTag',
              'foreignKey' => "foreign_key",
              'conditions' => array('MetaTag.model' => "{$model->alias}"),
              'dependent' => true
            )
          )
        )
      );
      $this->seoData['MetaTag']['foreign_key'] = $model->id;
      $record = $model->read();
      $record['MetaTag'] = $this->seoData['MetaTag'];
      $model->MetaTag->saveAll($record, array('callbacks'=>false));
    }

	}

/**
 * Called after every deletion operation.
 *
 * @return void
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#afterdelete
 */
  public function afterDelete(Model $model) {
  }

/**
 * Before delete is called before any delete occurs on the attached model, but after the model's
 * beforeDelete is called. Returning false from a beforeDelete will abort the delete.
 *
 * @param Model $model Model using this behavior
 * @param boolean $cascade If true records that depend on this record will also be deleted
 * @return mixed False if the operation should abort. Any other result will continue.
 */
	public function beforeDelete(Model $model, $cascade = true) {

    if($model->alias != 'MetaTag'){

      $record = $model->read();
      if(isset($record['MetaTag']['id'])){
        $model->MetaTag->id = $record['MetaTag']['id'];
        $model->MetaTag->delete();
      }
    }

	}

	public function hasOne(Model $model){
		$model->bindModel(
			array('hasOne' => array(
				'UserModel' => array(
				'className' => 'Amanager.UserModel',
				'foreignKey' => "foreign_key",
				'conditions' => array('UserModel.model' => "{$model->alias}"),
				'dependent' => true
				))
			)
		);
		return $model;
	}


}

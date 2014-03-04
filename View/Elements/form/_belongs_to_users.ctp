<?php
  $error = array('attributes' => array('class' => 'alert alert-danger'));
  echo $this->Form->input('User.username',
    array(
      'label'=>__d('amanager', 'Username'),
      'class'=>'form-control',
      'error'=>$error
    )
  );
  echo $this->Form->input('User.password', array('error'=>$error));
  echo $this->Form->input('User.password2', array('type'=>'password', 'error'=>$error));
  echo $this->Form->input('User.email',
    array(
      'label'=>__d('amanager', 'Email'),
      'class'=>'form-control',
      'error'=>$error,
      'required'=> true
    )
  );
  echo $this->Form->input('User.Group', array('label' => __d('amanager', 'Group'), 'type' => 'select', 'multiple' => 'checkbox'));
?>
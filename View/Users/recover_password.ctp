<div class="users recover_password">
<?php echo $this->Form->create('User', array('class'=>'form-signin', 'role'=>'form')); ?>
  <h2 class="form-signin-heading"><?php echo __d('amanager', 'Password Recovery'); ?></h2>
	<?php
		echo $this->Form->input('id', array('value'=>$user_id));
    echo $this->Form->input('password', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'label' => __d('amanager', 'Enter the new password'), 'class'=>'form-control', 'autofocus'=>'', 'placeholder'=>__d('amanager', 'Email address') ));
    echo $this->Form->input('password2', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'type'=>'password', 'label' => __d('amanager', 'Enter the password again'), 'class'=>'form-control', 'placeholder'=>__d('amanager', 'Email address')));
    echo $this->Form->submit(__d('amanager', 'Create password'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
	?>
</div>
<div class="clr"></div>
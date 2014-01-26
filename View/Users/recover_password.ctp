<div class="users recover_password">
<?php echo $this->Form->create('User', array('class'=>'form-signin')); ?>
	<?php
		echo $this->Form->input('id', array('value'=>$user_id));
    echo $this->Form->input('password', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'label' => __d('amanager', 'Enter the new password'), 'class' => 'span3'));
    echo $this->Form->input('password2', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'type'=>'password', 'label' => __d('amanager', 'Enter the password again'), 'class' => 'span3'));
    echo $this->Form->submit(__d('amanager', 'Create password'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
	?>
</div>
<div class="clr"></div>
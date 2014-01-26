<div class="users forgot_password">
<?php echo $this->Form->create('User', array('class'=>'form-signin')); ?>
	<?php
    echo $this->Form->input('email', array('label'=>__d('amanager', 'Email')));
    echo $this->Form->submit(__d('amanager', 'Continue'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
	?>
</div>
<div class="clr"></div>
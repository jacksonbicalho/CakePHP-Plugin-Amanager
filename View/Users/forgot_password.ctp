<div class="users forgot_password">
<?php echo $this->Form->create('User', array('class'=>'form-signin', 'role'=>'form')); ?>
  <h2 class="form-signin-heading"><?php echo __d('amanager', 'Password Recovery'); ?></h2>
	<?php
    echo $this->Form->input('email', array('label'=>__d('amanager', 'Email'), 'class'=>'form-control', 'autofocus'=>'', 'placeholder'=>__d('amanager', 'Email address')));
    echo $this->Form->submit(__d('amanager', 'Continue'), array('class' => 'btn btn-lg btn-primary btn-block'));
    echo $this->Form->end();
	?>
</div>
<div class="clr"></div>
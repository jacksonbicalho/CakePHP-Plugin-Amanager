<?php
echo $this->Session->flash('auth');
echo $this->Form->create('User', array('url' => array('controller' =>'users', 'action' => 'login'), 'class'=>'form-signin'));
?>
<h2><?php echo __d('amanager', 'Please sign in'); ?></h2>
<?php
echo $this->Form->input('User.username', array('label'=>__d('amanager', 'email'), 'class'=>'input-block-level', 'placeholder'=>__('Email address')));
echo $this->Form->input('User.password', array('label'=>__d('amanager', 'Password'), 'class'=>'input-block-level', 'placeholder'=>__('Password')));
echo $this->Form->submit(__d('amanager', 'Login'), array('class'=>'btn btn-large btn-primary'));
echo $this->Html->link(__d('amanager', 'Forgot password'), array('plugin'=>'amanager', 'controller'=>'users', 'action'=>'forgot_password' ));
echo $this->Form->end();
?>
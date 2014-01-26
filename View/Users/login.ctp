<?php
  echo $this->Form->create('User',
    array(
      'url' => array('controller' =>'users', 'action' => 'login'),
      'class'=>'form-signin',
      'role'=>'form'
    )
  );
?>
<h2 class="form-signin-heading"><?php echo __d('amanager', 'Please sign in'); ?></h2>
<?php
  echo $this->Form->input('User.username',
    array(
      'label'=>__d('amanager', 'Email'),
      'class'=>'form-control',
      'placeholder'=>__d('amanager', 'Email address'),
      'autofocus'=>'',
    )
  );
  echo $this->Form->input('User.password',
    array(
      'label'=>__d('amanager', 'Password'),
      'class'=>'form-control',
      'placeholder'=>__d('amanager', 'Password'),
    )
  );
  echo $this->Form->submit(__d('amanager', 'Sign in'),
    array(
      'class'=>'btn btn-lg btn-primary btn-block'
    )
  );
  echo $this->Html->link(__d('amanager', 'Forgot password'), array('plugin'=>'amanager', 'controller'=>'users', 'action'=>'forgot_password'), array('class'=>'btn link forgot_password'));
  echo $this->Form->end();
?>
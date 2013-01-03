<div class="form login span4 bordered">
  <?php echo $this->Session->flash('auth'); ?>
  <?php echo $this->Form->create('User', array('class'=>'span3')); ?>
  <legend><?php echo __('Login'); ?></legend>
  <?php
  echo $this->Form->input('username', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'label' => __('User Name'), 'class' => 'span3'));
  echo $this->Form->input('password', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'label' => __('Password'), 'class' => 'span3'));
  echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary'));
  echo $this->Html->link(__('I forgot my password', true), array('controller'=>'users', 'action'=>'forgot_password'), array('title'=>__('I forgot my password', true)));
  echo $this->Form->end();
  ?>
</div>
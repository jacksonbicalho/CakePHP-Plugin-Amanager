<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __d('amanager', 'Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('label'=>__d('amanager', 'Username')));
		echo $this->Form->input('password', array('value'=>null, 'label'=>__d('amanager', 'password')));
		echo $this->Form->input('password2', array('label'=>__d('amanager', 'Confirm password'),'type'=>'password', 'value'=>null));
		echo $this->Form->input('email', array('label'=>__d('amanager', 'Email')));
		echo $this->Form->input('passwordchangecode', array('label'=>__d('amanager', 'Password change code')));
		echo $this->Form->input('status');
		echo $this->Form->input('Group', array('label'=>__d('amanager', 'Group')));
	?>
	</fieldset>
<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __d('amanager', 'Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __d('amanager', 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __d('amanager', 'List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
	</ul>
</div>

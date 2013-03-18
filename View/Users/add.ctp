<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('passwordchangecode');
		echo $this->Form->input('status');
		echo $this->Form->input('group');
	?>
	</fieldset>
<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __('Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
	</ul>
</div>

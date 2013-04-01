<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password2', array('type'=>'password'));
		echo $this->Form->input('email');
		echo $this->Form->input('passwordchangecode');
		echo $this->Form->input('status');
		echo $this->Form->input('Group');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink('<i class="icon-white icon-trash"></i>  ' . __('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('escape'=>false, 'class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Users'), array('action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('New Group'), array('controller' => 'groups', 'action' => 'add'), array('escape'=>false, 'class'=>'btn')); ?> </li>
	</ul>
</div>

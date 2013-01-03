<div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __('Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink('<i class="icon-white icon-trash"></i>  ' . __('Delete'), array('action' => 'delete', $this->Form->value('Group.id')), array('escape'=>false, 'class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Groups'), array('action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false, 'class'=>'btn')); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('New User'), array('controller' => 'users', 'action' => 'add'), array('escape'=>false, 'class'=>'btn')); ?> </li>
	</ul>
</div>

<div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array('checked'=>true));
	?>
	</fieldset>
<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __('Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Groups'), array('action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
	</ul>
</div>

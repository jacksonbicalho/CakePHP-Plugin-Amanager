<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __('List Rules'), array('action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __('New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
</ul>
<?php echo $this->element('form/_rules'); ?>

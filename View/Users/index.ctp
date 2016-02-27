<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('escape'=>false)); ?></li>
</ul>
<div class="groups index">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="visible-lg"><?php echo $this->Paginator->sort('id'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('username'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('name'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('status'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('modified'); ?></th>
        <th width="130" class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <?php foreach ($users as $user): ?>
    <tr>
      <td class="visible-lg"><?php echo h($user['User']['id']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($user['User']['username']); ?>&nbsp;</td>
      <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($user['User']['status']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($user['User']['created']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($user['User']['modified']); ?>&nbsp;</td>
			<td class="actions cancel">
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
				<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
			</td>
    </tr>
    <?php endforeach; ?>
	</table>
  <div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __d('amanager', 'previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__d('amanager', 'next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
  </div>
</div>




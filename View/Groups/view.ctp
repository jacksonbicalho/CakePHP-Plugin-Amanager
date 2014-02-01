<ul class="nav nav-justified">
  <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>  ' . __('Delete'), array('action' => 'delete', $group['Group']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'Edit this group'), array('controller' => 'groups', 'action' => 'edit', $group['Group']['id']), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('controller' => 'users', 'action' => 'add'), array('escape'=>false)); ?>
</ul>

<div class="groups view col-xs-12">
  <div class="page-header">
    <h2><?php echo __d('amanager', 'Group'); ?></h2>
  </div>
	<dl class="tabela">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($group['Group']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
      <span class="label label-default"><?php echo $group['Group']['status']==1?__d('amanager', 'Active'):__d('amanager', 'Inactive'); ?></span>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified']); ?>
			&nbsp;
		</dd>
    <div class="clr"></div>
	</dl>
  <div class="related">
    <h3><?php echo __('Related Users'); ?></h3>
    <?php if (!empty($group['User'])): ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="visible-lg"><?php echo __('Id'); ?></th>
          <th><?php echo __('Username'); ?></th>
          <th class="visible-lg"><?php echo __('Password'); ?></th>
          <th class="visible-lg"><?php echo __('Email'); ?></th>
          <th class="visible-lg"><?php echo __('Status'); ?></th>
          <th class="visible-lg"><?php echo __('Created'); ?></th>
          <th class="visible-lg"><?php echo __('Modified'); ?></th>
          <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
      </thead>
      <?php
        $i = 0;
        foreach ($group['User'] as $user): ?>
        <tr>
          <td class="visible-lg"><?php echo $user['id']; ?></td>
          <td><?php echo $user['username']; ?></td>
          <td class="visible-lg"><?php echo $user['password']; ?></td>
          <td class="visible-lg"><?php echo $user['email']; ?></td>
          <td class="visible-lg"><?php echo $user['status']; ?></td>
          <td class="visible-lg"><?php echo $user['created']; ?></td>
          <td class="visible-lg"><?php echo $user['modified']; ?></td>
          <td class="actions">
            <?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id']), array('class'=>'btn')); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
  </div>
</div>
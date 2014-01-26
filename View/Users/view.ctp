<div class="users view">
<h2><?php  echo __d('amanager', 'User'); ?></h2>
	<dl class="tabela table-bordered table-striped">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Password change code'); ?></dt>
		<dd>
			<?php echo h($user['User']['passwordchangecode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('amanager', 'Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __d('amanager', 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('<i class="icon-edit"></i>  ' . __d('amanager', 'Edit User'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Form->postLink('<i class="icon-white icon-trash"></i>  ' . __d('amanager', 'Delete User'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger', 'escape'=>false), __d('amanager', 'Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-edit"></i>  ' . __d('amanager', 'List Users'), array('action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-edit"></i>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php echo __d('amanager', 'Related Groups'); ?></h3>
	<?php if (!empty($user['Group'])): ?>
  <table class="table table-bordered table-striped">
    <tr>
      <th><?php echo __d('amanager', 'ID'); ?></th>
      <th><?php echo __d('amanager', 'Name'); ?></th>
      <th><?php echo __d('amanager', 'Status'); ?></th>
      <th><?php echo __d('amanager', 'Created'); ?></th>
      <th><?php echo __d('amanager', 'Modified'); ?></th>
      <th class="actions"><?php echo __d('amanager', 'Actions'); ?></th>
    </tr>
    <?php foreach ($user['Group'] as $group): ?>
    <tr>
      <td><?php echo h($group['id']); ?>&nbsp;</td>
      <td><?php echo h($group['name']); ?>&nbsp;</td>
      <td><?php echo h($group['status']); ?>&nbsp;</td>
      <td><?php echo h($group['created']); ?>&nbsp;</td>
      <td><?php echo h($group['modified']); ?>&nbsp;</td>
      <td class="actions">
        <?php echo $this->Html->link(__d('amanager', 'View'), array('controller'=>'groups', 'action' => 'view', $group['id'])); ?>
        <?php echo $this->Html->link(__d('amanager', 'Edit'), array('controller'=>'groups', 'action' => 'edit', $group['id'])); ?>
        <?php echo $this->Form->postLink(__d('amanager', 'Delete'), array('controller'=>'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
      </td>
    </tr>
    <?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>' . __d('amanager', 'New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
		</ul>
	</div>
</div>
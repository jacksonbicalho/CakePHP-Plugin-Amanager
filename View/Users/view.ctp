<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>  ' . __d('amanager', 'List users'), array('controller'=>'users', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>  ' . __d('amanager', 'Edit'), array('controller'=>'users', 'action' => 'edit', $user['User']['id']), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>  ' . __('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('escape'=>false), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
</ul>

<div class="users view col-xs-12">
  <div class="page-header">
    <h2><?php echo __d('amanager', 'User'); ?></h2>
  </div>

  <dl class="tabela">
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
      <span class="label label-default"><?php echo $user['User']['status']==1?__d('amanager', 'Active'):__d('amanager', 'Inactive'); ?></span>
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
    <div class="clr"></div>
  </dl>

  <div class="related">
    <h3><?php echo __d('amanager', 'Related Groups'); ?></h3>
    <?php if (!empty($user['Group'])): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="visible-lg"><?php echo __d('amanager', 'ID'); ?></th>
            <th><?php echo __d('amanager', 'Name'); ?></th>
            <th class="visible-lg"><?php echo __d('amanager', 'Status'); ?></th>
            <th class="visible-lg"><?php echo __d('amanager', 'Created'); ?></th>
            <th class="visible-lg"><?php echo __d('amanager', 'Modified'); ?></th>
            <th class="actions"><?php echo __d('amanager', 'Actions'); ?></th>
          </tr>
        </thead>
        <?php foreach ($user['Group'] as $group): ?>
        <tr>
          <td class="visible-lg"><?php echo h($group['id']); ?>&nbsp;</td>
          <td><?php echo h($group['name']); ?>&nbsp;</td>
          <td class="visible-lg"><?php echo h($group['status']); ?>&nbsp;</td>
          <td class="visible-lg"><?php echo h($group['created']); ?>&nbsp;</td>
          <td class="visible-lg"><?php echo h($group['modified']); ?>&nbsp;</td>
          <td class="actions">
            <?php echo $this->Html->link(__d('amanager', 'View'), array('controller'=>'groups', 'action' => 'view', $group['id'])); ?>
            <?php echo $this->Html->link(__d('amanager', 'Edit'), array('controller'=>'groups', 'action' => 'edit', $group['id'])); ?>
            <?php echo $this->Form->postLink(__d('amanager', 'Delete'), array('controller'=>'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </div>



</div>


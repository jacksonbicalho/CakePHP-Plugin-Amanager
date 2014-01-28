<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('escape'=>false)); ?></li>
</ul>
<div class="users index col-xs-12">
  <div class="page-header">
    <h2><?php echo __d('amanager', 'Groups'); ?></h2>
  </div>
  <p>
  <?php
  echo $this->Paginator->counter(array(
  'format' => __d('amanager', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
  ));
  ?></p>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="visible-lg"><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('status'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="visible-lg"><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <?php foreach ($groups as $group): ?>
    <tr>
      <td class="visible-lg"><?php echo h($group['Group']['id']); ?>&nbsp;</td>
      <td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($group['Group']['status']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($group['Group']['created']); ?>&nbsp;</td>
      <td class="visible-lg"><?php echo h($group['Group']['modified']); ?>&nbsp;</td>
      <td class="actions">
        <?php echo $this->Html->link(__('View'), array('action' => 'view', $group['Group']['id'])); ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $group['Group']['id'])); ?>
        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?>
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


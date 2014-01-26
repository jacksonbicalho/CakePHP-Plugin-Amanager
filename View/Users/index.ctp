<div class="btn-group btn-group-justified">
  <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('role'=>'button', 'class'=>'btn btn-default', 'escape'=>false)); ?>
  <?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('role'=>'button', 'class'=>'btn btn-default', 'escape'=>false)); ?>
  <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('role'=>'button', 'class'=>'btn btn-default', 'escape'=>false)); ?>
</div>
<div class="users index col-xs-12">
  <h2><?php echo __d('amanager', 'Users'); ?></h2>
  <p>
  <?php
  echo $this->Paginator->counter(array(
  'format' => __d('amanager', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
  ));
  ?></p>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
          <th><?php echo $this->Paginator->sort('id'); ?></th>
          <th><?php echo $this->Paginator->sort('username', __d('amanager', 'User Name')); ?></th>
          <th><?php echo $this->Paginator->sort('email', __d('amanager', 'Email')); ?></th>
          <th><?php echo $this->Paginator->sort('status', __d('amanager', 'Status')); ?></th>
          <th class="actions"><?php echo __d('amanager', 'Actions'); ?></th>
      </tr>
    </thead>
  <?php
  foreach ($users as $user): ?>
    <tr>
      <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
      <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
      <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
      <td><?php echo h( $user['User']['status']==1?__('Active'):__('Inactive')); ?>&nbsp;</td>
      <td class="actions">
        <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
        <?php if(!$this->Amanager->in_group( $user['User']['id'] , Configure::read('Amanager.group_master' ) ) ){ ?>
          <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
        <?php } ?>
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

  <div class="users index">
    <h2><?php echo __('Users'); ?></h2>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?></p>
    <table class="table table-bordered table-striped">
      <tr>
          <th><?php echo $this->Paginator->sort('id'); ?></th>
          <th><?php echo $this->Paginator->sort('username', __('User Name', true)); ?></th>
          <th><?php echo $this->Paginator->sort('email', __('E-mail', true)); ?></th>
          <th><?php echo $this->Paginator->sort('status', __('Status', true)); ?></th>
          <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
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
      echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
      echo $this->Paginator->numbers(array('separator' => ''));
      echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
  </div>
  <div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('New User'), array('action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?></li>
      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
      <li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
    </ul>
  </div>
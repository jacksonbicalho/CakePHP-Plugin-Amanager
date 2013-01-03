  <div class="rules index">
    <h2><?php echo __('Rules');?></h2>
    <table class="table table-bordered table-striped">
      <tr>
        <th><?php echo __('Name');?></th>
        <th><?php echo __('Group');?></th>
        <th><?php echo __('Action');?></th>
        <th class="actions"><?php echo __('Actions', true);?></th>
        <th class="reorder"><?php echo __('Reorder', true);?></th>
      </tr>
      <tbody id="sortable">
    <?php foreach ($rules as $k => $rule): ?>
      <tr id="Rule_<?php echo $rule['Rule']['id']; ?>">
        <td class="cancel"><?php echo $rule['Rule']['name']; ?></td>
        <td class="cancel"><?php //pr( $rule['Group'] ); ?></td>
        <td class="cancel">
          <div id="actions_<?php echo $rule['Rule']['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="actions_<?php echo $rule['Rule']['id']; ?>Label"><?php echo $rule['Rule']['name']; ?></h3>
            </div>
            <div class="modal-body">
              <h4><?php echo __('Rules', true); ?></h4>
              <hr />
              <ul>
              <?php foreach( $rule['Action'] as $action){ ?>
              <li><?php echo $action['alias']; ?> <i class="<?php echo $action['alow']==1?'icon-ok-circle':'icon-ban-circle'; ?>"></i></li>
              <?php } ?>
              </ul>
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal"><?php echo __('close', true)?></button>
            </div>
          </div>
          <?php echo $this->Html->link('See actions of this rule', "#actions_{$rule['Rule']['id']}", array('class'=>'btn btn-link', 'data-toggle'=>'modal'))?>
        </td>
        <td class="actions cancel">
          <?php echo $this->Html->link(__('View', true), array('action'=>'view', $rule['Rule']['id']), array('class'=>'btn btn-link'))?>
          <?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $rule['Rule']['id']), array('class'=>'btn btn-link'))?>
          <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rule['Rule']['id']), array('class'=>'btn btn-link'), __('Are you sure you want to delete # %s?', $rule['Rule']['id'])); ?>
        </td>
        <td class="reorder"><i class="icon-th-list"></i></td>
      </tr>
    <?php endforeach; ?>
      </tbody>
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
      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('New Ruler'), array('action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?></li>

      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>

      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('New User'), array('action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?></li>

      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>  ' . __('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn', 'escape'=>false)); ?> </li>
      <li><?php echo $this->Html->link('<i class="icon-th-list"></i>  ' . __('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn', 'escape'=>false)); ?> </li>
    </ul>
  </div>
<?php echo $this->element('sortable', array('plugin' => 'Amanager')); ?>
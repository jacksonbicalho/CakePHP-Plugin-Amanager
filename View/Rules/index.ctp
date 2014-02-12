<ul class="nav nav-justified">
    <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Rule'), array('action' => 'add'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Group'), array('controller' => 'groups', 'action' => 'add'), array('escape'=>false)); ?></li>
</ul>


<div class="rules index">
  <h2><?php echo __('Rules');?></h2>
  <table class="table table-bordered table-striped">
    <tr>
      <th><?php echo __('Name');?></th>
      <th><?php echo __('Action');?></th>
      <th class="actions"><?php echo __('Actions', true);?></th>
      <th class="reorder"><?php echo __('Reorder', true);?></th>
    </tr>
    <tbody id="sortable">
  <?php foreach ($rules as $k => $rule): ?>
    <tr id="Rule_<?php echo $rule['Rule']['id']; ?>">
      <td class="cancel"><?php echo $rule['Rule']['name']; ?></td>
      <td class="cancel">
        <div class="modal fade" id="actions_<?php echo $rule['Rule']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="actions_<?php echo $rule['Rule']['id']; ?>Label"><?php echo $rule['Rule']['name']; ?></h4>
              </div>
              <div class="modal-body alert-info">
                <h5><?php echo __d('amanager', 'Rules', true); ?></h5>
                <hr />
                <ul>
                  <?php foreach( $rule['Action'] as $action){ ?>
                    <li><?php echo $action['alias']; ?> <span class="glyphicon <?php echo $action['alow']==1?'glyphicon-ok':'glyphicon-remove'; ?>"></span></li>
                  <?php } ?>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <?php echo $this->Html->link('See actions of this rule', "#actions_{$rule['Rule']['id']}", array('class'=>'btn btn-link', 'data-toggle'=>'modal'))?>
      </td>
      <td class="actions cancel">
        <?php echo $this->Html->link(__('View', true), array('action'=>'view', $rule['Rule']['id'])); ?>
        <?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $rule['Rule']['id'])); ?>
        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rule['Rule']['id'], __('Are you sure you want to delete # %s?', $rule['Rule']['id']))); ?>
      </td>
      <td class="reorder">
        <span class="glyphicon glyphicon glyphicon-align-justify"></span>
      </td>
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
<?php echo $this->element('sortable', array('plugin' => 'Amanager')); ?>
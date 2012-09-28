<div id="authake">
  <div class="rules index">

    <h2><?php echo __('Rules');?></h2>

    <table class="table table-bordered table-striped" cellpadding="0" cellspacing="0">
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
        <td class="cancel"><?php if ($rule['Group']['name']) echo  $rule['Group']['name']; ?></td>
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
          <?php echo $this->Html->link('See actions of this rule', "#actions_{$rule['Rule']['id']}", array('class'=>'btn', 'data-toggle'=>'modal'))?>
        </td>
        <td class="actions cancel">
          Ver | Editar | Excluir
        </td>
        <td class="reorder"><i class="icon-th-list"></i></td>
      </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php echo $this->element('sortable', array('plugin' => 'Amanager')); ?>
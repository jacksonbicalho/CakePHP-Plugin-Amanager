<?php foreach( $alias as $k => $v ){ ?>
    <tr id="Module_<?php echo "ALTERAR"; ?>">
      <td><?php echo $this->Form->input("Action.{$k}.alias", array('label'=>false, 'value'=>$v['alias'])); ?></td>
      <td><?php  echo $this->Form->checkbox("Action.{$k}.alow", array('hiddenField' => false, 'checked'=>'checked')  ); ?></td>
      <td class="actions">
        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_rule', 'ALTERAR'), array('class' => "btn btn-danger"), __('Are you sure you want to delete # %s?', 'ALTERAR')); ?>
      </td>
    </tr>
<?php } ?>
<div class="rules form">
<?php echo $this->Form->create('Rule'); ?>

  <div id="rules_list">
    <h3><?php echo __('Rules list', true)?></h3>

<table class="table table-bordered table-striped">
  <tr>
    <th>Regra</th>
    <th>Permitir?</th>
    <th>Delete</th>
  </tr>
  <tbody id="sortable">
<?php foreach( $actions_salvas as $k => $action){ ?>
    <tr id="action_<?php echo $k; ?>">
      <td>
        <?php
        if ( isset($action['id']) )
          echo $this->Form->hidden("Action.{$k}.id", array('label'=>false, 'value'=>$action['id']));

          echo $this->Form->input("Action.{$k}.alias", array('label'=>false, 'value'=>$action['alias']));
        ?>
      </td>
      <td><?php  echo $this->Form->checkbox("Action.{$k}.alow", array('hiddenField' => false)  ); ?></td>
      <td class="actions">
        <?php echo $this->Html->Link(__('Delete'), "javascript:removeTr({$k})", array('class' => "btn btn-danger"), __('Are you sure you want to delete this action: %s?', $action['alias'])); ?>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>

  </div>

  <fieldset>
		<legend><?php echo __('Add Rule'); ?></legend>
	<?php
    echo $this->Form->input('id');
    echo $this->Form->input('name');
		echo $this->Form->input('Group');
		echo $this->Form->input('plugin', array('empty'=> 'Selecione se for para Plugin'));
    $this->Js->get('#RulePlugin');
    $this->Js->get('#RulePlugin')->event(
      'change', $this->Js->request(
        array('action' => 'get_controlles_plugins'),
        array(
          'update' => '#RuleController',
          'dataExpression' => true,
          'method' => 'post',
          'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true)),
          'complete'=>'$("#RuleController").trigger("change");',

        )
      )

    );

		echo $this->Form->input('controller');
    $this->Js->get('#RuleController');
    $this->Js->get('#RuleController')->event(
      'change', $this->Js->request(
        array('action' => 'get_methods_controlles'),
        array(
          'update' => '#RuleAction',
          'dataExpression' => true,
          'method' => 'post',
          'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
        )
      )
    );
		echo $this->Form->input('action', array('multiple'=>false, 'size'=>10));
    $this->Js->get('#RuleAction');
    $this->Js->get('#RuleAction')->event(
      'dblclick', $this->Js->request(
        array('action' => 'update_rules_list'),
        array(
          'update' => '#sortable',
          'dataExpression' => true,
          'method' => 'post',
          'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))
        )
      )
    );

	?>
	</fieldset>


<?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php
echo $this->Html->scriptBlock(
    'function removeTr(id){
      $("#action_" + id).fadeOut(500, function() {
        $(this).remove();
        return false;
      });
     }',
    array('inline' => false)
);
?>



<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rules'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
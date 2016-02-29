<div class="row">
	<?php echo $this->Form->create('Rule', array('role'=>'form', 'id'=>'RuleForm')); ?>

		<div class="form-group col-xs-4">
			<div class="page-header">
				<h2 id="forms"><?php echo __d('amanager', 'Add Rule'); ?></h2>
			</div>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name', array('class'=>'form-control'));
				echo $this->Form->input('Group', array('class'=>'checkbox-input', 'label' => 'Grupos', 'type' => 'select', 'multiple' => 'checkbox'));
				echo $this->Form->input('plugin', array('empty'=> 'Selecione se for para Plugin', 'class'=>'form-control'));
				$this->Js->get('#RulePlugin')->event(
					'change',
					$this->Js->request(
						array(
							'action' => 'get_controlles_plugins'),
						array(
							'update' => '#RuleController',
							'dataExpression'=>TRUE,
							'method'=>'POST',
							'async'=>TRUE,
							'data' => $this->Js->serializeForm(
								array(
									'isForm' => TRUE,
									'inline' => TRUE
								)
							),
						'complete'=>'$("#RuleController").trigger("change");',
						)
					)
				);
				$this->Js->get('#RulePlugin')->event('change',
				$this->Js->request(array(
					'action' => 'get_controlles_plugins'), array(
					'update' => '#RuleController',
					'dataExpression'=>TRUE,
					'method'=>'POST',
					'async'=>TRUE,
					'data' => $this->Js->serializeForm(array('isForm' => TRUE, 'inline' => TRUE))  ))
				);

				echo $this->Form->input('controller', array('class'=>'form-control'));
				$this->Js->get('#RuleController')->event('change',
				$this->Js->request(array(
					'action' => 'get_methods_controlles'), array(
					'update' => '#RuleAction',
					'dataExpression'=>TRUE,
					'method'=>'POST',
					'async'=>TRUE,
					'data' => $this->Js->serializeForm(array('isForm' => TRUE, 'inline' => TRUE))  ))
				);

				echo $this->Form->input('action', array('multiple'=>false, 'size'=>10, 'class'=>'form-control'));
				$data = $this->Js->get('#RuleForm')->serializeForm(array('isForm' => true, 'inline' => true));
				$this->Js->get('#RuleAction')->event(
					'dblclick',
					$this->Js->request(
						array(
							'action' => 'update_rules_list'
						),
						array(
							'update' => '#sortable',
							'data' => $data,
							'async' => true,
							'dataExpression'=>true,
							'method' => 'POST',
							'dataExpression'=>TRUE,
							'data' => $data
						)
					)
				);
			?>
		</div>


		<div class="col-xs-8">
			<div class="page-header">
				<h2><?php echo __d('amanager', 'Rules list', true)?></h2>
			</div>
			<table class="table table-bordered table-striped">
				<tr>
					<th>Regra</th>
					<th width="12" class="text-center" align="center">Permitir?</th>
					<th width="12">Delete</th>
				</tr>
				<tbody id="sortable">
					<tr id="Module_<?php echo "ALTERAR"; ?>"></tr>
						<?php if(isset($actions_salvas)):
							foreach( $actions_salvas as $k => $action): ?>
								<tr id="action_<?php echo $k; ?>">
									<td>
										<?php
										if(isset($action['id'])){
											echo $this->Form->hidden("Action.{$k}.id", array('label'=>false, 'value'=>$action['id']));
										}
										echo $this->Form->input("Action.{$k}.alias", array('type'=>'text', 'class'=>'form-control', 'label'=>false, 'value'=>$action['alias']));
										?>
									</td>
									<td><?php  echo $this->Form->checkbox("Action.{$k}.alow", array('class'=>'check-center', 'hiddenField' => false)  ); ?></td>
									<td class="actions">
										<?php echo $this->Html->Link(__('Delete'), "javascript:removeTr({$k})", array('class' => "btn btn-danger"), __('Are you sure you want to delete this action: %s?', $action['alias'])); ?>
									</td>
								</tr>
							<?php
							endforeach;
						endif;?>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12">
			<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __d('amanager', 'Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<?php
	echo $this->Html->scriptBlock(
		'
			function removeTr(id){
				$("#action_" + id).fadeOut(500, function() {
					$(this).remove();
					return false;
				});
			}
		',
		array('inline' => false)
	);
?>

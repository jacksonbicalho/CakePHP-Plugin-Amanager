<div class="row">
	<div class="groups form col-xs-12">
		<?php echo $this->Form->create('Group', array('role'=>'form')); ?>
			<div class="form-group">
				<div class="page-header">
					<h2 id="forms"><?php echo __d('amanager', 'Manager Group'); ?></h2>
				</div>
				<?php
					echo $this->Form->input('id');
					echo $this->Tbs->input('name');
					echo $this->Tbs->habtm('Rule', array('class'=>'checkbox-input', 'label' => 'Regras', 'type' => 'select', 'multiple' => 'checkbox'));
					echo $this->Tbs->input('status', array('options' => array( '1' => 'Ativado', '0' => 'Desativado')));
				?>
				<?php echo $this->Tbs->submit( __d('amanager', 'Submit'));  ?>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

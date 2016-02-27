<?php
  //$error = array('attributes' => array('class' => 'alert alert-danger'));
  $required = $action == 'add'?true:false;
  $password_options = array(
    'value'=>null,
    'label'=>__d('amanager', 'Password'),
    'class'=>'form-control',
    //'error'=>$error,
    //'required'=> $required,
  );
  $password2_options = array(
    'value'=>null,
    'label'=>__d('amanager', 'Password'),
    'class'=>'form-control',
    //'error'=>$error,
    //'required'=> $required,
    'type'=> 'password',
  );
  if(!$required){
    $password_options['value'] = '';
    $password2_options['value'] = '';
  }
?>
<div class="row">
	<div class="users form col-xs-12">
	<?php echo $this->Form->create('User', array('role'=>'form')); ?>
		<div class="form-group">
			<div class="page-header">
				<h2 id="forms"><?php echo __d('amanager', 'Manager User'); ?></h2>
			</div>
			<?php
				echo $this->Form->input('username',
					array(
						'label'=>__d('amanager', 'Username'),
						'class'=>'form-control',
					)
				);
				echo $this->Form->input('password', $password_options);
				echo $this->Form->input('password2', $password2_options);
				echo $this->Form->input('email',
					array(
						'label'=>__d('amanager', 'Email'),
						'class'=>'form-control',
					)
				);
				echo $this->Form->input('name',
					array(
						'label'=>__d('amanager', 'Name'),
						'class'=>'form-control',
					)
				);
				$options = array('1'=>__d('amanager', 'Active'),'2'=>__d('amanager', 'Inactive'));
				echo $this->Form->input('status',
					array(
						'options'=>$options,
						'class'=>'form-control'
					)
				);

				echo $this->Form->input('Group', array('class'=>'checkbox-input', 'label' => __d('amanager', 'Group'), 'type' => 'select', 'multiple' => 'checkbox'));

			?>
			<br />
			<?php echo $this->Form->button('<i class="icon-white icon-plus-sign"></i>  ' . __d('amanager', 'Submit'), array('type' => 'submit', 'class'=>'btn btn-primary'), array('escape'=>false) );  ?>
		</div>
	<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="users recover_password">
<?php echo $this->Form->create('User', array('class'=>'form-signin')); ?>
	<?php
		echo $this->Form->input('id', array('value'=>$user_id));
    echo $this->Form->input('password', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'label' => __('Digite a nova senha'), 'class' => 'span3'));
    echo $this->Form->input('password2', array('error' => array('attributes' => array('class' => 'alert alert-error')), 'type'=>'password', 'label' => __('Digite a senha novamente'), 'class' => 'span3'));
    echo $this->Form->submit(__('Criar senha'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
	?>
</div>
<div class="clr"></div>
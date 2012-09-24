<div id="authake">
<div class="actions menuheader">
    <ul>
        <li class="icon lock"><?php echo $this->Html->link(__('Manage rules'), array('action'=>'index'));?></li>
    </ul>
</div>
<div class="rules form">
<?php echo $this->Form->create('Rule');?>
	<fieldset>
 		<legend><?php __('Modify rule');?></legend>
	<?php
	    echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Description'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
		echo $this->Form->input('group_id', array('label'=>__('Group'), 'empty'=>true));
		echo $this->Form->input('order', array('label'=>__('Order')));

		$options =array();
		$i = 0;
?>
		<div class="checkbox">
			<input id="RuleActionAllIndex" type="checkbox" value="*" name="data[Rule][action_all][]" <?php echo $this->data['Rule']['action']== '*'? 'checked="checked"':''; ?>">
			<label for="RuleActionAllIndex"><h2><?php echo __("All areas and methods", true); ?> (*)</h2></label>
		</div>
<?php
		foreach($controllers as $controller => $actions):
			$controller = Functions::uncamelize(str_replace("Controller", "", $controller));
      $controller=preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', '_'.'$0', $controller));
?>
			<fieldset>

				<legend><h2><?php echo $controller; ?></h2></legend>
				<div class="checkbox">
					<input id="RuleActionAll<?php echo $controller; ?>" type="checkbox" value="/<?php echo strtolower($controller . '*'); ?>" name="data[Rule][actionAll_<?php echo strtolower($controller); ?>][]" <?php echo in_array('/' . strtolower($controller . '*'), $actions_salvas)? 'checked="checked"':''; ?>>
					<label for="RuleActionAll<?php echo $controller; ?>"><h3><?php echo __("All methods", true); ?> /<?php echo strtolower($controller . '*'); ?></h3></label>
				</div>
<?php
				unset($options);
				unset($selected);
				foreach($actions as $key => $action):
          $admin = '';
          $_admin = explode('_', $action);
          // Verifica se a posição[0] existe e se é admin
          if(isset($_admin[0])){
            if( $_admin[0] == 'admin' ){
              $admin = 'admin/';
              $action = $_admin[1];
            }

          }
 					$options["/{$admin}" . strtolower($controller . '(/)?')] = " /{$admin}" . strtolower($controller . '(/)?') ;
 					$options["/{$admin}" . strtolower($controller . '/' . $action . '(/)?')] = " /{$admin}" . strtolower($controller . '/' . $action . '(/)?') ;
 					$options["/{$admin}" . strtolower($controller . '/' . $action . '(/)?*')] = " /{$admin}" . strtolower($controller . '/' . $action . '(/)?*') ;
					if (in_array("/{$admin}" . strtolower($controller . '/' . $action . '(/)?'), $actions_salvas)){
						$selected[] = "/{$admin}" . strtolower($controller . '/' . $action . '(/)?');
					}
					if (in_array("/{$admin}" . strtolower($controller . '/' . $action . '(/)?*'), $actions_salvas)){
						$selected[] = "/{$admin}" . strtolower($controller . '/' . $action . '(/)?*');
					}
					if (in_array("/{$admin}" . strtolower($controller . '(/)?'), $actions_salvas)){
						$selected[] = "/{$admin}" . strtolower($controller . '(/)?');
					}
				endforeach;
				$selected = isset($selected)?$selected:array();
				echo $this->Form->input('action_'.strtolower($controller), array(
					'label' => '<h4>' . __('Actions', true) . '</h4>',
					'type' => 'select',
					'multiple' => 'checkbox',
					'options' => $options,
					'selected' => $selected
				));
?>
			</fieldset>
<?php
		endforeach;

        //echo $this->Form->input('action', array('label'=>__('Action<br/>(perl regex)'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'5'));
        echo $this->Form->input('permission', array('label'=>__('Permission'), 'style'=>'width: 5em;'));
        echo $this->Form->input('forward', array('label'=>__('Forward action on error')));
        echo $this->Form->input('message', array('label'=>__('Flash message on deny'), 'type'=>'textarea', 'cols'=>'50', 'rows'=>'2'));
	?>
	</fieldset>
<?php echo $this->Form->end('Modify');?>
</div>
<div class="actions">
	<ul>
        <li class="icon info"><?php echo $this->Html->link(__('View rule'), array('action'=>'view', $this->Form->value('Rule.id')));?></li>
		<li class="icon cross"><?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $this->Form->value('Rule.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Rule.id'))); ?></li>
	</ul>
</div>
</div>

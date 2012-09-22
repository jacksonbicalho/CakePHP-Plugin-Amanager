<?php
  echo $this->Form->input('Action.action', array(
    'label' => '<h4>' . __('Actions', true) . '</h4>',
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => isset($options)?$options:null
  ));
?>